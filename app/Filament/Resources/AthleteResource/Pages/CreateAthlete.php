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

    
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
    
    $age = $this->hitungUmur($data['date_of_birth']);
    $weight = $data['body_weight'];
    $height = $data['body_height'];
    $dribbling = $data['dribling'];
    $passing = $data['passing'];
    $shooting = $data['shooting'];
    $endurance = $data['endurance'];
    $recommendation = array_keys($this->calculate_position_score($age, $weight, $height, $dribbling, $passing, $shooting, $endurance));
    $data['recommendation_position'] = implode($recommendation);
    return $data;
    }

    function hitungUmur($tanggal_lahir) {
        list($year, $month, $day) = explode("-", $tanggal_lahir);
        $year_diff = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff = date("d") - $day;
        if ($month_diff < 0 || ($month_diff == 0 && $day_diff < 0)) {
            $year_diff--;
        }
        return $year_diff;
    }

    protected function calculate_position_score($age, $weight, $height, $dribbling, $passing, $shooting, $endurance) {
        // Pertimbangan bobot
        $weight_factor = 0.2;
        $height_factor = 0.1;
        $dribbling_factor = 0.25;
        $passing_factor = 0.25;
        $shooting_factor = 0.25;
        $endurance_factor = 0.25;

        // Normalisasi kriteria
        $age_normalized = (5 - $age) / 5;
        $weight_normalized = ($weight - 50) / 50;
        $height_normalized = ($height - 160) / 160;

        // Perhitungan skor posisi
        $center_forward_score = ($age_normalized * $weight_factor) + ($height_normalized * $height_factor) + ($shooting * $shooting_factor);
        $wing_forward_score = ($age_normalized * $weight_factor) + ($height_normalized * $height_factor) + ($dribbling * $dribbling_factor) + ($shooting * $shooting_factor);
        $second_striker_score = ($age_normalized * $weight_factor) + ($height_normalized * $height_factor) + ($dribbling * $dribbling_factor) + ($passing * $passing_factor) + ($shooting * $shooting_factor);
        $attacking_midfielder_score = ($age_normalized * $weight_factor) + ($height_normalized * $height_factor) + ($dribbling * $dribbling_factor) + ($passing * $passing_factor) + ($shooting * $shooting_factor);
        $center_midfielder_score = ($age_normalized * $weight_factor) + ($height_normalized * $height_factor) + ($dribbling * $dribbling_factor) + ($passing * $passing_factor);
        $defending_midfielder_score = ($age_normalized * $weight_factor) + ($height_normalized * $height_factor) + ($dribbling * $dribbling_factor) + ($passing * $passing_factor) + ($endurance * $endurance_factor);
        $right_back_score = ($age_normalized * $weight_factor) + ($height_normalized * $height_factor) + ($endurance * $endurance_factor);
        $left_back_score = ($age_normalized * $weight_factor) + ($height_normalized * $height_factor) + ($endurance * $endurance_factor);
        $sweeper_score = ($age_normalized * $weight_factor) + ($height_normalized * $height_factor) + ($endurance * $endurance_factor);
        $center_back_score = ($age_normalized * $weight_factor) + ($height_normalized * $height_factor) + ($endurance * $endurance_factor);
        $keeper_score = ($age_normalized * $weight_factor) + ($height_normalized * $height_factor) + ($endurance * $endurance_factor);

        // Mengembalikan skor tertinggi sebagai posisi rekomendasi
        $positions = [
            'Center Forward' => $center_forward_score,
            'Wing Forward' => $wing_forward_score,
            'Second Striker' => $second_striker_score,
            'Attacking Midfielder' => $attacking_midfielder_score,
            'Center Midfielder' => $center_midfielder_score,
            'Defending Midfielder' => $defending_midfielder_score,
            'Right Back' => $right_back_score,
            'Left Back' => $left_back_score,
            'Sweeper' => $sweeper_score,
            'Center Back' => $center_back_score,
            'Keeper' => $keeper_score
        ];

        arsort($positions);

        return array_slice($positions, 0, 1, true);
    }
}
