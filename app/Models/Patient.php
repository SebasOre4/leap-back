<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'nickname', 'state', 'birthday', 'genre', 'user_id', 'nhc', 'prediagnosis', 'crono_birthday'];

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class, 'patient_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class. 'user_id', 'id');
    }

    public function scopeFullname(Builder $query, $fullname): void
    {
        $query->where('fullname', 'LIKE', "%$fullname%");
    }

    public function scopeNickname(Builder $query, $nickname): void
    {
        $query->where('nickname', 'LIKE', "%$nickname%");
    }

    public function scopeState(Builder $query, $state): void
    {
        $state ? $query->where('state', '=', $state) : $query;
    }

    public function scopeGenre(Builder $query, $genre): void
    {
        $genre ? $query->where('genre', '=', $genre) : $query;
    }

    public function scopeNhc(Builder $query, $nhc): void
    {
        $nhc ? $query->where('nhc', '=', $nhc) : $query;
    }
}
