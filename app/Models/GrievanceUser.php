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

    public function getUserNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    public function track(){
        return $this->morphMany(Tracking::class,'creatable');
    }
    public function user(){
        return $this->belongsToMany(GrievanceUser::class, 'id');
    }
}
