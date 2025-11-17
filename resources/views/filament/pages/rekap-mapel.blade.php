<x-filament::page>

    <div class="flex gap-4 mb-4">

        {{-- PILIH MAPEL --}}
        <div>
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="mapel_id">
                    <option value="">-- Pilih Mapel --</option>
                    @foreach ($mapels as $m)
                        <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>
        </div>

        {{-- PILIH TANGGAL --}}
        <div>
            <x-filament::input.wrapper>
                <x-filament::input type="date" wire:model.live="tanggal" />
            </x-filament::input.wrapper>
        </div>
    </div>

    <div class="space-y-4">
        @foreach ($this->rekap as $item)
            <x-filament::card>
                <div class="grid grid-cols-2 gap-2">

                    <div>
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
