<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function athleteInjuryHistory(){
        return $this->hasMany(AthleteInjuryHistory::class);
    }
    public function athleteClubHistory(){
        return $this->hasMany(AthleteClubHistory::class);
    }
}
