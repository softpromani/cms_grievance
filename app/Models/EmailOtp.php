<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailOtp extends Model
{
    use HasFactory;
    protected $fillable = ['Email_id', 'otp', 'expiry_act','otp_count'];
}
