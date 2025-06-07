<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CarSeatsImage;
use App\Models\AccidentSceneImage;
use App\Models\VehicleDamageImage;
use App\Models\RepairEstimateImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarSeatsImageRequest;
use App\Http\Requests\VehicleDamageImageRequest;
use App\Http\Requests\RepairEstimateImageRequest;
use App\Repositories\Upload\UploadImageRepository;
use App\Http\Requests\Api\AccidentSceneImageRequest;

class AccidentImageController extends Controller
{

    public function accidentSceneImage(AccidentSceneImageRequest $request) {
        $userId = auth()->user()?auth()->user()->id:$request->input('user_id');
        $directory = "upload/accident-scene-image/".$userId;
        foreach($request->file('images') as $file):
            $image = New UploadImageRepository($file,$directory);
            $imageName = $image->upload();
            AccidentSceneImage::create([
                'user_id'=>$userId,
                'images'=>$imageName
            ]);
        endforeach;
        return response()->json([
            'status'=>true,
            'message'=>"Accident scene image uploaded successfully",
        ],200);
    }


    public function vehicleDamageImage (VehicleDamageImageRequest $request) {
        $userId = auth()->user() ? auth()->user()->id : request()->input('user_id');
        $directory = "upload/vehicle-damage-image/" . $userId;
        foreach ($request->file('images') as $file) {
            $image = new UploadImageRepository($file, $directory);
            $imageName = $image->upload();
            VehicleDamageImage::create([
                'user_id' => $userId,
                'images' => $imageName
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => "Vehicle damage image uploaded successfully",
        ], 200);

    }

    public function repairEstimateImage(RepairEstimateImageRequest $request) {
        $userId = auth()->user() ? auth()->user()->id : request()->input('user_id');
        $directory = "upload/repair-estimate-image/" . $userId;
        foreach ($request->file('images') as $file):
            $image = new UploadImageRepository($file, $directory);
            $imageName = $image->upload();
            RepairEstimateImage::create([
                'user_id' => $userId,
                'images' => $imageName
            ]);

        endforeach;
        return response()->json([
            'status' => true,
            'message' => "Repair estimate image uploaded successfully",
        ], 200);

    }

    public function carSeatsImage(CarSeatsImageRequest $request) {

        $userId = auth()->user() ? auth()->user()->id : request()->input('user_id');
        $directory = "upload/car-seats-image/" . $userId;
        foreach ($request->file('images') as $file) {
            $image = new UploadImageRepository($file, $directory);
            $imageName = $image->upload();
            CarSeatsImage::create([
                'user_id' => $userId,
                'images' => $imageName
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => "Car seats image uploaded successfully",
        ], 200);

    }
}
