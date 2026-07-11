<?php

namespace App\Filament\Admin\Resources\AlatOlahragaResource\Pages;

use App\Filament\Admin\Resources\AlatOlahragaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAlatOlahragas extends ListRecords
{
    protected static string $resource = AlatOlahragaResource::class;

    protected function getHeaderActions(): array {
        return [Actions\CreateAction::make()];
    }
}