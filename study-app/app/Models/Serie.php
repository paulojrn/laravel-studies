<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
    protected $fillable = ["nome", "capa"];

    /**
     * Mutator
     */
    public function getCapaUrlAttribute() {
        $capaName = "sem-foto.jpg";

        if (!is_null($this->capa)) {
            $capaName = $this->capa;
        }

        return Storage::url("serie/$capaName");
    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}
