<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guild extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'period',
        'weight',
    ];

    public function quests(): HasMany
    {
        return $this->hasMany(Quest::class)->orderBy('weight');
    }
}
