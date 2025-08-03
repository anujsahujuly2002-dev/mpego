<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\GiftCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GiftCardRequest;
use App\Repositories\Upload\UploadImageRepository;

class GiftCardController extends Controller
{

    public function index(Request $request) {
        if($request->ajax()):
            $giftCards = GiftCard::latest();
            return  datatables()->of($giftCards)
            ->addIndexColumn()
            ->editColumn('gift-card-image',function($row){
                return "<image src='".env('IMAGE_URL')."/storage/upload/gift-card/".$row->{'gift-card-image'}."' height=100 width:100>";
            })
            ->addColumn('action',function($row){
                return  ' <a href="javascript: void(0);" class="btn btn-soft-danger btn-icon btn-sm rounded-circle"  onclick="deleteRecord(\'' . route('admin.gift.card.delete') . '\',' . $row->id . ')"> <i class="ti ti-trash"></i></a>';
            })
            ->rawColumns(['action','gift-card-image'])
            ->make(true);
        endif;
        return view('admin.gift-card.index');
    }

    public function create() {
        return view('admin.gift-card.create');
    }

    public function store(GiftCardRequest $request) {
        try {
            $image ="";
            if(!empty($request->file('gift-image'))):
                $directory = "upload/gift-card/";
                $giftCardImage = New UploadImageRepository($request->file('gift-image'),$directory);
                $image = $giftCardImage->upload();
            endif;
            $giftExpire = $request->input('gift-expire');
            $giftCardExpireAt = Carbon::createFromFormat('M,d,Y', $giftExpire);

            $giftCard = GiftCard::create([
                'gift-card'=>$request->input('gift-code'),
                "gift-card-image"=>$image,
                'gift-card-expire_at'=>$giftCardExpireAt->format('Y-m-d H:i:s')
            ]);
            if($giftCard):
                return response()->json([
                    'status'=>true,
                    "message"=>"Gift Card added successfully",
                    "url"=>route('admin.gift.card.index')
                ]);
            else:
                return response()->json([
                    'status'=>true,
                    "message"=>"Gift Card not added, Please try again",
                ]);
            endif;
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' =>"Some error occurred while updating the setting. Please try again later.",
            ], 500);
        }
    }

    public function delete(Request $request) {
        try {
            GiftCard::find($request->input('id'))->delete();
             return response()->json([
                'status'=>true,
                "message"=>"Gift Card delete successfully",
                // "url"=>route('admin.gift.card.index')
            ]);

        } catch (Exception $e) {
           return response()->json([
                'status' => false,
                'message' =>"Some error occurred while deleteing the setting. Please try again later.",
            ], 500);
        }
    }

}
