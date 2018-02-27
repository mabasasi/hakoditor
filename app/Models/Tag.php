<?php

namespace App\Models;

use Illuminate\Http\Request;

class Tag extends Model {

    protected $guarded = [];

    public function translate(Request $request) {
        $array = $request->except('_token');
        if (data_get($array, 'parent_tag_id') == 0) {
            data_set($array, 'parent_tag_id', null);
        }
        return $array;
    }

    public function getTagPathAttribute() {
        $paths = [$this->name];
        $tag   = $this->tag;
        while ($tag) {
            $tag  = $tag->parentTag;
            $name = $tag->name;
            if ($name and in_array($paths, $name)) {
                array_unshift($paths, $name);
            } else {
                break;
            }
        }

        return implode('/', $paths);
    }

    public function parentTag() {
        return $this->belongsTo('App\Models\Tag', 'parent_tag_id');
    }

    public function childTags() {
        return $this->hasMany('App\Models\Tag', 'parent_tag_id');
    }

}
