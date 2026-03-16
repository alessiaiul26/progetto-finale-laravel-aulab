<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Iphone 12',
                'description' => 'Iphone 12 128gb',
                'price' => 1000,
                'category_id' => 1, // elettronica
                'is_accepted' => true,
            ],
            [
                'title' => 'Maglietta',
                'description' => 'Maglietta nera',
                'price' => 10,
                'category_id' => 2, // abbigliamento
                'is_accepted' => true,
            ],
            [
                'title' => 'Il Signore degli Anelli',
                'description' => 'Trilogia completa',
                'price' => 20,
                'category_id' => 7, // Libri
                'is_accepted' => true,
            ],
            [
                'title' => 'National Geographic',
                'description' => 'Rivista di natura e scienza',
                'price' => 5,
                'category_id' => 8, // Riviste
                'is_accepted' => true,
            ],
            [
                'title' => 'Divano',
                'description' => 'Divano in pelle',
                'price' => 500,
                'category_id' => 3, // arredamento
                'is_accepted' => true,
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
