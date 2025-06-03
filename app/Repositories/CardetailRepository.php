<?php

namespace App\Repositories;

use App\Models\CarDetail;

class CardetailRepository {

    public function store(array $data): CarDetail
    {
        return CarDetail::updateOrCreate(
            ['user_id' => $data['user_id']],
            $data
        );
    }

    public function getCarDetailsByUserId(int $userId): ?CarDetail
    {
        return CarDetail::where('user_id', $userId)->with(['carImages'])->first();
    }

    public function getCarDetailsById(int $id): ?CarDetail
    {
        return CarDetail::find($id);
    }

    public function deleteCarDetail(int $id): bool
    {
        $carDetail = CarDetail::find($id);
        if ($carDetail) {
            return $carDetail->delete();
        }
        return false;
    }
}
