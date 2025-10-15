<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    public $timestamps = false;
    protected $table = 'categorias';
    protected $fillable = ['nombre','slug'];

    public function platillos(): HasMany {
        return $this->hasMany(Platillo::class, 'categoria_id');
    }
}
