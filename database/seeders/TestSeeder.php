<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Test::create([
            'title' => 'Sample Test',
            'starts_at' => now(),
            'ends_at' => now()->addHours(4),
            'description' => 'This is a sample test description.',
            'created_by' => 1,
        ]);

        Test::create([
            'title' => 'Sample Test 2',
            'starts_at' => now()->addHour(2),
            'ends_at' => now()->addHours(12),
            'description' => 'This is a sample test 2 description.',
            'created_by' => 1,
        ]);

        Test::create([
            'title' => 'Sample Test 2',
            'starts_at' => now()->subHours(24),
            'ends_at' => now()->subHours(12),
            'description' => 'This is a sample test 2 description.',
            'created_by' => 1,
        ]);
    }
}
