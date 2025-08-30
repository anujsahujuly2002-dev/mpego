<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\ServiceRequest;
use App\Models\UserBirthdayGift;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\HelpRepository;
use App\Http\Requests\UserEmergencyRequest;
use App\Http\Requests\Api\ServiceFormRequest;
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
                // 'error' => $e->getMessage(),
                'message' => "Some error occurred while fetching the account delete reasons. Please try again later.",
            ], 500);
        }
    }


    public function giftCardList() {
        $giftCards = UserBirthdayGift::where('user_id', auth()->user()->id)
        ->with('giftCard')
        ->get()
        ->map(function($item) {
            return [
                'id' => $item->id,
                'gift_card_id' => $item->gift_card_id,
                'scratched_at' => $item->scratched_at,
                'gift_card' => [
                    'id' => $item->giftCard->id ?? null,
                    'gift_card_image' => $item->giftCard->gift_card_image ?? null,
                    'gift_card_expire_at' => $item->giftCard->{"gift-card-expire_at"} ?? null,
                    "gift_card_code" =>$item->giftCard->{"gift-card"}
                    // add other fields as needed
                ]
            ];
        });

        return response()->json([
            'status'=>true,
            "message"=>"Gift Card Fetched Successfully",
            "data"=>$giftCards,
        ]);
    }

    public function updateScratchedAt(Request $request) {
        try {
            if(!$request->input('gift_card_id')) {
                return response()->json([
                    'status'=>false,
                    'message'=>"Gift Card ID is required",
                ],400);
            }
            UserBirthdayGift::find($request->input('gift_card_id'))->update([
                'scratched_at'=>now(),
            ]);
            return response()->json([
                'status' => true,
                "message" => "Gift card scratch successfully",
            ]);
        }catch (Exception $e) {
            return response()->json([
                'status' => false,
                // 'error' => $e->getMessage(),
                'message' => "Some error occurred while fetching the account delete reasons. Please try again later.",
            ], 500);
        }
    }

    public function notificationList() {
        try {
            $notificationLists = DB::table('notifications')->where('notifiable_id',auth()->user()->id)->get('data');
            $cleanedData = [];

            foreach ($notificationLists as $notification) {
                $data = json_decode($notification->data, true); // Decode the JSON string
                if (isset($data['title'], $data['body'])) {
                    $cleanedData[] = [
                        'title' => $data['title'],
                        'body' => $data['body'],
                    ];
                }
            }
            return response()->json([
                'status' => true,
                "message" => "Notification Fetch Successfully",
                'data'=>$cleanedData,
            ]);
        }catch (Exception $e) {
            return response()->json([
                'status' => false,
                // 'error' => $e->getMessage(),
                'message' => "Some error occurred while fetching the account delete reasons. Please try again later.",
            ], 500);
        }
    }

    public function storeServiceRequest(ServiceFormRequest $request) {
            ServiceRequest::create([
            'user_id' => auth()->id(), // or $request->user_id if not using auth
            'type' => $request->input("type"),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Service request recorded successfully.',
        ]);
    }
}
