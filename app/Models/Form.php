<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'pokemon_forms';

    public function name()
    {
        return $this->hasMany('App\Models\FormName', 'pokemon_form_id', 'id');
    }

    public function localFormName($langId = 9)
    {
    	$query = $this->name()->where('local_language_id', $langId);
    	if (is_null($query->first())) {
    		return $this->name()->where('local_language_id', 9);
    	}

    	return $query;
    }
}