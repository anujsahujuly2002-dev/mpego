<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CarDetailRequest;
use App\Http\Resources\Api\CarDetailsResource;
use App\Models\CarDetailImage;
use App\Repositories\CardetailRepository;
use App\Repositories\Upload\UploadImageRepository;
use Exception;
use Illuminate\Http\Request;

class CarDetailsController extends Controller
{
    private $carDetailRepository;

    public function __construct()
    {
        $this->carDetailRepository = New CardetailRepository;
    }

    public function carDetails(CarDetailRequest $request) {
        try {
            $userId = auth()->user()?auth()->user()->id:$request->input('user_id');
            $data = $request->only(['vehicle_make', 'model', 'color', 'vin']);
            $data['make'] = $data['vehicle_make'];
            unset($data['vehicle_make']);
            $data['user_id'] = $userId;
            $carDetail = $this->carDetailRepository->store($data);
            if(!empty($request->file('image'))):
                $checkImageExists = CarDetailImage::where('car_detail_id',$carDetail->id)->get();
                if($checkImageExists->count() >0):
                    $checkImageExists->each(fn($q)=>$q->delete());
                endif;
                $directory = "upload/car-details/".$userId;
                foreach($request->file('image') as $file):
                    $image = New UploadImageRepository($file,$directory);
                    $imageName = $image->upload();
                    CarDetailImage::create([
                        'car_detail_id'=>$carDetail->id,
                        'images'=>$imageName
                    ]);
                endforeach;
            endif;
            if( $carDetail):
                return response()->json([
                    'status'=>true,
                    'message'=>"Car Detail store succssfully",
                ],200);
            else:
                return response()->json([
                    'status'=>true,
                    'message'=>"Car Detail not store, Please try again",
                ],500);
            endif;

        } catch (Exception $e) {
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ],500);
        }
    }


    public function getCarDetails(Request $request) {
        try {
            $userId = auth()->user()?auth()->user()->id:$request->input('user_id');
            $carDetails = $this->carDetailRepository->getCarDetailsByUserId($userId);
            if($carDetails):
                return response()->json([
                    'status'=>true,
                    'message'=>"Car Details fetched successfully",
                    'data'=>New CarDetailsResource($carDetails)
                ],200);
            else:
                return response()->json([
                    'status'=>false,
                    'message'=>"No car details found",
                ],404);
            endif;
        } catch (Exception $e) {
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ],500);
        }
    }


}

