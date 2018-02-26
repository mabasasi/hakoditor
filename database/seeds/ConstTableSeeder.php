<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Hako;
use App\Models\HakoType;

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
            Article::truncate();
            Hako::truncate();
            HakoType::truncate();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        HakoType::create([
            'id'   => \App\Consts::HAKO_TYPE_TEXT,
            'name' => 'テキスト',
        ]);



    }
}
