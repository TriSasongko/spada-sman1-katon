<?php

namespace App\Filament\Resources\Pengumumen\Schemas;

use App\Models\Guru;
use App\Models\Kelas;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class PengumumanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextInput::make('judul')->label('Judul Pengumuman')->required(),

            RichEditor::make('isi')->label('Isi Pengumuman')->required()->columnSpanFull(),

            FileUpload::make('file_path')
                ->label('Lampiran File')
                ->directory('pengumuman')
                ->preserveFilenames()
                ->maxSize(10240) // 10MB
                ->columnSpanFull(),

            Select::make('target')
                ->label('Kirim Pengumuman Ke')
                ->options([
                    'all_students' => 'Semua Siswa',
                    'all_gurus' => 'Semua Guru',
                    'all' => 'Semua (Guru + Siswa)',
                    'kelas' => 'Kelas Tertentu',
                    'guru' => 'Guru Tertentu',
                ])
                ->default('all_students')
                ->reactive(),

            Select::make('target_ids')
                ->label('Pilih Kelas / Guru (optional)')
                ->multiple()
                ->options(function ($get) {
                    $t = $get('target');
                    if ($t === 'kelas') {
                        return Kelas::orderBy('nama')->pluck('nama', 'id')->toArray();
                    }
                    if ($t === 'guru') {
                        return Guru::with('user')->get()->mapWithKeys(function ($g) {
                            return [$g->id => ($g->nama ?? ($g->user->name ?? 'Guru #' . $g->id))];
                        })->toArray();
                    }
                    return [];
                })
                ->visible(fn($get) => in_array($get('target'), ['kelas','guru'])),

            DateTimePicker::make('published_at')->label('Tanggal Publish (kosong = langsung)')
                ->timezone('Asia/Jakarta'),

            Toggle::make('kirim_notifikasi')
                ->label('Kirim Notifikasi')
                ->default(true),

            Toggle::make('ditampilkan')
                ->label('Tampilkan')
                ->default(true),
        ]);
    }
}
