<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AccidentRepository;
use App\Http\Requests\AccidentInfoRequest;
use App\Repositories\Auth\SignUpRepository;
use App\Repositories\Upload\UploadImageRepository;

class AccidentDetailsController extends Controller
{
    private $accidentRepository,$signUpRepository;

    public function __construct()
    {
        $this->accidentRepository = New AccidentRepository();
        $this->signUpRepository = New SignUpRepository();
    }

    public function accidentDetails (AccidentInfoRequest $request) {
        try {
            $data =$request->all();
            $data['user_id'] = auth()->id(); // Assuming the user is authenticated
            $accident = $this->accidentRepository->create($data);
            return response()->json([
                'status' => true,
                'message' => 'Accident details saved successfully',
                'data' => $accident
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to save accident details',
            ], 500);
        }
    }

    public function getPreviousAccident() {
        try {
            $userId = auth()->user()->id;
            $accidents = $this->accidentRepository->getPreviousAccidentByUserId($userId);
            if ($accidents) {
                return response()->json([
                    'status' => true,
                    'data' => $accidents,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "No previous accidents found",
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred: " . $e->getMessage(),
            ], 500);
        }
    }

    public function exchangeIdAndInsurance(Request $request) {
        try {
           if(!empty($request->file('image'))):
                $directory = "upload/user-image/". auth()->user()->id;
                $file = $request->file('image');
                $imageUpload = New UploadImageRepository($file,$directory);
                $fileName = $imageUpload->upload();
                $data = [
                    'user_id'=> auth()->user()->id,
                    'image'=>$fileName
                ];
                $this->signUpRepository->storeUserImage($data);
            endif;
            if(!empty($request->file('insurance_image'))):
                $directory = "upload/insurance-image/". auth()->user()->id;
                $file = $request->file('insurance_image');
                $imageUpload = New UploadImageRepository($file,$directory);
                $fileName = $imageUpload->upload();
                $data = [
                    'user_id'=> auth()->user()->id,
                    'insurance_image'=>$fileName
                ];
                $this->signUpRepository->storeUserInsurenceImage($data);
            endif;
            return response()->json([
                'status' => true,
                'message' => 'Exchange ID and insurance details saved successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to save exchange ID and insurance details',
            ], 500);
        }
    }

    public function getExchangeIdAndInsurance() {
        try {
            $userId = auth()->user()->id;
            $getExchangeIdAndInsurance = $this->signUpRepository->getExchangeIdAndInsurance($userId);

            return response()->json([
                'status' => true,
                'data' =>$getExchangeIdAndInsurance,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred: " . $e->getMessage(),
            ], 500);
        }
    }

}
