<x-filament::page>

    {{-- MODE SELECTOR --}}
    <div class="mb-4">
        <x-filament::input.wrapper>
            <x-filament::input.select wire:model.live="mode">
                <option value="tanggal">Rekap Harian</option>
                <option value="bulan">Rekap Bulanan</option>
                <option value="mapel">Rekap per Mapel</option>
                <option value="kelas">Rekap per Kelas</option>
                <option value="siswa">Rekap per Siswa</option>
            </x-filament::input.select>
        </x-filament::input.wrapper>
    </div>

    {{-- FILTERS DYNAMIC --}}
    <div class="flex gap-4 mb-4">

        @if ($mode === 'tanggal')
            <x-filament::input.wrapper>
                <x-filament::input type="date" wire:model.live="tanggal" />
            </x-filament::input.wrapper>
        @endif

        @if ($mode === 'bulan')
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="bulan">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ sprintf('%02d', $m) }}">
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endfor
                </x-filament::input.select>
            </x-filament::input.wrapper>

            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="tahun">
                    @for ($y = date('Y') - 5; $y <= date('Y') + 1; $y++)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </x-filament::input.select>
            </x-filament::input.wrapper>
        @endif

        @if ($mode === 'mapel')
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="mapel_id">
                    <option value="">-- Pilih Mapel --</option>
                    @foreach ($mapels as $m)
                        <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>

            <x-filament::input.wrapper>
                <x-filament::input type="date" wire:model.live="tanggal" />
            </x-filament::input.wrapper>
        @endif

        @if ($mode === 'kelas')
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="kelas_id">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelasList as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>
        @endif

        @if ($mode === 'siswa')
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="siswa_id">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach ($siswaList as $s)
                        <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>
        @endif

    </div>

    {{-- LIST DATA --}}
    <div class="space-y-4">
        @foreach ($this->rekap as $item)
            <x-filament::card>
                <div class="grid grid-cols-2 gap-2">

                    <div>
                        <div><b>Tanggal:</b> {{ $item->tanggal }}</div>
                        <div><b>Kelas:</b> {{ $item->kelas->nama }}</div>
                        <div><b>Siswa:</b> {{ $item->siswa->nama }}</div>
                        <div><b>Status:</b> {{ ucfirst($item->status) }}</div>
                    </div>

                    <div>
                        <div><b>Mapel:</b> {{ $item->mapel->nama_mapel }}</div>
                        <div><b>Guru:</b> {{ $item->guru->nama }}</div>
                        <div><b>Metode:</b> {{ $item->metode }}</div>
                    </div>

                </div>
            </x-filament::card>
        @endforeach
    </div>

</x-filament::page>
