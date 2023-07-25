<div>
    <x-grid columns="3" gap="4" px="0" mt="0">

        <div class="relative mb-3 px-4">
            <x-label>
                Province
            </x-label>
            <x-select class="form-control" id="city-select-birth" wire:model="selectedProvinceBirthFather">
                @foreach($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->province }}</option>
                @endforeach
            </x-select>
        </div>


        <div class="relative mb-3 px-4">
            <x-label>
                Municipality
            </x-label>
            <x-select class="form-control" id="municipality-select-birth" wire:model="selectedMunicipalityBirthFather">
                @foreach($municipalities as $municipality)
                <option value="{{ $municipality->id }}">{{ $municipality->municipality }}</option>
                @endforeach
            </x-select>
        </div>


        <div class="relative mb-3 px-4">
            <x-label>
                Barangay
            </x-label>
            <x-select class="form-control" id="barangay-select-birth" wire:model="selectedBarangayBirthFather">
                @foreach($barangays as $barangay)
                <option value="{{ $barangay->id }}">{{ $barangay->barangay }}</option>
                @endforeach
            </x-select>
        </div>

    </x-grid>


</div>
