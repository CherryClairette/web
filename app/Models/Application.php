<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    protected $fillable = ["post_id", "user_id", "message_sent"];

    public function user() {
        return $this ->belongsTo(User::class, 'user_id');
    }
    public function post() { 
        return $this->belongsTo(Post::class, 'post_id');
    }
}
