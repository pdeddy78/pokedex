<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $table = 'pokemon_species';

    public function pokemons()
    {
        return $this->hasMany('App\Model\Pokemon', 'species_id', 'id');
    }

    public function generation()
    {
        return $this->hasOne('App\Model\Generation', 'id', 'generation_id');
    }
}