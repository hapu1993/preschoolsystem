<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = ['name','class_id','level_id','created_by','date'];



    public function creator()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

}
