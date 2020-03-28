<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherClassMap extends Model
{
    protected $table = 'teacher_class_map';


    public function classMain()
    {
        return $this->belongsTo('App\ClassMain','class_id','id');
    }
}
