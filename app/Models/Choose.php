<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choose extends Model
{
    protected $fillable = ['Question','OptionText','Points','Answer','question_id'];
    protected $hidden = ['question_id ','created_at','updated_at'];

    public  function question()
    {
        return $this->belongsTo('App\Models\Question','question_id','id');
    }

    public function getOptionTextAttribute($val)
    {
        $value = explode(",",$val);
        return $value;
    }
}
