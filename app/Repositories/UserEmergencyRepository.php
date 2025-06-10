<?php


namespace App\Repositories;

use App\Models\UserEmergency;

class UserEmergencyRepository {

    public function getByUserId($userId)
    {
        return UserEmergency::where('user_id', $userId)->get();
    }

    public function create(array $data)
    {
        return UserEmergency::create($data);
    }

    public function update($id, array $data)
    {
        $emergency = UserEmergency::find($id);
        if ($emergency) {
            $emergency->update($data);
            return $emergency;
        }
        return null;
    }

    public function delete($id)
    {
        $emergency = UserEmergency::find($id);
        if ($emergency) {
            $emergency->delete();
            return true;
        }
        return false;
    }
}
