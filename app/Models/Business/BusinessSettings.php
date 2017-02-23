<?php

namespace App\Models\Business;

use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Model;

class BusinessSettings extends Model
{
    public static function createSetting(Business $business, $name, $value)
    {
        $setting = new self;
        $setting->name          = $name;
        $setting->value         = $value;
        $setting->business_id   = $business->id;

        $setting->save();
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
