<?php

namespace App\Models;


class ArticleType extends Model {

    public function articles() {
        return $this->hasMany('App\Models\Article');
    }

}
