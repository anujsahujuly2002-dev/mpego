<?php


namespace App\Repositories;

use App\Models\AccidentInfo;

class AccidentRepository {
    public function create(array $data) {
        // Assuming you have an Accident model
        return AccidentInfo::create($data);
    }

    public function update($id, array $data) {
        $accident = AccidentInfo::findOrFail($id);
        $accident->update($data);
        return $accident;
    }

    public function delete($id) {
        $accident = AccidentInfo::findOrFail($id);
        return $accident->delete();
    }

    public function findById($id) {
        return AccidentInfo::with([ 'users','accidentSeceneImages','vehicalDahicalImages','carSeatsImages','InjuryImages','repairEstimateImages'])->findOrFail($id);
    }

    public function getPreviousAccidentByUserId($userId) {
        return AccidentInfo::where('user_id', $userId)->get();
    }

    public function all() {
        return AccidentInfo::with(['users'])->latest();
    }
}
