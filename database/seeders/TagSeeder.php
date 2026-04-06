<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'API',
            'Authentication',
            'JWT',
            'REST',
            'CRUD',
            'Database',
            'Eloquent',
            'Routing',
            'Middleware',
            'State Management',
            'Performance',
            'Testing',
            'Deployment',
            'Caching',
            'Security',
        ];

        foreach ($tags as $name) {
            Tag::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $name.' related posts',
            ]);
        }
    }
}
