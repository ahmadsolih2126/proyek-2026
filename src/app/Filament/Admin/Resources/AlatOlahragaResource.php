<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AlatOlahragaResource\Pages;
use App\Models\AlatOlahraga;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AlatOlahragaResource extends Resource
{
    protected static ?string $model = AlatOlahraga::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form {
        return $form->schema([
            Forms\Components\TextInput::make('nama_alat')->required(),
            Forms\Components\TextInput::make('kategori'),
            Forms\Components\TextInput::make('jumlah')->numeric(),
            Forms\Components\TextInput::make('harga')->numeric(),
            Forms\Components\Textarea::make('deskripsi')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table {
        return $table->columns([
            Tables\Columns\TextColumn::make('nama_alat')->searchable(),
            Tables\Columns\TextColumn::make('kategori'),
            Tables\Columns\TextColumn::make('jumlah'),
            Tables\Columns\TextColumn::make('harga'),
        ]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListAlatOlahragas::route('/'),
            'create' => Pages\CreateAlatOlahraga::route('/create'),
            'edit' => Pages\EditAlatOlahraga::route('/{record}/edit'),
        ];
    }
}