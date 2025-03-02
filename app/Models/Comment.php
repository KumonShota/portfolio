<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['review_id', 'user_id', 'parent_id', 'content'];

    // ✅ コメントは1つのレビューに属する
    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    // ✅ コメントは1人のユーザーに属する
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ 親コメント（元のコメント）
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // ✅ 返信コメント（このコメントに対する返信）
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at', 'desc'); // 新しい順に表示
    }
}
