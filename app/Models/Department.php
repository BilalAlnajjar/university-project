<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function generalPlan(){
        return  $this->hasOne(GeneralPlan::class);
    }

    public function subMajors(){
        return $this->belongsToMany(SubMajor::class,'department_sub_major');
    }
}
