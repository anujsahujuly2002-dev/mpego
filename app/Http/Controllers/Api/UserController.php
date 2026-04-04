<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function getProfile() {
        $user = auth()->user();
        return response()->json([
            'status'=>true,
            'message'=>"User profile retrieved successfully",
            'data'=>[
                'id'=>$user->id,
                'name'=>$user->name,
                'email'=>$user->email,
                'phone'=>$user->phone,
                'date_of_birth'=>$user->date_of_birth ? Carbon::parse($user->date_of_birth)->format('dS F Y') : null,
                'address'=>$user->address,
                'street_address'=>$user->street_address,
                'apt_suite'=>$user->apt_suite,
                'city'=>$user->city,
                'state'=>$user->state,
                'zip_code'=>$user->zip_code,
                'country'=>$user->country,
            ]
        ],200);
    }

    public function updateProfile(Request $request) {
        try {
            $user = auth()->user();
            $user->update($request->only('name','email','phone','date_of_birth','address','street_address','apt_suite','city','state','zip_code','country'));
            return response()->json([
                'status'=>true,
                'message'=>"User profile updated successfully",
            ],200);
        } catch (Exception $e) {
            Log::error("Failed to update user profile: " . $e->getMessage(),['stack'=>$e->getTraceAsString()]);
            return response()->json([
                'status'=>false,
                'message'=>"Failed to update user profile",
            ],500);
        }

    }
}
