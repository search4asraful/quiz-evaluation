<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'title',
        'starts_at',
        'ends_at',
        'description',
        'created_by',
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function submissions() {
        return $this->hasMany(Submission::class);
    }

    public function expired() {
        return now()->greaterThan($this->ends_at);
    }

    public function ongoing() {
        $now = now();
        return $now->greaterThanOrEqualTo($this->starts_at) && $now->lessThanOrEqualTo($this->ends_at);
    }
}
