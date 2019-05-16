<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function file(){
        return $this->hasMany('App\ProjectFile');
    }

    public function teacher(){
        return $this->belongsTo('App\Teacher');
    }

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function department(){
        return $this->belongsTo('App\Department');
    }
}
