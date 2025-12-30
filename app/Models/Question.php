<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['test_id', 'question_text', 'marks'];
    
    public function options() {
        return $this->hasMany(Option::class);
    }
}
