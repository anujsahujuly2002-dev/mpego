<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\CarDetail;
use App\Models\HealthInsurance;
use App\Models\CarInsuranceInfo;
use App\Models\TwoService;
use App\Models\UserEmergency;

class UserManagementRepository
{
    /**
     * Get all users.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllClients()
    {
        return User::whereDoesntHave('roles')->orWhereHas('roles',fn($q)=>$q->whereIn('name',['existing-client','prior-client','potential-client']))->latest();
    }

    /**
     * Find a user by ID.
     *
     * @param int $id
     * @return User|null
     */
    public function find(int $id)
    {
        return User::find($id);
    }

    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        return User::create($data);
    }

    public function getCarDetailByUserId($userId)
    {
        return CarDetail::where('user_id', $userId)->get();
    }

    public function getCarInsuranceInfoByUserId($userId)
    {
        return CarInsuranceInfo::where('user_id', $userId)->get();
    }

    public function getHealthInsuranceInfoByUserId($userId)
    {
        // Assuming you have a HealthInsuranceInfo model
        return HealthInsurance::where('user_id', $userId)->get();
    }

    public function getTwoServiceInfoByUserId($userId)
    {
        // Assuming you have a TwoServiceInfo model
        return TwoService::where('user_id', $userId)->get();
    }

    public function getEmergencyContactInfoByUserId($userId)
    {
        // Assuming you have an EmergencyContactInfo model
        return UserEmergency::where('user_id',$userId)->get();
    }

    public function store($data) {
        // dd($data);
        $user = User::create($data);
        $user->assignRole($data['role']);
        return $user;
    }

    public function getAllEmployees()
    {
        return User::whereHas('roles', fn($q) => $q->whereNotIn('name',['existing-client','prior-client','potential-client']))->latest();
    }

    public function update($data)
    {
        $user = User::find($data['id']);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }
}
