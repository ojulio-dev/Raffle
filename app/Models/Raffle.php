<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Raffle extends Model
{
    
    use HasFactory;

    public function applicants(): HasMany
    {

        return $this->hasMany(Applicant::class);

    }

    public function winners(): HasMany
    {

        return $this->hasMany(Winner::class);

    }

}
