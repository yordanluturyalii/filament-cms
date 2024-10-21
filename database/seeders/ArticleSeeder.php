<?php

namespace Database\Seeders;

use App\Enum\ArticleStatus;
use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i <= 13; $i++) {
            $article = new Article();
            $article->title = "Article $i";
            $article->slug = Str::slug($article->title);
            $article->content = Str::random(100);
            $article->status = ArticleStatus::DRAFT;
            $article->user_id = 1;
            $article->media_id = $i;
            $article->save();
        }
    }
}
