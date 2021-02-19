<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'name'
    ];
    public function disciplina(){
        return $this->hasMany('\App\Disciplina');
    } 
}
