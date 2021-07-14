<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FeeCategoryAmount extends Model
{
    public function fee_category(){
        return $this->belongsTo(FeeCategory::class);
    }
    public function class(){
        return $this->belongsTo(StudentClass::class, 'class_id','id');
    }
}
