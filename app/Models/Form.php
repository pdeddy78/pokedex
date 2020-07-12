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
}