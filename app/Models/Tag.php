<?php

namespace App\Models;

class Tag extends Model {

    protected $guarded = [];

    public function getTagPathAttribute() {
        $paths = [$this->name];
        if ($this->tag_group_id) {
            $group = $this->tagGroup;
            array_unshift($paths, $group->name);

            while(true) {
                $group = $group->parentTagGroup;
                $name  = $group->name;
                if ($group and in_array($name, $paths)) {
                    array_unshift($paths, $name);
                } else {
                    break;
                }
            }
        }

        return $this->implode('/', $paths);
    }

    public function tagGroup() {
        return $this->belongsTo('App\Models\tagGroup');
    }

}
