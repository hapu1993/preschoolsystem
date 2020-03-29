<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    protected $table = 'attendences';



    protected $fillable = ['student_id','date','attend','color'];

    public function student()
    {
        return $this->belongsTo('App\Student','student_id','id');
    }



}
