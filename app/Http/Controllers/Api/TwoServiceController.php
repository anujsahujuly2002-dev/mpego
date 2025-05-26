<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\TwoServiceImage;
use App\Http\Controllers\Controller;
use App\Repositories\TwoServiceRepository;
use App\Http\Requests\Api\TwoServiceRequest;
use App\Http\Requests\Api\TwoServiceImageRequest;
use App\Repositories\Upload\UploadImageRepository;

class TwoServiceController extends Controller
{
    private $twoServiceRepository;
    public function __construct()
    {
        $this->twoServiceRepository = New TwoServiceRepository();
    }
    /**
     * Store two service information.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function twoServiceInfo(TwoServiceRequest $request) {
        $userId = auth()->user()?auth()->user()->id:$request->input('user_id');
        $data = $request->only(['membership_number', 'tow_contact_info', 'emergency_contact_1','emergency_contact_2']);
        $data['user_id'] = $userId;
        $checkTwoServiceExists = $this->twoServiceRepository->getByUserId($userId);
        if($checkTwoServiceExists):
            $twoService = $this->twoServiceRepository->update($checkTwoServiceExists->id,$data);
        else:
            $twoService = $this->twoServiceRepository->create($data);
        endif;
        if(!empty($request->file('tow_service_card'))):
            $twoService = $this->twoServiceRepository->getByUserId($userId);
            $checkImageExists = TwoServiceImage::where('two_services_id',$twoService->id)->get();
            if($checkImageExists->count() >0):
                $checkImageExists->each(fn($q)=>$q->delete());
            endif;
            $directory = "upload/two-service-image/".$userId;
            foreach($request->file('tow_service_card') as $file):
                $image = New UploadImageRepository($file,$directory);
                $imageName = $image->upload();
                TwoServiceImage::create([
                    'two_services_id'=>$twoService->id,
                    'image'=>$imageName
                ]);
            endforeach;
        endif;
        if( $twoService):
            return response()->json([
                'status'=>true,
                'message'=>"Two service info store succssfully",
            ],200);
        else:
            return response()->json([
                'status'=>true,
                'message'=>"Two service info not store, Please try again",
            ],500);
        endif;
    }
}
