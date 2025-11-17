<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation
{
    private array $emails = [];   // Menyimpan email dalam file Excel
    private array $nises  = [];   // Menyimpan NIS dalam file Excel

    public function model(array $row)
    {
        /** --------------------------
         *  VALIDASI DUPLIKAT DALAM FILE
         * --------------------------- */
        if (in_array($row['email'], $this->emails)) {
            return null; // Abaikan baris duplikat
        }
        if (in_array($row['nis'], $this->nises)) {
            return null; // Abaikan baris NIS duplikat
        }

        $this->emails[] = $row['email'];
        $this->nises[]  = $row['nis'];

        /** --------------------------
         *  VALIDASI KELAS HARUS SUDAH ADA
         * --------------------------- */
        $kelas = Kelas::where('nama', $row['kelas'])->first();

        if (! $kelas) {
            throw ValidationException::withMessages([
                'kelas' => "Kelas '{$row['kelas']}' tidak ditemukan. Silakan buat dulu di menu Kelas.",
            ]);
        }

        /** --------------------------
         *  CEGAH USER DUPLIKAT
         * --------------------------- */
        $existingUser = User::where('email', $row['email'])->first();
        if ($existingUser) {
            throw ValidationException::withMessages([
                'email' => "Email {$row['email']} sudah digunakan.",
            ]);
        }

        /** --------------------------
         *  BUAT USER
         * --------------------------- */
        $user = User::create([
            'name'     => $row['nama'],
            'email'    => $row['email'],
            'password' => Hash::make('password123'),
        ]);

        /** --------------------------
         *  BUAT DATA SISWA
         * --------------------------- */
        return new Siswa([
            'nama'     => $row['nama'],
            'nis'      => $row['nis'],
            'kelas_id' => $kelas->id,
            'user_id'  => $user->id,
            'aktif'    => true,
        ]);
    }

    /** --------------------------
     *  VALIDASI FORMAT EXCEL
     * --------------------------- */
    public function rules(): array
    {
        return [
            'nama'  => 'required|string',
            'nis'   => 'required|string|unique:siswas,nis',
            'kelas' => 'required|string',

            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama.required'  => 'Nama wajib diisi.',
            'nis.required'   => 'NIS wajib diisi.',
            'nis.unique'     => 'NIS sudah terdaftar.',
            'kelas.required' => 'Kelas wajib diisi.',

            'email.unique'   => 'Email sudah digunakan di database.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ];
    }
}
