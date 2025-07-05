<?php


namespace App\Repositories;

use App\Models\AccidentInfo;
use App\Models\OtherDriverId;
use App\Models\AccidentContact;
use App\Models\DriverInsurance;
use App\Models\DriversRegistrationCard;

class AccidentRepository {
    public function create(array $data) {
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
        return AccidentInfo::with([ 'users','accidentSeceneImages','vehicalDahicalImages','carSeatsImages','InjuryImages','repairEstimateImages','accidentContact'])->findOrFail($id);
    }

    public function getPreviousAccidentByUserId($userId) {
        return AccidentInfo::where('user_id', $userId)->latest()->with(['users','accidentSeceneImages','vehicalDahicalImages','carSeatsImages','InjuryImages','repairEstimateImages','accidentContact','policeReportImage','otherDriverId','otherDriverInsurances','carDetails.carImages','carInsurenceInfo.carInsuranceInfoImages','otherDriverRegistrationCard'])->get();
    }

    public function all() {
        return AccidentInfo::with(['users'])->latest();
    }

    public function createAccidentContact($data,$accidentId,$userId) {
        return AccidentContact::create([
            'user_id'=>$userId,
            "accident_id"=>$accidentId,
            "name"=>$data['name'],
            'contact_no'=>$data['contact_no']
        ]);
    }

    public function otherDriverId($data) {
        return OtherDriverId::create([
            'accident_id'=>$data['accident_id'],
            'name'=>$data['name'],
            "license_no"=>$data['license_no'],
            'image'=>$data['fileName'],
        ]);
    }

    public function driverInsurance($data) {
        return DriverInsurance::create([
            'accident_id'=>$data['accident_id'],
            'member_name'=>$data['member_name'],
            "member_id"=>$data['member_id'],
            'image'=>$data['fileName']
        ]);
    }

    public function driverRegistrationCard($data){
        return DriversRegistrationCard::create([
            'accident_id'=>$data['accident_id'],
            'name'=>$data['name'],
            'registration_no'=>$data['registration_no'],
            'image'=>$data['fileName']
        ]);
    }

    public function carDetailAndCarInsurence($data) {
        return AccidentInfo::where('id',$data->accident_info_id)->update([
            'car_detail_id'=>$data->car_detail_id,
            'car_insurence_info_id'=>$data->car_insurence_info_id
        ]);
    }

}
