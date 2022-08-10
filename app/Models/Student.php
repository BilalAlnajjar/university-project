<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }

    public function customerPlan(){
        return $this->hasMany(CustomerPlan::class);
    }


}