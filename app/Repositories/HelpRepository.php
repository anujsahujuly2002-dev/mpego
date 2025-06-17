<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Models\AccountDeleteReason;

class HelpRepository   {

    public function store($request) {
        foreach ($request as $key => $value) {
            if ($key === '_token') {
                continue;
            }
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        return true;

    }

    public function getSettings() {
        return Setting::pluck('value', 'key')->toArray();
    }

    public function getAcountDeleteReasons() {
        return AccountDeleteReason::all();
    }

    public function getAccountDeleteReasonById($id) {
        return AccountDeleteReason::find($id);
    }

    public function accountDeleteReasonStore ($data) {
        return AccountDeleteReason::create($data);
    }

    public function  accountDeleteReasonUpdate($data,$id) {
        return AccountDeleteReason::find($id)->update($data);
    } 
}