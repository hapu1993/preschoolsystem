<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    protected $table = 'students';


    public function parent()
    {
        return $this->belongsTo('App\User','id','parent_id');
    }

    public function attendence()
    {
        return $this->hasMany('App\Attendence','student_id','id');
    }

    public function attendenceByDate($date = null)
    {
        if($date == null){
            $date = Carbon::today();
        }
        return $this->attendence()->whereDate('date',$date);
    }


}
