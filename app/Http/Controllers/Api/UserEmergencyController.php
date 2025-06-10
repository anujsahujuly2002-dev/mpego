<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\HelpRepository;
use App\Http\Requests\UserEmergencyRequest;
use App\Repositories\UserEmergencyRepository;

class UserEmergencyController extends Controller
{
    private $userEmergencyRepository,$helpRepository;

    public function __construct()
    {
        $this->userEmergencyRepository = new UserEmergencyRepository();
        $this->helpRepository = new HelpRepository();
    }

    public function store(UserEmergencyRequest $request)
    {
        try {
            $userId = auth()->user() ? auth()->user()->id : $request->input('user_id');
            $data = $request->only(['emergency_contact_name', 'emergency_contact_phone']);
            $data['user_id'] = $userId;
            $emergency = $this->userEmergencyRepository->create($data);
            if ($emergency) {
                return response()->json([
                    'status' => true,
                    'message' => "Emergency contact stored successfully",
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Failed to store emergency contact",
                ], 500);
            }
        }catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred: " . $e->getMessage(),
            ], 500);
        }
    }

    public function getUserEmergency() {
        try {
            $userId = auth()->user()->id;
            $emergency = $this->userEmergencyRepository->getByUserId($userId);
            if ($emergency) {
                return response()->json([
                    'status' => true,
                    'data' => $emergency,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "No emergency contact found",
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred: " . $e->getMessage(),
            ], 500);
        }
    }

    public function helpInfo() {
        try {   
            $helpInfo = $this->helpRepository->getSettings();
            if ($helpInfo) {
                return response()->json([
                    'status' => true,
                    "message" => "Help information retrieved successfully",
                    'data' => $helpInfo,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "No help information found",
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "An error occurred: " . $e->getMessage(),
            ], 500);
        }
    }

    public function getAccountDeleteReasons()
    {
        try {
            $reasons = $this->helpRepository->getAcountDeleteReasons();
            return response()->json([
                'status' => true,
                "message" => "Account delete reasons retrieved successfully",
                'data' => $reasons
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'message' => "Some error occurred while fetching the account delete reasons. Please try again later.",
            ], 500);
        }
    }
}
