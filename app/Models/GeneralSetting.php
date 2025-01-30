<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    public function siteSeo()
    {
        return $this->hasMany(SiteSeo::class, 'general_setting_id', 'id');
    }
}
