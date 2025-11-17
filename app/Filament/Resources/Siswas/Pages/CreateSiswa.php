<?php

namespace App\Filament\Resources\Siswas\Pages;

use App\Filament\Resources\Siswas\SiswaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSiswa extends CreateRecord
{
    protected static string $resource = SiswaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = \App\Models\User::create([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $data['user_id'] = $user->id;

        unset($data['email'], $data['password']);

        return $data;
    }

}
