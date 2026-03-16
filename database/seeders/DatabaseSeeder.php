<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public $categories = [
        'elettronica',
        'abbigliamento',
        'arredamento',
        'giocattoli',
        'sport',
        'animali domestici',
        'Libri',
        'Riviste',
        'accessori',
        'motori',
    ];
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }

        $this->call([
            ArticleSeeder::class,
        ]);
    }
}
