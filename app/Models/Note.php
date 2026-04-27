<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;
    // 1. Change 'user_id' to 'userId' to match your migration
    protected $fillable = ['title', 'content', 'user_id'];

    /**
     * Get the user that owns the note.
     */
    public function user(): BelongsTo
    {
        // 2. You must tell Laravel to use 'userId' as the foreign key
        return $this->belongsTo(User::class, 'user_id');
    }
}