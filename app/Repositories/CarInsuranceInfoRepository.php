<?php

namespace App\Repositories;

use App\Models\CarInsuranceInfo;

class CarInsuranceInfoRepository {

    public function store(array $data): CarInsuranceInfo
    {
        return CarInsuranceInfo::updateOrCreate(
            ['user_id' => $data['user_id']],
            $data
        );
    }
}
