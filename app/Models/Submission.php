<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['test_id', 'user_id', 'total_marks', 'obtained_marks'];

    public function test() {
        return $this->belongsTo(Test::class, 'test_id');
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }
    
    public function submittedBy() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
