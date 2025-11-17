<x-filament::page>

    <div class="flex gap-4 items-end mb-4">
        <div>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="date"
                    wire:model.live="tanggal"
                />
            </x-filament::input.wrapper>
        </div>
    </div>

    <div class="space-y-4">
        @foreach ($this->rekap as $item)
            <x-filament::card>
                <div class="flex justify-between">
                    <div>
                        <div><b>Kelas:</b> {{ $item->kelas->nama }}</div>
                        <div><b>Mapel:</b> {{ $item->mapel->nama_mapel }}</div>
                        <div><b>Siswa:</b> {{ $item->siswa->nama }}</div>
                        <div><b>Status:</b> {{ ucfirst($item->status) }}</div>
                    </div>
                    <div>
                        <b>Guru:</b> {{ $item->guru->nama }}
                    </div>
                </div>
            </x-filament::card>
        @endforeach
    </div>

</x-filament::page>
