<?php

namespace App\Models;

class TagGroup extends Model {

    protected $guarded = [];

    public function tags() {
        return $this->hasMany('App\Models\Tag');
    }

    public function parentTagGroup() {
        return $this->belongsTo('App\Models\TagGroup', 'parent_tag_group_id');
    }

    public function childTagGroups() {
        return $this->hasMany('App\Models\TagGroup', 'parent_tag_group_id');
    }

}
