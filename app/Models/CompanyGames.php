<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyGames extends Model
{
    protected $fillable = ['stock', 'price', 'company_id', 'game_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function juego()
    {
        return $this->belongsTo(Games::class);
    }
}
