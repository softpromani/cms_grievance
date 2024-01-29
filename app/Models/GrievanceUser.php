<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrievanceUser extends Authenticatable
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_type',
        'unicode', 
        'first_name', 
        'last_name',
        'gender',
        'email',
        'mobile',
        'password',
        'course',
        'year_semester',
        'course_complete_date'
    ];
}
