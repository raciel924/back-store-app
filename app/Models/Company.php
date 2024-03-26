<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['nombre'];

    public function juegos()
    {
        return $this->belongsToMany(Games::class, 'company_games');
    }
}
