<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function student(){
        return $this->hasMany('App\Student');
    }

    public function teacher(){
        return $this->hasMany('App\Teacher');
    }

    public function project(){
        return $this->hasMany('App\Project');
    }
}
