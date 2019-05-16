<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function project(){
        return $this->hasMany('App\Project');
    }
    public function student(){
        return $this->hasMany('App\Student');
    }
}
