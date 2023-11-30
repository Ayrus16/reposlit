<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function AthleteClubHistory(){
        return $this->hasMany(AthleteClubHistory::class);
    }
}
