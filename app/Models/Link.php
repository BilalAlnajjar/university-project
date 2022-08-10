<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subMajors(){
        return $this->belongsToMany(SubMajor::class,'sub_subject_link');
    }
}
