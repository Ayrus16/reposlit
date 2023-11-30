<?php

namespace App\Filament\Resources\ClubResource\Pages;

use App\Filament\Resources\ClubResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateClub extends CreateRecord
{
    protected static string $resource = ClubResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
