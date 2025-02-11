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
    ];
}
