<?php

namespace App\Http\Controllers\Api;

use App\Models\InjuryImage;
use Illuminate\Http\Request;
use App\Models\CarSeatsImage;
use App\Models\PoliceReportImage;
use App\Models\AccidentSceneImage;
use App\Models\VehicleDamageImage;
use App\Models\RepairEstimateImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\injuryImageRequest;
use App\Http\Requests\CarSeatsImageRequest;
use App\Http\Requests\VehicleDamageImageRequest;
use App\Http\Requests\RepairEstimateImageRequest;
use App\Repositories\Upload\UploadImageRepository;
use App\Http\Requests\Api\PoliceReportImageRequest;
use App\Http\Requests\Api\AccidentSceneImageRequest;

class AccidentImageController extends Controller
{

    public function accidentSceneImage(AccidentSceneImageRequest $request) {
        $userId = auth()->user()?auth()->user()->id:$request->input('user_id');
        $directory = "upload/accident-scene-image/".$userId.'/'.$request->input('accident_id');
        foreach($request->file('images') as $file):
            $image = New UploadImageRepository($file,$directory);
            $imageName = $image->upload();
            AccidentSceneImage::create([
                'accident_id'=>$request->input('accident_id'),
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
        $directory = "upload/vehicle-damage-image/" . $userId.'/'.$request->input('accident_id');
        foreach ($request->file('images') as $file) {
            $image = new UploadImageRepository($file, $directory);
            $imageName = $image->upload();
            VehicleDamageImage::create([
                'accident_id' => $request->input('accident_id'),
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
        $directory = "upload/repair-estimate-image/" . $userId. '/' . $request->input('accident_id');
        foreach ($request->file('images') as $file):
            $image = new UploadImageRepository($file, $directory);
            $imageName = $image->upload();
            RepairEstimateImage::create([
                'accident_id' => $request->input('accident_id'),
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
        $directory = "upload/car-seats-image/" . $userId. '/' . $request->input('accident_id');
        foreach ($request->file('images') as $file) {
            $image = new UploadImageRepository($file, $directory);
            $imageName = $image->upload();
            CarSeatsImage::create([
                'accident_id' => $request->input('accident_id'),
                'user_id' => $userId,
                'images' => $imageName
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => "Car seats image uploaded successfully",
        ], 200);

    }

    public function injuryImage(injuryImageRequest $request) {
        $userId = auth()->user() ? auth()->user()->id : request()->input('user_id');
        $directory = "upload/injury-image/" . $userId. '/' . $request->input('accident_id');
        foreach ($request->file('images') as $file) {
            $image = new UploadImageRepository($file, $directory);
            $imageName = $image->upload();
            InjuryImage::create([
                'accident_id' => $request->input('accident_id'),
                'user_id' => $userId,
                'images' => $imageName
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => "Injury image uploaded successfully",
        ], 200);
    }


    public function policeReportImage(PoliceReportImageRequest $request) {
        $userId = auth()->user() ? auth()->user()->id : request()->input('user_id');
        $directory = "upload/police-report-image/" . $userId. '/' . $request->input('accident_id');
        foreach ($request->file('images') as $file) {
            $image = new UploadImageRepository($file, $directory);
            $imageName = $image->upload();
            PoliceReportImage::create([
                'accident_id' => $request->input('accident_id'),
                'user_id' => $userId,
                'image' => $imageName
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => "police report image uploaded successfully",
        ], 200);
    }

    public function deleteAccidentSceneImage(Request $request) {
        if($request->missing('id')) {
            return response()->json([
                'status' => false,
                'message' => "Image ID is required",
            ], 422);
        }
        $image = AccidentSceneImage::find($request->input('id'));
        if ($image) {
            $image->delete();
            return response()->json([
                'status' => true,
                'message' => "Accident scene image deleted successfully",
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => "Image not found",
        ], 404);
    }

    public function deleteVehicleDamageImage(Request $request) {
        if($request->missing('id')) {
            return response()->json([
                'status' => false,
                'message' => "Image ID is required",
            ], 422);
        }
        $image = VehicleDamageImage::find($request->input('id'));
        if ($image) {
            $image->delete();
            return response()->json([
                'status' => true,
                'message' => "Vehicle damage image deleted successfully",
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => "Image not found",
        ], 404);
    }

    public function deleteRepairEstimateImage(Request $request) {
        if($request->missing('id')) {
            return response()->json([
                'status' => false,
                'message' => "Image ID is required",
            ], 422);
        }
        $image = RepairEstimateImage::find($request->input('id'));
        if ($image) {
            $image->delete();
            return response()->json([
                'status' => true,
                'message' => "Repair estimate image deleted successfully",
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => "Image not found",
        ], 404);
    }

    public function deleteCarSeatsImage(Request $request) {
        if($request->missing('id')) {
            return response()->json([
                'status' => false,
                'message' => "Image ID is required",
            ], 422);
        }
        $image = CarSeatsImage::find($request->input('id'));
        if ($image) {
            $image->delete();
            return response()->json([
                'status' => true,
                'message' => "Car seats image deleted successfully",
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => "Image not found",
        ], 404);
    }

    public function deleteInjuryImage(Request $request) {
        if($request->missing('id')) {
            return response()->json([
                'status' => false,
                'message' => "Image ID is required",
            ], 422);
        }
        $image = InjuryImage::find($request->input('id'));
        if ($image) {
            $image->delete();
            return response()->json([
                'status' => true,
                'message' => "Injury image deleted successfully",
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => "Image not found",
        ], 404);
    }

    public function deletePoliceReportImage(Request $request) {
        if($request->missing('id')) {
            return response()->json([
                'status' => false,
                'message' => "Image ID is required",
            ], 422);
        }
        $image = PoliceReportImage::find($request->input('id'));
        if ($image) {
            $image->delete();
            return response()->json([
                'status' => true,
                'message' => "Police report image deleted successfully",
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => "Image not found",
        ], 404);
    }


}
