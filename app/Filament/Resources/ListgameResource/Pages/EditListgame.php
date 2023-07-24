<?php

namespace App\Filament\Resources\ListgameResource\Pages;

use App\Filament\Resources\ListgameResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditListgame extends EditRecord
{
    protected static string $resource = ListgameResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
