<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function generalPlan(){
        return  $this->belongsTo(GeneralPlan::class,'general_plan_id');
    }

    public function subMajor(){
        return  $this->belongsTo(SubMajor::class,'sub_major_id');
    }

}
