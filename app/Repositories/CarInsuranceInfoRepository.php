<?php

namespace App\Repositories;

use App\Models\CarInsuranceInfo;

class CarInsuranceInfoRepository {

    public function store(array $data)
    {
        $checkCarInsurenceInfoExist = CarInsuranceInfo::where('car_detail_id', $data['car_detail_id'])->first();
        if(!is_null($checkCarInsurenceInfoExist)):
            $checkCarInsurenceInfoExist->delete();
        endif;
        $carInsurenceInfo = CarInsuranceInfo::create([
            'user_id'=>$data['user_id'],
            'car_detail_id'=>$data['car_detail_id'],
            'carrier'=>$data['carrier'],
            'policy_number'=>$data['policy_number'],
            'agent_name'=>$data['agent_name'],
        ]);
        return $carInsurenceInfo;
    }

    public function getCarInsuranceInfoByUserId(int $userId)
    {
        return CarInsuranceInfo::where('user_id', $userId)->with(['carInsuranceInfoImages'])->get();
    }

    public function getCarInsurenceInfoUsingCarDetailsId($carDetailsId) {
        return CarInsuranceInfo::where('car_detail_id', $carDetailsId)->with(['carInsuranceInfoImages'])->first();
    }


}
