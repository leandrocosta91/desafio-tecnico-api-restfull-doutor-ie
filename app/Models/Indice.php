<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Indice extends Model
{
    use HasFactory;

    protected $table = 'indices';
    public $timestamps = false;

    protected $fillable = [
        'livro_id',
        'indice_pai',
        'titulo',
        'pagina'
    ];

    public function livro(): BelongsTo
    {
        return $this->belongsTo(Livro::class);
    }

    public function indices()
    {
        return $this->hasMany(Indice::class, 'indice_pai', 'id');
    }
}
