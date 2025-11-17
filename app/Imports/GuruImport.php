<?php

namespace App\Imports;

use App\Models\Guru;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    /**
     * Map tiap baris Excel ke model Guru
     */
    public function model(array $row)
    {
        return new Guru([
            'nama' => $row['nama'] ?? null,
            'nip' => $row['nip'] ?? null,
            'jenis_kelamin' => $row['jenis_kelamin'] ?? null,
            'email' => $row['email'] ?? null,
            'telepon' => $row['telepon'] ?? null,
            'user_id' => Auth::id() ?? 1, // Default ke admin ID 1 jika tidak login
        ]);
    }
}
