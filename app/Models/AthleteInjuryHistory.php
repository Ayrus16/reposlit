<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AthleteInjuryHistory extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function athletes(){
        return $this->belongsTo(Athlete::class);
    }
}
