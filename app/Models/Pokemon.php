<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemon';

    public function name()
    {
        return $this->hasMany('App\Models\SpeciesName', 'pokemon_species_id', 'species_id');
    }
}