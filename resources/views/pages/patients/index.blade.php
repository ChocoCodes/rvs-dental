@extends('layouts.layout')

@section('content')
    <div class="w-full h-full px-4 pb-4 grid grid-cols-12 gap-4">
        <div id="patient-info" class="h-content col-span-12 md:h-full md:col-span-5 lg:col-span-4 font-sans border border-border rounded-xl flex justify-center items-center overflow-hidden">
            <p class="font-mono text-base text-primary w-1/2 text-center">CLICK ON PATIENT TO DISPLAY INFO</p>
        </div>

        <div class="h-content md:h-full col-span-12 md:col-span-7 lg:col-span-8 flex flex-col overflow-auto border border-border rounded-xl">
            <div class="bg-[#E1E3E4] p-5 flex justify-between items-center gap-2 sticky top-0 z-50">
                <div class="relative flex items-center w-full max-w-sm bg-white rounded-lg">
                    <span class="absolute left-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M16.6 18L10.3 11.7C9.8 12.1 9.225 12.4167 8.575 12.65C7.925 12.8833 7.23333 13 6.5 13C4.68333 13 3.14583 12.3708 1.8875 11.1125C0.629167 9.85417 0 8.31667 0 6.5C0 4.68333 0.629167 3.14583 1.8875 1.8875C3.14583 0.629167 4.68333 0 6.5 0C8.31667 0 9.85417 0.629167 11.1125 1.8875C12.3708 3.14583 13 4.68333 13 6.5C13 7.23333 12.8833 7.925 12.65 8.575C12.4167 9.225 12.1 9.8 11.7 10.3L18 16.6L16.6 18ZM6.5 11C7.75 11 8.8125 10.5625 9.6875 9.6875C10.5625 8.8125 11 7.75 11 6.5C11 5.25 10.5625 4.1875 9.6875 3.3125C8.8125 2.4375 7.75 2 6.5 2C5.25 2 4.1875 2.4375 3.3125 3.3125C2.4375 4.1875 2 5.25 2 6.5C2 7.75 2.4375 8.8125 3.3125 9.6875C4.1875 10.5625 5.25 11 6.5 11Z" fill="#CCE0E0"/>
                        </svg>
                    </span>
                    <x-forms.input type="text" name="search" placeholder="Search Patient..." class="p-2 pl-10 w-full" />
                </div>
                <x-ui.button variant="primary" class="rounded-lg">
                    <a href="{{ route('patients.create') }}" class="w-full h-full">Add</a>
                </x-ui.button>
            </div>
            @foreach ($patients as $patient)
                <div
                    class="patient-row flex justify-between items-start p-5 hover:bg-secondary cursor-pointer"
                    data-patient-id="{{ $patient->patient_id }}"
                    data-patient='@json($patient)'
                >
                    <div class="flex flex-col items-start fonts-sans">
                        <p class="font-bold text-xl">{{ $patient->first_name }} {{ $patient->last_name }}</p>
                        <p>{last appointment agenda}</p>
                    </div>
                    <p class="font-mono text-xs text-black/20 text-right">{appointment date and time}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
