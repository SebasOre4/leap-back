<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'nickname', 'state', 'birthday', 'genre', 'user_id'];

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class, 'patient_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class. 'user_id', 'id');
    }
}
