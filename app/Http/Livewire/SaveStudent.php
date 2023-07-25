<?php

namespace App\Http\Livewire;

use App\Models\Anecdotal;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Models\Students;

class SaveStudent extends Component
{
    public $cases = [];
    public $last_name = '';
    public $studentName = '';
    public $studentId = null;
    public $isOpen = false;
    public $hasDisability = 'No';
    public $disability;
    public $hasFoodAllergy;
    public $foodAllergy;
    public $selectedProvinceBirth;
    public $selectedMunicipalityBirth;
    public $selectedBarangayBirth;
    public $type;
    public $father_name;
    public $father_type;
    public $mother_type;
    public $mother_name;
    public $parent_statuses = [];
    public $education = [];
    public $vitamins = [];
    public $validSelection;
    public $siblings = [
        ['name' => '', 'age' => '', 'gradeSection' => ''],
    ];

    public function mount()
    {
        if (empty($this->siblings)) {
            $this->siblings = [['name' => '', 'age' => '', 'gradeSection' => '']];
        }
    }

    public function addSibling()
    {
        $this->siblings[] = ['name' => '', 'age' => '', 'gradeSection' => ''];
    }

    public function removeSibling($index)
    {
        unset($this->siblings[$index]);
        $this->siblings = array_values($this->siblings);
    }

    protected $listeners = [
        'birthDataUpdated' => 'handleBirthDataUpdated',
        'resetForm'
    ];

    public function handleBirthDataUpdated($data)
    {
        $this->selectedProvinceBirth = $data['provinceId'];
        $this->selectedMunicipalityBirth = $data['municipalityId'];
        $this->selectedBarangayBirth = $data['barangayId'];

    }

    public function render()
    {
        $students = [];

        if (strlen($this->studentName) >= 3) {
            $students = Students::where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->studentName . '%')
                    ->orWhere('last_name', 'like', '%' . $this->studentName . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $this->studentName . '%']);
            })->get();
        }

        return view('livewire.save-student', compact('students'))->extends('app')->section('content');
    }

    public function selectStudent($id, $name)
    {

        $this->studentId = $id;
        $this->studentName = $name;
        //for the last name
        $this->last_name = Students::find($id)->last_name;
        $this->isOpen = false;

        $student = Students::find($id);
        if ($student) {
            $this->cases = $student->anecdotal;
        } else {
            $this->cases = [];
        }

    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen; // Toggle the dropdown visibility.
    }

    public function updatedStudentName($value)
    {
        if (empty($value)) {
            $this->resetForm();
        }
    }

    public function save()
    {
        if (empty($this->studentId)) {
            $this->addError('studentId', 'Please select a student.');
            return;
        }

        $selectedStudent = Students::find($this->studentId);

        if (!$selectedStudent) {
            $this->addError('studentId', 'Invalid student selected.');
            return;
        }

        $profile = Profile::create([
            'student_id' => $this->studentId,
            'dissability' => $this->hasDisability === 'Yes' ? $this->disability : 'No',
            'food_allergy' => $this->hasFoodAllergy === 'Yes' ? $this->foodAllergy : 'No',

        ]);

        foreach ($this->parent_statuses as $parent_status) {
            $profile->parentstatus()->create([
                'parent_status' => $parent_status
            ]);
        }

        foreach ($this->vitamins as $vitamin) {
            $profile->vitamins()->create([
                'vitamins' => $vitamin,
            ]);
        }


        foreach ($this->siblings as $sibling) {
            $profile->siblings()->create([
                'sibling_name' => $sibling['name'],
                'sibling_age' => $sibling['age'],
                'sibling_grade_section' => $sibling['gradeSection'],
            ]);
        }

        $profile->address()->create([
            'barangay_id' => $this->selectedBarangayBirth,
            'municipal_id' => $this->selectedMunicipalityBirth,
            'province_id' => $this->selectedProvinceBirth,
        ]);

        foreach ($this->education as $gradeLevel => $data) {
            $profile->education()->create([
                'grade_level' => $gradeLevel,
                'school_name' => $data['name'],
                'grade_section' => $data['section'],
                'school_year' => $data['school_year'],
            ]);
        }
        $this->resetForm();
        session()->flash('success', 'Profile and Address details saved successfully.');
    }

    private function resetForm()
    {
        $this->studentName = '';
        $this->studentId = '';
        $this->hasDisability = 'No';
        $this->disability = '';
        $this->hasFoodAllergy = 'No';
        $this->foodAllergy = '';
    }
}
