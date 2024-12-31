<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class ReturnAndRefund extends Model
{
    use HasFactory;
    protected $with = ['return_and_refund_translations'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang ?: (Session::get('locale') ?: env('DEFAULT_LANGUAGE'));
        $return_and_refund_translation = $this->return_and_refund_translations->where('lang', $lang)->first();
        return $return_and_refund_translation ? $return_and_refund_translation->$field : $this->$field;
    }

    public function return_and_refund_translations(){
        return $this->hasMany(ReturnAndRefundTranslation::class);
    }
}
