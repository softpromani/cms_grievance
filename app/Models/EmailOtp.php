<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailOtp extends Model
{
    use HasFactory;
    protected $fillable = ['email_id', 'otp', 'expiry_act','otp_count'];
}
