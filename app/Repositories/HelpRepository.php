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
}