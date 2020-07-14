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

    public function localPokemonName($langId = 9)
    {
    	$query = $this->name()->where('local_language_id', $langId);
    	if (is_null($query->first())) {
    		return $this->name()->where('local_language_id', 9);
    	}

    	return $query;
    }
}