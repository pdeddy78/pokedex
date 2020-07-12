<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $table = 'pokemon_species';

    public function name()
    {
        return $this->hasMany('App\Models\SpeciesName', 'pokemon_species_id', 'id');
    }

    public function pokemons()
    {
        return $this->hasMany('App\Models\Pokemon', 'species_id', 'id');
    }

    public function generation()
    {
        return $this->hasOne('App\Models\Generation', 'id', 'generation_id');
    }
}