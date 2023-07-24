<?php

namespace App\Filament\Resources\PlaystationResource\Pages;

use App\Filament\Resources\PlaystationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlaystations extends ListRecords
{
    protected static string $resource = PlaystationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
