<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produto extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = true;

    public function campanhas(): BelongsToMany
    {
        return $this->belongsToMany(Campanha::class);
    }
}
