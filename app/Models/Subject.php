<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customerPlans(){
       return $this->belongsToMany(CustomerPlan::class,'subject_customer_plan');
    }

    public function levels(){
        return $this->belongsToMany(Level::class,'level_subject');
    }

    public function generalPlans(){
        return  $this->belongsToMany(GeneralPlan::class,'subject_general_plane');
    }

    public function subSubjects(){
        return $this->hasMany(SupSubject::Class);
    }
}
