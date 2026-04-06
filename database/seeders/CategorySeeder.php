<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Web Development',
            'Laravel',
            'Next.js',
            'React',
            'Vue.js',
            'Mobile Development',
            'Flutter',
            'Data Science',
            'Machine Learning',
            'DevOps',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $name.' related articles',
            ]);
        }
    }
}
