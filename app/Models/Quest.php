<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Quest extends Model
{
    protected $fillable = [
        'guild_id',
        'slug',
        'type',
        'title',
        'summary',
        'mission',
        'systems',
        'reward',
        'active',
        'weight',
    ];

    protected $casts = [
        'systems' => 'array',
        'active' => 'boolean',
    ];

    public const TYPES = ['MAIN QUEST', 'BOSS QUEST', 'SIDE QUEST', 'CURRENT QUEST', 'TUTORIAL QUEST'];

    public function guild(): BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withPivot('position')->orderByPivot('position');
    }
}
