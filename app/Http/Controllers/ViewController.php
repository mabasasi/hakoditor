<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ViewController extends Controller {

    public function __invoke(string $name) {
        // url か id から 記事を取得
        $article = Article::where(function($query) use($name) {
            return $query->where('url', $name)
                ->orWhere('id', $name);
        })->with('hakos')->firstOrFail();

        // 記事ジェネレート
        return view('article')->with(compact('article'));
    }

}
