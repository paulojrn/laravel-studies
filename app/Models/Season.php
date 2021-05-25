<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = ['number'];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function viewedEpisodes(): Collection
    {
        return $this->episodes->filter(function($episode) {
            return $episode->viewed;
        });
    }
}
