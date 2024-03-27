<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['nombre'];

    public function juegos()
    {
        return $this->belongsToMany(Company::class, 'company_games', 'game_id', 'company_id')
            ->withPivot('stock', 'price');
    }
}
