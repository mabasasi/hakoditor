<?php

namespace App\Http\Controllers;

use App\Consts;
use App\Http\Requests\ArticleHandlingRequest;
use App\Models\Article;
use App\Models\Hako;
use Illuminate\Http\Request;

class ArticleHandlingController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }


    public function __invoke(ArticleHandlingRequest $request, Article $article) {
        \DB::transaction(function() use($request, $article) {
            $data = $request->all();

            // TODO とりあえず リレーション全削除
            $article->hakos()->detach();

            $syncs = [];

            $size = count($data['id']);
            for ($i=0; $i<$size; $i++) {
                $id      = data_get($data, 'id.'      .$i);
                $content = data_get($data, 'content.' .$i);
                $order   = data_get($data, 'order.'   .$i);

                // はこ の保存
                $hako = Hako::findOrNew($id);
                $hako->fill([
                    'hako_type_id' => Consts::HAKO_TYPE_TEXT,
                    'content'      => $content,
                ])->save();

                // 更新用配列追加
                $syncs[$id] = ['order' => $order];
            }

            // リレーション更新
            $article->hakos()->sync($syncs);

        });

        return back()->with('message', '保存しました.');
    }

}
