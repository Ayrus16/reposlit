<?php

namespace App\Filament\Resources\AthleteResource\Pages;

use App\Filament\Resources\AthleteResource;
use App\Models\Athlete;
use App\Models\AthleteSkill;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;


class CreateAthlete extends CreateRecord
{
    protected static string $resource = AthleteResource::class;
    // protected function handleRecordCreation(array $data): Model
    // {
    //     $athlete = Athlete::create([
    //         'name' => $data['name'],
    //         'date_of_birth' => $data['date_of_birth'],
    //         'body_weight' => $data['body_weight'],
    //         'body_height' => $data['body_height'],
    //     ]);
    //     //insert the student
        
        

    //     // Create a new Guardian model instance
    //     $skill = new AthleteSkill();
    //     $skill->dribling = $data['dribling'];
    //     $skill->passing = $data['passing'];
    //     $skill->shooting = $data['shooting'];
    //     $skill->endurance = $data['endurance'];

    //     $skill->athlete_id = $athlete->id; 

    //     $skill->save();


    //     return $athlete;
    // }

    protected function getRedirectUrl(): string
{
    return $this->previousUrl ?? $this->getResource()::getUrl('index');
}
}
