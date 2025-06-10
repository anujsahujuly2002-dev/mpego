<?php


namespace App\Http\Helper;

use App\Models\Setting;

class GeneralHelper {

    public static function getSettingValue($settingKey) {
        $settingRec = Setting::where('key', $settingKey)->first();
        return ($settingRec) ? $settingRec->value : null;
    }
}