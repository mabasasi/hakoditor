<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Hako;
use App\Models\Tag;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $article = Article::create([
            'title' => 'テスト記事',
            'url' => 'neko',
            'article_type_id' => \App\Consts::ARTICLE_TYPE_TEXT,
        ]);

        $hako_a = Hako::create([
            'hako_type_id' => \App\Consts::HAKO_TYPE_TEXT,
            'content' => '吾輩は猫である。'
        ]);

        $hako_b = Hako::create([
            'hako_type_id' => \App\Consts::HAKO_TYPE_TEXT,
            'content' => '名前はまだない。'
        ]);

        $hako_c = Hako::create([
            'hako_type_id' => \App\Consts::HAKO_TYPE_TEXT,
            'content' => '## 猫',
        ]);


        $article->hakos()->attach($hako_a, ['order' => 2]);
        $article->hakos()->attach($hako_b, ['order' => 3]);
        $article->hakos()->attach($hako_c, ['order' => 1]);

        $tag_bg = Tag::create([
            'name' => '文学',
        ]);

        $tag_ns = Tag::create([
            'name' => '夏目漱石',
            'parent_tag_id' => $tag_bg->id,
        ]);

        $article->tags()->attach([$tag_ns->id]);

    }
}
