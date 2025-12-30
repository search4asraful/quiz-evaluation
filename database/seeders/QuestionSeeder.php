<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::create([
            'test_id' => 1,
            'question_text' => 'What is the capital of France?',
            'marks' => 5,
        ]);

        Question::create([
            'test_id' => 1,
            'question_text' => 'What is 2 + 2?',
            'marks' => 3,
        ]);

        Question::create([
            'test_id' => 1,
            'question_text' => 'Who wrote "Hamlet"?',
            'marks' => 4,
        ]);
    }
}
