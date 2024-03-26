<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyGame extends Model
{
    protected $fillable = ['stock', 'price', 'company_id', 'juego_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function juego()
    {
        return $this->belongsTo(Games::class);
    }
}
