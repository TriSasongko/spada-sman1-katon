<x-filament::page>

    <div class="flex gap-4 mb-4">

        {{-- PILIH BULAN --}}
        <div>
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="bulan">
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </x-filament::input.select>
            </x-filament::input.wrapper>
        </div>

        {{-- PILIH TAHUN --}}
        <div>
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="tahun">
                    @for ($y = date('Y') - 5; $y <= date('Y'); $y++)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </x-filament::input.select>
            </x-filament::input.wrapper>
        </div>

    </div>


    {{-- LISTING DATA --}}
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
