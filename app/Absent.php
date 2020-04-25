<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    protected $table = 'absence_letters';

    protected $fillable = ['reg_no','student_id','from','to','reason'];

    public function parent()
    {
        return $this->belongsTo('App\User', 'parent_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }

}
