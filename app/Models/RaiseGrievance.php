<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaiseGrievance extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function media(){
        return $this->morphMany(Media::class,'mediable');
    }

    public function applicant()
    {
        return $this->belongsTo(GrievanceUser::class,'user_id');
    }
    public function grievances()
    {
        return $this->hasMany(Tracking::class,'grievance_id');
    }
    public function subject(){
        return $this->belongsTo(GrievanceSubject::class,'subject_id','id');
    }
    
}
