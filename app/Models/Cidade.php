<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cidade extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = true;

    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class);
    }
}
