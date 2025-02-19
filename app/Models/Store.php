<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'region_id'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
