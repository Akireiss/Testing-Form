<div>
    <div class="p-5 container mx-auto">

    <x-form title="Add Student Profile">

        <x-slot name="actions">

        </x-slot>
        <x-slot name="slot">

            <div class="container mx-auto">
                <form wire:submit.prevent="save">


                    <div x-data="{ isOpen: @entangle('isOpen'), studentName: @entangle('studentName') }">
                        <x-label for="studentName">
                          First Name
                        </x-label>
                        <div class="relative">
                            <x-input
                                wire:model.debounce.300ms="studentName"
                                @focus="isOpen = true"
                                @click.away="isOpen = false"
                                @keydown.escape="isOpen = false"
                                @keydown="isOpen = true"
                                type="text"
                                id="studentName"
                                name="studentName"
                                placeholder="Start typing to search..."
                            />
                            @error('studentId')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
                            <span
                                x-show="studentName !== ''"
                                @click="studentName = ''; isOpen = false"
                                class="absolute right-3 top-2 cursor-pointer text-red-600 font-bold"
                            >
                                &times;
                            </span>
                            @if ($studentName && count($students) > 0)
                                <ul
                                    class="bg-white border border-gray-300 mt-2 rounded-md w-full max-h-48 overflow-auto absolute z-10"
                                    x-show="isOpen"
                                >
                                    @foreach ($students as $student)
                                        <li
                                            class="px-4 py-2 cursor-pointer hover:bg-gray-200"
                                            wire:click="selectStudent('{{ $student->id }}', '{{ $student->first_name }} ')"
                                            x-on:click="isOpen = false"
                                        >
                                            {{ $student->first_name }} {{ $student->last_name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <input type="hidden" name="studentId" wire:model="studentId">
                    </div>



                    <div class="relative mb-3 px-4">
                        <x-label>
                            Last Name
                        </x-label>
                        <x-input wire:model="last_name" readonly/>
                    </div>




                    <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3">
                        Address
                    </h6>

                    <livewire:address />

                    <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3">
                        Parent
                    </h6>





                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 ">
                        Educational Background
                    </h6>

                    <!-- Repeat the structure for each grade level -->
                    @for ($gradeLevel = 7; $gradeLevel <= 12; $gradeLevel++)
                        <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3 text-gray-500">
                            Grade {{ $gradeLevel }}
                        </h6>
                        <x-grid columns="3" gap="4" px="0" mt="0">
                            <div class="relative mb-3 px-4">
                                <x-label for="name_{{ $gradeLevel }}">Name of school</x-label>
                                <x-input wire:model="education.{{ $gradeLevel }}.name"
                                    id="name_{{ $gradeLevel }}" />
                            </div>

                            <div class="relative mb-3 px-4">
                                <x-label for="section_{{ $gradeLevel }}">Section</x-label>
                                <x-input wire:model="education.{{ $gradeLevel }}.section"
                                    id="section_{{ $gradeLevel }}" />
                            </div>

                            <div class="relative mb-3 px-4">
                                <x-label for="school_year_{{ $gradeLevel }}">School Year</x-label>
                                <x-input wire:model="education.{{ $gradeLevel }}.school_year"
                                    id="school_year_{{ $gradeLevel }}" />
                            </div>
                        </x-grid>
                    @endfor


                    <!-- Add Alpine.js attributes to the first div -->
                    <div x-data="{ hasDisability: @entangle('hasDisability'), hasFoodAllergy: @entangle('hasFoodAllergy') }">
                        <div class="relative mb-3 px-4">
                            <x-label>
                                Do you have a disability?
                            </x-label>
                            <x-select x-on:change="hasDisability === 'Yes' ? $refs.disabilityInput.focus() : null"
                                wire:model="hasDisability">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </x-select>
                        </div>

                        <div class="relative mb-3 px-4" x-show="hasDisability === 'Yes'">
                            <x-label>
                                If yes, what is it?
                            </x-label>
                            <x-input x-ref="disabilityInput" wire:model="disability" />
                        </div>

                        <div class="relative mb-3 px-4">
                            <x-label>
                                Do you have a food allergy?
                            </x-label>
                            <x-select x-on:change="hasFoodAllergy === 'Yes' ? $refs.foodAllergyInput.focus() : null"
                                wire:model="hasFoodAllergy">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </x-select>
                        </div>

                        <div class="relative mb-3 px-4" x-show="hasFoodAllergy === 'Yes'">
                            <x-label>
                                If yes, what is your food allergy?
                            </x-label>
                            <x-input x-ref="foodAllergyInput" wire:model="foodAllergy" />
                        </div>
                    </div>


                    <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
                        Parent are currently: (check which applies below)
                    </h6>
                    <x-grid columns="3" gap="4" px="0" mt="0">
                        <div class="relative mb-3 px-4">
                            <x-checkbox wire:model="parent_statuses" value="Living together">Living together
                            </x-checkbox>
                        </div>
                        <div class="relative mb-3 px-4">
                            <x-checkbox wire:model="parent_statuses" value="Separated">Separated</x-checkbox>
                        </div>
                        <div class="relative mb-3 px-4">
                            <x-checkbox wire:model="parent_statuses" value="Legally Separated">Legally Separated
                            </x-checkbox>
                        </div>
                        <div class="relative mb-3 px-4">
                            <x-checkbox wire:model="parent_statuses" value="With another partner">With another partner
                            </x-checkbox>
                        </div>
                        <div class="relative mb-3 px-4">
                            <x-checkbox wire:model="parent_statuses" value="Father is OFW">Father is OFW</x-checkbox>
                        </div>
                        <div class="relative mb-3 px-4">
                            <x-checkbox wire:model="parent_statuses" value="Mother is OFW">Mother is OFW</x-checkbox>
                        </div>
                    </x-grid>


                    <h6 class="text-sm my-4 px-4 font-bold uppercase mt-3 text-gray-500">
                        Vitamins taken in
                    </h6>

                    <x-grid columns="3" gap="4" px="0" mt="0">
                        @for ($i = 1; $i <= 3; $i++)
                            <div class="relative mb-3 px-4">
                                <x-label for="vitamin_{{ $i }}">
                                    {{ $i }}
                                </x-label>
                                <x-input wire:model="vitamins.{{ $i }}" id="vitamin_{{ $i }}" />
                            </div>
                        @endfor
                    </x-grid>


                    <div x-data="{ siblings: @entangle('siblings') }">
                        <div class="flex items-center justify-between mt-4 mx-4">
                            <h6 class="text-sm font-bold uppercase">
                                List down the names of Siblings that are studying at CZCMNHS?
                            </h6>
                            <div class="relative mb-3 px-4">
                                <button type="button"
                                    @click="siblings.push({ name: '', age: '', gradeSection: '' })">
                                    Add Sibling
                                </button>

                                <button type="button" @click="siblings.pop()" class="bg-red-500 text-white">
                                    Remove
                                </button>
                            </div>
                        </div>

                        <template x-for="(sibling, index) in siblings" :key="index">
                            <x-grid columns="3" gap="4" px="0" mt="0">
                                <div class="relative mb-3 px-4">
                                    <x-label>
                                        Name
                                    </x-label>
                                    <x-input x-model="sibling.name" />
                                </div>

                                <div class="relative mb-3 px-4">
                                    <x-label>
                                        Age
                                    </x-label>
                                    <x-input x-model="sibling.age" />
                                </div>

                                <div class="relative mb-3 px-4">
                                    <x-label>
                                        Grade and Section
                                    </x-label>
                                    <x-input x-model="sibling.gradeSection" />
                                </div>
                            </x-grid>
                        </template>
                    </div>






                    <div class="flex justify-content-end">
                        @error('studentId')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        <button class="bg-gray-300 text-black px-4 py-1" type="submit">Submit</button>
                    </div>

                </form>
            </div>
        </x-slot>

    </x-form>


</div>



<!-- resources/views/livewire/save-student.blade.php -->
<x-table>
    <x-slot name="header">
        <th class="px-4 py-3">Student Full Name</th>
        <th class="px-4 py-3">Cases</th>
    </x-slot>

    @if ($studentName && count($cases) > 0)
        @foreach ($cases as $case)
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3">
                    {{ $studentName }}
                </td>
                <td class="px-4 py-3">
                    {{ $case->case }}
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td class="px-4 py-3" colspan="2">No student selected.</td>
        </tr>
    @endif
</x-table>



</div>
