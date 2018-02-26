<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    public function hakos() {
        return $this->belongsToMany('App\Models\Hako')->withPivot('order');
    }

}
