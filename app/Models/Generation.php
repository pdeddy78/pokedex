<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    protected $table = 'generations';

    public function name()
    {
        return $this->hasMany('App\Models\GenerationName', 'generation_id', 'id');
    }

    public function localGenerationName($langId = 9)
    {
    	$query = $this->name()->where('local_language_id', $langId);
    	if (is_null($query->first())) {
    		return $this->name()->where('local_language_id', 9);
    	}

    	return $query;
    }
}