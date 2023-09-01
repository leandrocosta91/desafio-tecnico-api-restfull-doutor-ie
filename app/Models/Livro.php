<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livros';
    public $timestamps = false;

    protected $fillable = [
        'usuario_publicador_id',
        'titulo'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_publicador_id' , 'id');
    }

    public function indices(): HasMany
    {
        return $this->hasMany(Indice::class);
    }
}
