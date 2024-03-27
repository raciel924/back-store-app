<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'precio'];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_games', 'game_id', 'company_id')
            ->withPivot('stock', 'price');
    }
}
