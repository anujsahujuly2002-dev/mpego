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

    public function getCarInsuranceInfoByUserId(int $userId): ?CarInsuranceInfo
    {
        return CarInsuranceInfo::where('user_id', $userId)->with(['carInsuranceInfoImages'])->first();
    }
}
