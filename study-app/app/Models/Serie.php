<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    /**
     * Nome da tabela
     */
    protected $table = "serie";

    /**
     * Impede que o eloquent use timestamps defauls na tabela
     */
    public $timestamps = false;

    /**
     * Permite ser adicionado em forma de massa para 'Serie::create(array)'
     */
    protected $fillable = ["nome"];

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}
