<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller {

    public function index() {
        $articles = Article::all();

        return view('article.index')->with(compact('articles'));
    }

    public function create() {
        return $this->edit(new Article());
    }

    public function store(ArticleRequest $request) {
        return $this->update($request, new Article());
    }

    public function show(Article $article)    {
        return view('article.show')->with(compact('article'));
    }


    public function edit(Article $article) {
        intend();
        return view('article.edit')->with(compact('article'));
    }

    public function update(ArticleRequest $request, Article $article) {
        \DB::transaction(function() use($request, $article) {
            return $article->fill($article->translate($request))->save();
        });

        return \Redirect::intended('articles.index');
    }

    public function destroy(Article $article) {
        \DB::transaction(function() use($article) {
            return $article->delete();
        });

        return back();
    }
}
