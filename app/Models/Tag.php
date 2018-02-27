<?php

namespace App\Models;

class Tag extends Model {

    protected $guarded = [];

    public function getTagPathAttribute() {
        $paths = [$this->name];
        $tag   = $this->tag;
        while (true) {
            $tag  = $tag->parentTag;
            $name = $tag->name;
            if ($name and in_array($paths, $name)) {
                array_unshift($paths, $name);
            } else {
                break;
            }
        }

        return $this->implode('/', $paths);
    }

    public function parentTag() {
        return $this->belongsTo('App\Models\Tag', 'parent_tag_id');
    }

    public function childTags() {
        return $this->hasMany('App\Models\Tag', 'parent_tag_id');
    }

}
