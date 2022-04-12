<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campanha extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = true;

    public function grupos(): HasMany
    {
        return $this->hasMany(Grupo::class);
    }

    public function produtos(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class);
    }
}
