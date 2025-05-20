<?php

namespace App\Http\Controllers\Api;

use App\Models\InsuranceImage;
use App\Http\Controllers\Controller;
use App\Repositories\CarInsuranceInfoRepository;
use App\Http\Requests\Api\CarInsuranceInfoRequest;
use App\Repositories\Upload\UploadImageRepository;

class CarInsuranceInfo extends Controller
{
    private $carInsuranceInfoRepository;
    public function __construct()
    {
        $this->carInsuranceInfoRepository = New CarInsuranceInfoRepository();
    }

    public function carInsuranceInfo(CarInsuranceInfoRequest $request) {
        $userId = auth()->user()?auth()->user()->id:$request->input('user_id');
        $data = $request->only(['carrier', 'policy_number', 'agent_name']);
        $data['user_id'] = $userId;
        $carInsuranceInfo = $this->carInsuranceInfoRepository->store($data);
        if(!empty($request->file('insurance_card'))):
            $checkImageExists = InsuranceImage::where('car_insurance_info_id',$carInsuranceInfo->id)->get();
            if($checkImageExists->count() >0):
                $checkImageExists->each(fn($q)=>$q->delete());
            endif;
            $directory = "upload/car-insurance/".$userId;
            foreach($request->file('insurance_card') as $file):
                $image = New UploadImageRepository($file,$directory);
                $imageName = $image->upload();
                InsuranceImage::create([
                    'car_insurance_info_id'=>$carInsuranceInfo->id,
                    'image'=>$imageName
                ]);
            endforeach;
        endif;
        if( $carInsuranceInfo):
            return response()->json([
                'status'=>true,
                'message'=>"Car insurance info store succssfully",
            ],200);
        else:
            return response()->json([
                'status'=>true,
                'message'=>"Car insurance info not store, Please try again",
            ],500);
        endif;

    }
}
