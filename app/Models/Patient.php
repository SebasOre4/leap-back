<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'nickname', 'state', 'birthday', 'genre'];

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class, 'patient_id', 'id');
    }
}
