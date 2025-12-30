<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Option::create([
            'question_id' => 1,
            'option_text' => 'Paris',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => 1,
            'option_text' => 'London',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => 1,
            'option_text' => 'Berlin',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => 2,
            'option_text' => '3',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => 2,
            'option_text' => '4',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => 2,
            'option_text' => '5',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => 3,
            'option_text' => 'Charles Dickens',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => 3,
            'option_text' => 'William Shakespeare',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => 3,
            'option_text' => 'Mark Twain',
            'is_correct' => false,
        ]);
    }
}
