<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Privacy extends Model
{
    use HasFactory;
    protected $with = ['privacy_translations'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang ?: (Session::get('locale') ?: env('DEFAULT_LANGUAGE'));
        $privacy_translation = $this->privacy_translations->where('lang', $lang)->first();
        return $privacy_translation ? $privacy_translation->$field : $this->$field;
    }

    public function privacy_translations(){
        return $this->hasMany(PrivacyTranslation::class);
    }
}
