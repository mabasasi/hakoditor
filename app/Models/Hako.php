<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hako extends Model {

    public function hakoType() {
        return $this->belongsTo('App\Models\HakoType');
    }

    public function users() {
        return $this->belongsToMany('App\Models\Article')->withPivot('order');
    }

}
