<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Morilog\Jalali\Jalalian;

class Comment extends Model
{
    protected $guarded = [];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post():BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function getCreatedAtInJalai(): Jalalian
    {
        return Jalalian::forge($this->created_at);
    }


    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getApprovedStatusInParsi(): string
    {
        return !! $this->is_approved ? 'تایید شده' : 'تایید نشده';
    }
}
