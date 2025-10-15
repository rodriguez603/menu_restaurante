<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Platillo extends Model
{
    public $timestamps = false;
    protected $table = 'platillos';
    protected $fillable = ['categoria_id','nombre','descripcion','ingredientes','imagen','precio'];

    protected $casts = ['precio' => 'decimal:2'];

    public function categoria(): BelongsTo {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
