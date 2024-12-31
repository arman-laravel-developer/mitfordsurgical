<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class ReturnAndRefundTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['return', 'lang', 'return_and_refund_id'];

    public function returnAndRefund(){
        return $this->belongsTo(ReturnAndRefund::class, 'return_and_refund_id');
    }
}
