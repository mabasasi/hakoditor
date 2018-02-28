<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }


    public function index() {
        $tags = Tag::all();

        return view('tag.index')->with(compact('tags'));
    }

    public function create() {
        return $this->edit(new Tag());
    }

    public function store(TagRequest $request) {
        return $this->update($request, new Tag());
    }

    public function show(Tag $tag)    {
        return view('tag.show')->with(compact('tag'));
    }


    public function edit(Tag $tag) {
        intend();
        return view('tag.edit')->with(compact('tag'));
    }

    public function update(TagRequest $request, Tag $tag) {
        \DB::transaction(function() use($request, $tag) {
            return $tag->fill($tag->translate($request))->save();
        });

        return \Redirect::intended('tag.index');
    }

    public function destroy(Tag $tag) {
        \DB::transaction(function() use($tag) {
            return $tag->delete();
        });

        return back();
    }
}
