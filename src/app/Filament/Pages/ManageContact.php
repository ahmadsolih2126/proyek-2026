<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;

class ManageContact extends Page implements HasForms
{
    use InteractsWithForms; //

    // Ini buat nampilin icon telepon di menu admin panel lu
    protected static ?string $navigationIcon = 'heroicon-o-phone'; //
    protected static ?string $title = 'Setting Kontak Admin'; //
    protected static string $view = 'manage-contact'; //

    public ?array $data = []; //

    public function mount(): void
    {
        // Mengisi form kosongan di awal (atau lu bisa ambil data lama dari DB di sini)
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Di sini tempat lu naruh inputan form-nya, bro. 
                // Gua contohin pake No Telepon & Email dulu, nanti tinggal lu sesuaikan.
                TextInput::make('telepon')
                    ->label('Nomor Telepon/WA')
                    ->required(),

                TextInput::make('email')
                    ->label('Email Admin')
                    ->email()
                    ->required(),

                Textarea::make('alamat')
                    ->label('Alamat Kantor')
                    ->rows(3),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->submit('save'), // 👈 INI DIA FIX-NYA, BRO! Sekarang udah gua sumpal pake kata 'save'
        ];
    }

    public function save(): void
    {
        // Ambil data yang diketik di form
        $input = $this->form->getState();

        // 💡 Catatan: Di sini nanti lu tinggal tambahin logic buat nyimpen ke Database lu.
        // Contoh: Setting::updateOrCreate(['key' => 'contact'], ['value' => $input]);

        // Nampilin notifikasi sukses di pojok kanan atas browser
        Notification::make()
            ->title('Berhasil disave!')
            ->success()
            ->send();
    }
}