<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\HealthInsuranceRepository;
use App\Http\Requests\Api\HealthInsuranceRequest;
use App\Models\HealthInsuranceImage;
use App\Repositories\Upload\UploadImageRepository;

class HealthInsuranceController extends Controller
{
    private $healthInsuranceRepository;

    public function __construct()
    {
        $this->healthInsuranceRepository = New HealthInsuranceRepository();
    }
    public function healthInsuranceInfo(HealthInsuranceRequest $request) {
        $userId = auth()->user()?auth()->user()->id:$request->input('user_id');
        $data = $request->only(['medi_care', 'policy_number', 'insurer_name','insurance_carrier']);
        $data['user_id'] = $userId;
        $healthInsurance = $this->healthInsuranceRepository->store($data);
        if(!empty($request->file('upload_medicare'))):
            $checkImageExists = HealthInsuranceImage::where('health_insurance_id',$healthInsurance->id)->get();
            if($checkImageExists->count() >0):
                $checkImageExists->each(fn($q)=>$q->delete());
            endif;
            $directory = "upload/health-insurance-image/".$userId;
            foreach($request->file('upload_medicare') as $file):
                $image = New UploadImageRepository($file,$directory);
                $imageName = $image->upload();
                HealthInsuranceImage::create([
                    'health_insurance_id'=>$healthInsurance->id,
                    'image'=>$imageName
                ]);
            endforeach;
        endif;
        if( $healthInsurance):
            return response()->json([
                'status'=>true,
                'message'=>"Health insurance info store succssfully",
            ],200);
        else:
            return response()->json([
                'status'=>true,
                'message'=>"Health insurance info not store, Please try again",
            ],500);
        endif;
    }
}
