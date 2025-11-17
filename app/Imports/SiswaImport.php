<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    private array $emails = [];
    private array $nises  = [];

    public function model(array $row)
    {
        /**
         * Validasi duplikat dalam file
         */
        if (in_array($row['email'], $this->emails)) {
            Log::warning('Email duplikat dalam file', ['email' => $row['email']]);
            return null;
        }
        if (in_array($row['nis'], $this->nises)) {
            Log::warning('NIS duplikat dalam file', ['nis' => $row['nis']]);
            return null;
        }

        $this->emails[] = $row['email'];
        $this->nises[]  = $row['nis'];

        /**
         * Cari kelas (case-insensitive, trim whitespace)
         */
        $kelasNama = trim($row['kelas']);

        $kelas = Kelas::whereRaw('LOWER(TRIM(nama)) = ?', [strtolower($kelasNama)])->first();

        if (!$kelas) {
            $kelastersedia = Kelas::orderBy('nama')->pluck('nama')->toArray();

            Log::error('Kelas tidak ditemukan', [
                'input' => $kelasNama,
                'tersedia' => $kelastersedia
            ]);

            throw ValidationException::withMessages([
                'kelas' => "Kelas '{$kelasNama}' tidak ditemukan. Kelas tersedia: "
                         . implode(', ', $kelastersedia),
            ]);
        }

        /**
         * Cegah email duplikat
         */
        $existingUser = User::where('email', $row['email'])->first();
        if ($existingUser) {
            throw ValidationException::withMessages([
                'email' => "Email {$row['email']} sudah digunakan oleh user lain.",
            ]);
        }

        /**
         * Cegah NIS duplikat
         */
        $existingSiswa = Siswa::where('nis', $row['nis'])->first();
        if ($existingSiswa) {
            throw ValidationException::withMessages([
                'nis' => "NIS {$row['nis']} sudah terdaftar.",
            ]);
        }

        /**
         * Buat akun User
         */
        $user = User::create([
            'name'     => $row['nama'],
            'email'    => $row['email'],
            'password' => Hash::make('password123'),
            'role_id'  => 3, // Role Siswa
        ]);

        Log::info('User berhasil dibuat', [
            'user_id' => $user->id,
            'email' => $user->email
        ]);

        /**
         * Buat data Siswa dengan kelas_id
         */
        $siswa = new Siswa([
            'nama'     => $row['nama'],
            'nis'      => $row['nis'],
            'kelas_id' => $kelas->id,
            'user_id'  => $user->id,
            'aktif'    => true,
        ]);

        Log::info('Siswa berhasil dibuat', [
            'siswa_id' => $siswa->id ?? 'pending',
            'nama' => $siswa->nama,
            'nis' => $siswa->nis,
            'kelas_id' => $siswa->kelas_id,
            'kelas_nama' => $kelas->nama,
            'user_id' => $siswa->user_id
        ]);

        return $siswa;
    }

    /**
     * Validasi format Excel
     */
    public function rules(): array
    {
        return [
            'nama'  => 'required|string|max:255',
            'nis'   => 'required|numeric|unique:siswas,nis',
            'kelas' => 'required|string',
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
        ];
    }

    /**
     * Pesan error kustom
     */
    public function customValidationMessages()
    {
        return [
            'nama.required'  => 'Kolom Nama wajib diisi.',
            'nama.max'       => 'Nama maksimal 255 karakter.',

            'nis.required'   => 'Kolom NIS wajib diisi.',
            'nis.unique'     => 'NIS sudah terdaftar di database.',

            'kelas.required' => 'Kolom Kelas wajib diisi.',

            'email.required' => 'Kolom Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan di database.',
        ];
    }
}
