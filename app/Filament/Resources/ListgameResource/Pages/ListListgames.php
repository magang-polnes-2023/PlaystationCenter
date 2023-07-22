<?php

namespace App\Filament\Resources\ListgameResource\Pages;

use App\Filament\Resources\ListgameResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListListgames extends ListRecords
{
    protected static string $resource = ListgameResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
