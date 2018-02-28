<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller {

    public function index() {
        $articles = Article::ifRequestWhere('tag', ['tags.tag_id'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('blog.list')->with(compact('articles'));
    }

    public function page(string $name) {
        // url か id から 記事を取得
        $article = Article::where(function($query) use($name) {
            return $query->where('url', $name)
                ->orWhere('id', $name);
        })->with('hakos')->firstOrFail();

        // 記事ジェネレート
        return view('blog.page')->with(compact('article'));
    }

}
