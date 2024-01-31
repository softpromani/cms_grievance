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
    
    public function subject()
    {
        return $this->belongsTo(GrievanceSubject::class);
    }

    public function grivuser()
    {
        return $this->belongsTo(GrievanceUser::class,'user_id');
    }
}
