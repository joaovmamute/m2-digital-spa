<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grupo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = true;

    public function campanha(): BelongsTo
    {
        return $this->belongsTo(Campanha::class);
    }

    public function cidades(): HasMany
    {
        return $this->hasMany(Cidade::class);
    }
}
