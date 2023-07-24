<?php

namespace App\Filament\Resources\ListgameResource\Pages;

use App\Filament\Resources\ListgameResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateListgame extends CreateRecord
{
    protected static string $resource = ListgameResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
