<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemon';

    public function species()
    {
        return $this->hasOne('App\Models\Species', 'id', 'species_id');
    }
}