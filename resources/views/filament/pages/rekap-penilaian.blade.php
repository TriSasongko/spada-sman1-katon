<x-filament::page>

    {{-- MODE REKAP --}}
    <x-filament::section>
        <x-slot name="heading">Pilih Mode Rekap</x-slot>

        <x-filament::input.select wire:model.live="mode">
            <option value="tanggal">Rekap Harian (Tanggal)</option>
            <option value="bulan">Rekap Bulanan</option>
            <option value="tahun">Rekap Tahunan</option>
            <option value="kelas">Rekap Per Kelas</option>
            <option value="mapel">Rekap Per Mapel</option>
            <option value="siswa">Rekap Per Siswa</option>
        </x-filament::input.select>
    </x-filament::section>

    {{-- INPUT DINAMIS SESUAI MODE --}}
    <div class="mt-4">

        @if ($mode === 'tanggal')
            <x-filament::input.wrapper>
                <x-filament::input type="date" wire:model.live="tanggal" />
            </x-filament::input.wrapper>
        @endif

        @if ($mode === 'bulan')
            <div class="flex gap-4">
                <x-filament::input.wrapper>
                    <x-filament::input.select wire:model.live="bulan">
                        @foreach ([
                            '01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni',
                            '07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'
                        ] as $num => $name)
                            <option value="{{ $num }}">{{ $name }}</option>
                        @endforeach
                    </x-filament::input.select>
                </x-filament::input.wrapper>

                <x-filament::input.wrapper>
                    <x-filament::input.select wire:model.live="tahun">
                        @for ($y = date('Y') - 5; $y <= date('Y'); $y++)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </x-filament::input.select>
                </x-filament::input.wrapper>
            </div>
        @endif

        @if ($mode === 'tahun')
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="tahun">
                    @for ($y = date('Y') - 5; $y <= date('Y'); $y++)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </x-filament::input.select>
            </x-filament::input.wrapper>
        @endif

        @if ($mode === 'kelas')
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="kelas_id">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach (\App\Models\Kelas::all() as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>
        @endif

        @if ($mode === 'mapel')
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="mapel_id">
                    <option value="">-- Pilih Mapel --</option>
                    @foreach (\App\Models\Mapel::all() as $m)
                        <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>
        @endif

        @if ($mode === 'siswa')
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="siswa_id">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach (\App\Models\Siswa::all() as $s)
                        <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>
        @endif

    </div>

    {{-- HASIL REKAP --}}
    <div class="space-y-4 mt-4">
        @forelse ($this->rekap as $item)
            <x-filament::card>
                <div class="grid grid-cols-2 gap-2">

                    <div>
                        <div><b>Tanggal:</b> {{ $item->tanggal }}</div>
                        <div><b>Kelas:</b> {{ $item->kelas->nama }}</div>
                        <div><b>Siswa:</b> {{ $item->siswa->nama }}</div>
                        <div><b>Kategori:</b> {{ $item->kategori }}</div>
                    </div>

                    <div>
                        <div><b>Mapel:</b> {{ $item->mapel->nama_mapel }}</div>
                        <div><b>Guru:</b> {{ $item->guru->nama }}</div>
                        <div><b>Nilai:</b> <b>{{ $item->nilai }}</b></div>
                        <div><b>Deskripsi:</b> {{ $item->deskripsi ?? '-' }}</div>
                    </div>

                </div>
            </x-filament::card>
        @empty
            <p class="text-gray-500 text-sm">Tidak ada data ditemukan.</p>
        @endforelse
    </div>

</x-filament::page>
