<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagCacheController extends Controller {

    public function __invoke() {
        foreach (Tag::all() as $tag) {
            $path  = '/'.$tag->getTagPath();
            $depth = mb_substr_count($path, '/');

            $ads = $tag->fill([
                'path' => $path,
                'depth' => $depth,
            ])->save();
        }

        return back();
    }

}
