<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AccidentRepository;
use App\Http\Requests\AccidentInfoRequest;
use App\Http\Requests\Api\CarDetailAndCarInsurenceRequest;
use App\Http\Requests\Api\DriverInsuranceRequest;
use App\Http\Requests\Api\DriversRegistrationCard;
use App\Http\Requests\Api\OtherDriverIdRequest;
use App\Http\Requests\UpdateAccidentInfoRequest;
use App\Repositories\Auth\SignUpRepository;
use App\Repositories\Upload\UploadImageRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class AccidentDetailsController extends Controller
{
    private $accidentRepository, $signUpRepository;

    public function __construct()
    {
        $this->accidentRepository = new AccidentRepository();
        $this->signUpRepository = new SignUpRepository();
    }

    public function accidentDetails(AccidentInfoRequest $request)
    {
        try {
            $data = $request->all();
            $data['user_id'] = auth()->id(); // Assuming the user is authenticated
            $accident = $this->accidentRepository->create($data);
            if (!empty($data['contacts'])):
                foreach ($data['contacts'] as $contacts):
                    $this->accidentRepository->createAccidentContact($contacts, $accident->id, auth()->id());
                endforeach;
            endif;
            $accidentDetails =  $this->accidentRepository->findById($accident->id);
            return response()->json([
                'status' => true,
                'message' => 'Accident details saved successfully',
                'data' => $accidentDetails
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error saving accident details: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'status' => false,
                'message' => 'Failed to save accident details',
                // "error"=>$e->getMessage(),
            ], 500);
        }
    }

    public function getPreviousAccident()
    {
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

    public function exchangeIdAndInsurance(Request $request)
    {
        try {
            if (!empty($request->file('image'))):
                $directory = "upload/user-image/" . auth()->user()->id;
                $file = $request->file('image');
                $imageUpload = new UploadImageRepository($file, $directory);
                $fileName = $imageUpload->upload();
                $data = [
                    'user_id' => auth()->user()->id,
                    'image' => $fileName
                ];
                $this->signUpRepository->storeUserImage($data);
            endif;
            if (!empty($request->file('insurance_image'))):
                $directory = "upload/insurance-image/" . auth()->user()->id;
                $file = $request->file('insurance_image');
                $imageUpload = new UploadImageRepository($file, $directory);
                $fileName = $imageUpload->upload();
                $data = [
                    'user_id' => auth()->user()->id,
                    'insurance_image' => $fileName
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
                // "error"=>$e->getMessage(),
                'message' => 'Failed to save exchange ID and insurance details',
            ], 500);
        }
    }

    public function getExchangeIdAndInsurance()
    {
        try {
            $userId = auth()->user()->id;
            $getExchangeIdAndInsurance = $this->signUpRepository->getExchangeIdAndInsurance($userId);
            if (is_null($getExchangeIdAndInsurance)):
                return response()->json([
                    'status' => false,
                    "message" => "Exchange ID and insurance details  not found"
                ]);
            endif;
            return response()->json([
                'status' => true,
                "message" => "Exchange ID and insurance details fetched successfully",
                'data' => $getExchangeIdAndInsurance,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred: " . $e->getMessage(),
            ], 500);
        }
    }

    public function otherDriverId(OtherDriverIdRequest $request)
    {
        try {
            $fileName = [];
            if (!empty($request->file('image'))):
                $userId = auth()->user()->id;
                $directory = "upload/other-drivers-id/" . $userId . '/' . $request->input('accident_id');
                $file = $request->file('image');
                $imageUpload = new UploadImageRepository($file, $directory);
                $fileName = $imageUpload->upload();
            endif;
            $data = $request->all();
            $data['fileName'] = $fileName;
            $otherDriverId = $this->accidentRepository->otherDriverId($data);
            if ($otherDriverId):
                return response()->json([
                    'status' => true,
                    "message" => "Other Driver Id Information store successfully",
                ]);
            else:
                return response()->json([
                    'status' => false,
                    "message" => "Other Driver Id Information not store, Please try again",
                ]);
            endif;
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred: " . $e->getMessage(),
            ], 500);
        }
    }

    public function driverInsurance(DriverInsuranceRequest $request)
    {
        try {
            $fileName = [];
            if (!empty($request->file('image'))):
                $userId = auth()->user()->id;
                $directory = "upload/driver-insurance-image/" . $userId . '/' . $request->input('accident_id');
                $file = $request->file('image');
                $imageUpload = new UploadImageRepository($file, $directory);
                $fileName = $imageUpload->upload();
            endif;
            $data = $request->all();
            $data['fileName'] = $fileName;
            $otherDriverId = $this->accidentRepository->driverInsurance($data);
            if ($otherDriverId):
                return response()->json([
                    'status' => true,
                    "message" => "Driver insurance information store successfully",
                ]);
            else:
                return response()->json([
                    'status' => false,
                    "message" => "Driver insurance information not store, Please try again",
                ]);
            endif;
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred: " . $e->getMessage(),
            ], 500);
        }
    }

    public function driversRegistrationCards(DriversRegistrationCard $request)
    {
        try {
            $fileName = [];
            if (!empty($request->file('image'))):
                $userId = auth()->user()->id;
                $directory = "upload/driver-registration-card-image/" . $userId . '/' . $request->input('accident_id');
                $file = $request->file('image');
                $imageUpload = new UploadImageRepository($file, $directory);
                $fileName = $imageUpload->upload();
            endif;
            $data = $request->all();
            $data['fileName'] = $fileName;
            $otherDriverId = $this->accidentRepository->driverRegistrationCard($data);
            if ($otherDriverId):
                return response()->json([
                    'status' => true,
                    "message" => "Driver Registration card information store successfully",
                ]);
            else:
                return response()->json([
                    'status' => false,
                    "message" => "Driver Registration card information not store, Please try again",
                ]);
            endif;
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred: " . $e->getMessage(),
            ], 500);
        }
    }

    public function carDetailAndCarInsurence(CarDetailAndCarInsurenceRequest $request)
    {
        try {
            $carDetailAndCarInsurence = $this->accidentRepository->carDetailAndCarInsurence($request);
            if ($carDetailAndCarInsurence):
                return response()->json([
                    'status' => true,
                    "message" => "Car details and insurance information updated successfully",
                ]);
            else:
                return response()->json([
                    'status' => false,
                    "message" => "Car details and insurance information could not be updated. Please try again.",
                ]);
            endif;
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred: " . $e->getMessage(),
            ], 500);
        }
    }

    public function updateAccidentInfo(UpdateAccidentInfoRequest $request)
    {
        try {
            $data = $request->all();
            $accidentId = $data['accident_id'];
            unset($data['accident_id']);
            $updatedAccident = $this->accidentRepository->update($accidentId, $data);
            return response()->json([
                'status' => true,
                'message' => 'Accident information updated successfully',
                'data' => $updatedAccident
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update accident information',
            ], 500);
        }
    }

    public function getAccidentDetailsById(Request $request)
    {
        try {
            $accidentId = $request->input('accident_id');
            if (empty($accidentId)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Accident ID is required',
                ], 400);
            }
            $accidentDetails = $this->accidentRepository->findById($accidentId);
            if ($accidentDetails) {
                return response()->json([
                    'status' => true,
                    'data' => $accidentDetails,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Accident details not found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

}
