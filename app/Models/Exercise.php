<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = ['treatment_id', 'game_id', 'game_config'];

    public function treatment(): BelongsTo
    {
        return $this->belongsTo(Treatment::class. 'treatment_id', 'id');
    }

    public function game(): HasOne
    {
        return $this->hasOne(Game::class . 'id', 'game_id');
    }
}
