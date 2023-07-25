<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;



class FatherAddress extends Component
{
    public $selectedProvinceBirthMother;
    public $selectedMunicipalityBirthMother;
    public $selectedBarangayBirthMother;
    public $municipalitiesBirthMother = [];
    public $barangaysBirthMother = [];
    public function render()
    {
        $provinces = Province::all();
        $municipalities = Municipal::where('province_id', $this->selectedProvinceBirthMother)->get();
        $barangays = Barangay::where('municipal_id', $this->selectedMunicipalityBirthMother)->get();
        return view('livewire.mother-address',compact('provinces', 'municipalities', 'barangays'));
    }
    public function updatedSelectedProvinceBirthMother($provinceId)
    {
        $this->municipalitiesBirthMother = Municipal::where('province_id', $provinceId)->get();
        $this->selectedMunicipalityBirthMother = null;
        $this->selectedBarangayBirthMother = null;
        $this->barangaysBirthMother = [];

        // Emit an event named 'birthDataUpdated' and pass the selected province ID and province data as data
        $this->emit('birthDataUpdated', [
            'provinceId' => $provinceId,
            'provinceData' => Province::find($provinceId),
            'municipalityId' => $this->selectedMunicipalityBirthMother, // Pass the selected municipality ID
            'barangayId' => $this->selectedBarangayBirthMother, // Pass the selected barangay ID
        ]);
    }

    public function updatedSelectedMunicipalityBirthMother($municipalityId)
    {
        $this->barangaysBirthMother = Barangay::where('municipal_id', $municipalityId)->get();
        $this->selectedBarangayBirthMother = null;

        // Emit an event named 'birthDataUpdated' and pass the selected municipality ID and municipality data as data
        $this->emit('birthDataUpdated', [
            'provinceId' => $this->selectedProvinceBirthMother, // Pass the selected province ID
            'provinceData' => Province::find($this->selectedProvinceBirthMother), // Pass the selected province data
            'municipalityId' => $municipalityId,
            'municipalityData' => Municipal::find($municipalityId),
            'barangayId' => $this->selectedBarangayBirthMother, // Pass the selected barangay ID
        ]);
    }

    public function updatedSelectedBarangayBirthMother($barangayId)
    {
        // Emit an event named 'birthDataUpdated' and pass the selected barangay ID and barangay data as data
        $this->emit('birthDataUpdated', [
            'provinceId' => $this->selectedProvinceBirthMother, // Pass the selected province ID
            'provinceData' => Province::find($this->selectedProvinceBirthMother), // Pass the selected province data
            'municipalityId' => $this->selectedMunicipalityBirthMother, // Pass the selected municipality ID
            'municipalityData' => Municipal::find($this->selectedMunicipalityBirthMother), // Pass the selected municipality data
            'barangayId' => $barangayId,
            'barangayData' => Barangay::find($barangayId),
        ]);
    }
}
