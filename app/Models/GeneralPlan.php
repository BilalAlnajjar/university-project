<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralPlan extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function levels(){
        return $this->hasMany(Level::class);
    }

    public function department() {
        return $this->belongsTo(Department::class,'department_id');
    }
}
