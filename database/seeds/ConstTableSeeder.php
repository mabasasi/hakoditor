<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use App\Models\ArticleType;
use App\Models\Hako;
use App\Models\HakoType;
use App\Models\Tag;

class ConstTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            \DB::table('hako_types')->truncate();
            User::truncate();
            Article::truncate();
            Hako::truncate();
            HakoType::truncate();
            Tag::truncate();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::create([
            'name' => env('AUTH_USER_NAME'),
            'userid' => env('AUTH_USER_ID'),
            'email' => env('AUTH_USER_EMAIL'),
            'password' => Hash::make(env('AUTH_USER_PASSWORD')),
        ]);


        ArticleType::create([
            'id'   => \App\Consts::ARTICLE_TYPE_TEXT,
            'name' => 'テキスト',
        ]);

        ArticleType::create([
            'id'   => \App\Consts::ARTICLE_TYPE_HTML,
            'name' => 'HTML',
        ]);

        ArticleType::create([
            'id'   => \App\Consts::ARTICLE_TYPE_MARKDOWN,
            'name' => 'Markdown',
        ]);



        HakoType::create([
            'id'   => \App\Consts::ARTICLE_TYPE_TEXT,
            'name' => 'テキスト',
        ]);

    }
}
