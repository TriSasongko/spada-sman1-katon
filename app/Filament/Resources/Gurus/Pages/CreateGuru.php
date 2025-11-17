<?php

namespace App\Filament\Resources\Gurus\Pages;

use App\Filament\Resources\Gurus\GuruResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CreateGuru extends CreateRecord
{
    protected static string $resource = GuruResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Buat akun user otomatis
        $user = User::create([
            'name' => $data['nama'],          // gunakan nama guru
            'email' => $data['email'],         // gunakan email guru
            'password' => bcrypt('password123'),  // password default
            'role_id' => 2,                      // ROLE GURU
        ]);

        // Set user_id yg diperlukan tabel gurus
        $data['user_id'] = $user->id;

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = parent::handleRecordCreation($data);

        if (isset($data['kelasDiajar'])) {
            $record->kelasDiajar()->sync($data['kelasDiajar']);
        }

        return $record;
    }
}
