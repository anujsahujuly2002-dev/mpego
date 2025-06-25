<?php

namespace App\Http\Controllers\Api;

use App\Models\medicalImage;
use App\Http\Controllers\Controller;
use App\Models\HealthInsuranceImage;
use App\Http\Requests\Api\MedicalRequest;
use App\Repositories\HealthInsuranceRepository;
use App\Http\Requests\Api\HealthInsuranceRequest;
use App\Http\Requests\Api\PrivateCardRequest;
use App\Repositories\Upload\UploadImageRepository;
use App\Http\Resources\Api\HealthInsurenceInfoResource;
use App\Http\Resources\Api\MedicalResource;
use App\Http\Resources\Api\PrivateCardResource;
use App\Models\PrivateCard;
use App\Models\PrivateCardImage;
use Exception;

class HealthInsuranceController extends Controller
{
    private $healthInsuranceRepository;

    public function __construct()
    {
        $this->healthInsuranceRepository = new HealthInsuranceRepository();
    }
    public function healthInsuranceInfo(HealthInsuranceRequest $request)
    {
        $userId = auth()->user() ? auth()->user()->id : $request->input('user_id');
        $data = $request->only(['medi_care', 'policy_number', 'insurer_name', 'insurance_carrier']);
        $data['user_id'] = $userId;
        $healthInsurance = $this->healthInsuranceRepository->store($data);
        if (!empty($request->file('upload_medicare'))):
            $checkImageExists = HealthInsuranceImage::where('health_insurance_id', $healthInsurance->id)->get();
            if ($checkImageExists->count() > 0):
                $checkImageExists->each(fn($q) => $q->delete());
            endif;
            $directory = "upload/health-insurance-image/" . $userId;
            foreach ($request->file('upload_medicare') as $file):
                $image = new UploadImageRepository($file, $directory);
                $imageName = $image->upload();
                HealthInsuranceImage::create([
                    'health_insurance_id' => $healthInsurance->id,
                    'image' => $imageName
                ]);
            endforeach;
        endif;
        if ($healthInsurance):
            return response()->json([
                'status' => true,
                'message' => "Health insurance info store succssfully",
            ], 200);
        else:
            return response()->json([
                'status' => true,
                'message' => "Health insurance info not store, Please try again",
            ], 500);
        endif;
    }

    public function getHealthInsuranceInfo()
    {
        $userId = auth()->user() ? auth()->user()->id : request()->input('user_id');
        $healthInsurance = $this->healthInsuranceRepository->getHealthInsuranceInfoUsingUserId($userId);
        if ($healthInsurance):
            return response()->json([
                'status' => true,
                'message' => "Health insurance info get succssfully",
                'data' =>New HealthInsurenceInfoResource($healthInsurance)
            ], 200);
        else:
            return response()->json([
                'status' => false,
                'message' => "Health insurance info not found",
            ], 404);
        endif;
    }

    public function mediCalStore(MedicalRequest $request) {
        $userId = auth()->user() ? auth()->user()->id : $request->input('user_id');
        $data = $request->only(['medi_care', 'policy_number', 'insurer_name', 'insurance_carrier']);
        $data['user_id'] = $userId;
        $medical = $this->healthInsuranceRepository->mediCalStore($data);
        if (!empty($request->file('image'))):
            $checkImageExists = medicalImage::where('medical_id', $medical->id)->get();
            if ($checkImageExists->count() > 0):
                $checkImageExists->each(fn($q) => $q->delete());
            endif;
            $directory = "upload/medical-image/" . $userId.'/'.$medical->id;
            foreach ($request->file('image') as $file):
                $image = new UploadImageRepository($file, $directory);
                $imageName = $image->upload();
                medicalImage::create([
                    'medical_id' => $medical->id,
                    'image' => $imageName
                ]);
            endforeach;
        endif;
        if ($medical):
            return response()->json([
                'status' => true,
                'message' => "Medi Cal info store succssfully",
            ], 200);
        else:
            return response()->json([
                'status' => true,
                'message' => "Medi Cal info not store, Please try again",
            ], 500);
        endif;
    }

    public function getMedicalInfo() {
        try {
            $userId = auth()->user() ? auth()->user()->id :request()->input('user_id');
            $medical = $this->healthInsuranceRepository->getMedicalInfoUsingUserId($userId);
            if ($medical):
                return response()->json([
                    'status' => true,
                    'message' => "Medical info get succssfully",
                    'data' =>New MedicalResource($medical)
                ], 200);
            else:
                return response()->json([
                    'status' => false,
                    'message' => "Medical info not found",
                ], 404);
            endif;
        } catch (Exception $e) {
             return response()->json([
                'status' => false,
                'message' => "Medi Cal info not store, Please try again",
                "file"=>$e->getMessage()
            ], 500);
        }

    }

    public function privateCard(PrivateCardRequest $request) {
        $userId = auth()->user() ? auth()->user()->id : $request->input('user_id');
        $data = $request->only(['medi_care', 'policy_number', 'insurer_name', 'insurance_carrier']);
        $data['user_id'] = $userId;
        $privateCard = $this->healthInsuranceRepository->privateCard($data);
        if (!empty($request->file('image'))):
            $checkImageExists = PrivateCardImage::where('private_card_id', $privateCard->id)->get();
            if ($checkImageExists->count() > 0):
                $checkImageExists->each(fn($q) => $q->delete());
            endif;
            $directory = "upload/private-card/" . $userId.'/'.$privateCard->id;
            foreach ($request->file('image') as $file):
                $image = new UploadImageRepository($file, $directory);
                $imageName = $image->upload();
                PrivateCardImage::create([
                    'private_card_id' => $privateCard->id,
                    'image' => $imageName
                ]);
            endforeach;
        endif;
        if ($privateCard):
            return response()->json([
                'status' => true,
                'message' => "Private Card info store succssfully",
            ], 200);
        else:
            return response()->json([
                'status' => false,
                'message' => "Private Card info not store, Please try again",
            ], 500);
        endif;
    }

    public function getPrivateCard() {
        try {
            $userId = auth()->user() ? auth()->user()->id :request()->input('user_id');
            $privateCard = $this->healthInsuranceRepository->getPrivateCard($userId);
            if ($privateCard):
                return response()->json([
                    'status' => true,
                    'message' => "Private Card info get succssfully",
                    'data' =>New PrivateCardResource($privateCard)
                ], 200);
            else:
                return response()->json([
                    'status' => false,
                    'message' => "Private Card info not found",
                ], 404);
            endif;
        } catch (Exception $e) {
             return response()->json([
                'status' => false,
                'message' => "Private Card Not getting, Please try again",
                'error'=>$e->getMessage(),
                'file'=>$e->getFile()
            ], 500);
        }
    }
}
