<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class GrievanceSubject extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function users()
    {
        return $this->belongsToMany(User::class, 'assign_subjects');
    }
    public function grievances()
    {
        return $this->hasMany(RaiseGrievance::class, 'subject_id');
    }
    public function media(){
        return $this->morphOne(Media::class,'mediable');
    }

    
}
