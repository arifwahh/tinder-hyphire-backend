<?php
// app/Models/Person.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    protected $fillable = [
        'name', 'age', 'location', 'latitude', 'longitude', 'like_count'
    ];

    protected $attributes = [
        'like_count' => 0,
    ];

    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class)->orderBy('position');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}