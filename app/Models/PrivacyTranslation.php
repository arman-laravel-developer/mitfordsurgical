<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['privacy','condition', 'lang', 'privacy_id'];

    public function privacy(){
        return $this->belongsTo(Privacy::class);
    }
}
