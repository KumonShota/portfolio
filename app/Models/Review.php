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
        'store_id'
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
}
