<?php

namespace App\Repositories;

use App\Models\HealthInsurance;
use App\Models\medical;

class HealthInsuranceRepository {

    public function store($data)  :HealthInsurance
    {
        return HealthInsurance::updateOrCreate(
            ['user_id' => $data['user_id']],
            $data
        );
    }

    public function getHealthInsuranceInfoUsingUserId($userId) :?HealthInsurance
    {
        return HealthInsurance::where('user_id', $userId)->with(['healthInsuranceImages'])->first();
    }


    public function mediCalStore($data) {
        return medical::updateOrCreate(
            ['user_id' => $data['user_id']],
            $data
        );
    }

    public function getMedicalInfoUsingUserId($userId){
        return medical::where("user_id",$userId)->with(['medicalImages'])->first();
    }


}
