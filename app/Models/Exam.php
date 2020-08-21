<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['ExamName'];
    protected $hidden = ['created_at','updated_at'];

    public function question()
    {
        return $this->hasMany('App\Models\Question','exam_id','id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User','user_exam','exam_id','user_id','id','id')->withPivot('Degree');
    }
}
