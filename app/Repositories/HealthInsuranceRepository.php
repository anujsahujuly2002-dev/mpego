<?php

namespace App\Repositories;

use App\Models\HealthInsurance;

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
}
