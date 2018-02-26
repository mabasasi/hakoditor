<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HakoType extends Model {

    public function hakos() {
        return $this->hasMany('App\Models\Hako');
    }

}
