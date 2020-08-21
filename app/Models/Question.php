<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['Category','exam_id'];
    protected $hidden = ['id','created_at','updated_at'];

    public function choose()
    {
        return $this->hasMany('App\Models\Choose','question_id','id');
    }

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam','exam_id','id');
    }
}
