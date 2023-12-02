<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Athlete extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $guarded = [];
    public function athleteInjuryHistory(){
        return $this->hasMany(AthleteInjuryHistory::class);
    }
    public function athleteClubHistory(){
        return $this->hasMany(AthleteClubHistory::class);
    }
}
