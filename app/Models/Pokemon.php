<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemon';

    public function species()
    {
        return $this->hasOne('App\Model\Species', 'id', 'species_id');
    }
}