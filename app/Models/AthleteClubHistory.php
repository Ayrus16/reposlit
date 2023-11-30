<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AthleteClubHistory extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function athletes(){
        return $this->belongsTo(Athlete::class);
    }
    public function club(){
        return $this->belongsTo(Club::class);
    }
}
