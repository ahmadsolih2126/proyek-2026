<?php

namespace App\Filament\Admin\Resources\AlatOlahragaResource\Pages;

use App\Filament\Admin\Resources\AlatOlahragaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAlatOlahraga extends EditRecord
{
    protected static string $resource = AlatOlahragaResource::class;

    protected function getHeaderActions(): array {
        return [Actions\DeleteAction::make()];
    }
}