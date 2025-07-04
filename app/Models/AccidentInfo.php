<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccidentInfo extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'user_type',
        'accident_date',
        'accident_time',
        'who_was_with_you',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function getUserTypeAttribute($value) {
        return ucfirst($value);
    }

    public function getAccidentDateAttribute($value) {
        return date('M dS Y', strtotime($value));
    }

    public function getAccidentTimeAttribute($value) {
        return date('H:i', strtotime($value));
    }

    public function accidentSeceneImages() {
        return $this->hasMany(AccidentSceneImage::class, 'accident_id', 'id');
    }

    public function vehicalDahicalImages() {
        return $this->hasMany(VehicleDamageImage::class, 'accident_id', 'id');
    }

    public function carSeatsImages() {
        return $this->hasMany(CarSeatsImage::class, 'accident_id', 'id');
    }

    public function InjuryImages() {
        return $this->hasMany(InjuryImage::class, 'accident_id', 'id');
    }

    public function repairEstimateImages() {
        return $this->hasMany(RepairEstimateImage::class, 'accident_id', 'id');
    }

    public function accidentContact() {
        return $this->hasMany(AccidentContact::class,"accident_id","id");
    }

    public function policeReportImage() {
        return $this->hasMany(PoliceReportImage::class,'accident_id','id');
    }

    public function otherDriverId() {
        return $this->hasOne(OtherDriverId::class,'accident_id','id');;
    }

    public function otherDriverInsurances(){
        return $this->hasOne(DriverInsurance::class,'accident_id','id');
    }

    public function carDetails() {
        return $this->belongsTo(CarDetail::class,'car_detail_id','id');
    }

    public function carInsurenceInfo() {
        return $this->belongsTo(CarInsuranceInfo::class,'car_insurence_info_id','id');
    }

}
