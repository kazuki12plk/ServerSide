<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            ['name' => '名前', 'post' => '内容'],
            ['name' => 'なまえ', 'post' => 'ないよう']
        ]);
    }
}
