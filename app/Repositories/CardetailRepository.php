<?php

namespace App\Repositories;

use App\Models\CarDetail;

class CardetailRepository {

    public function store(array $data): CarDetail
    {
        // dd($data);
        return CarDetail::updateOrCreate(
            ['user_id' => $data['user_id']],
            $data
        );
    }
}
