<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Review extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'store_id',
        'image_url',
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function isFavoritedByUser()
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function region()
    {
        return $this->hasOneThrough(
            Region::class, // 取得したいモデル
            Store::class,  // 経由するモデル
            'id',          // stores.id（お店の ID）
            'id',          // regions.id（地方の ID）
            'store_id',    // reviews.store_id（レビューの店舗 ID）
            'region_id'    // stores.region_id（店舗の地方 ID）
        );
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->orderBy('created_at', 'desc'); // 新しい順、親コメントのみ取得
    }
}
