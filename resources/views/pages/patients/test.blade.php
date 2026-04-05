@extends('layouts.layout')

@section('content')
    <a href="{{ route('patients.create') }}">Add</a>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded p-3">
            <p class="text-green-600 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded p-3">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li class="text-red-500 text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-col gap-4 w-full">
        @foreach ($patients as $patient)
            <div class="flex flex-col gap-1">
                <p>{{ $patient->first_name }} {{ $patient->last_name }}</p>
                <p>{{ $patient->address }}</p>
                <p>{{ $patient->contact_no }}</p>
                <img src="{{ $patient->image_url  }}" alt="Image of {{ $patient->first_name }}" class="w-32 h-32 rounded-full object-cover">
                <p>{{ $patient->date_of_birth->format('F d, Y') }}</p>
                <p>{{ $patient->occupation }}</p>
                <p>{{ $patient->marital_status }}</p>
                <p>{{ $patient->guardian_name }}</p>
                <p>{{ $patient->sex }}</p>
                <div class="flex gap-3">
                    <a href="{{ route('patients.show', $patient) }}">View</a>
                    <a href="{{ route('patients.edit', $patient) }}">Edit</a>
                    <x-forms.container
                        action="{{ route('patients.destroy', $patient) }}"
                        onsubmit="return confirm('Are you sure you want to remove this patient? This process is irreversible.')"
                        method="POST"
                    >
                        @method("DELETE")
                        <button type="submit">Delete</button>
                    </x-forms.container>
                </div>
            </div>
        @endforeach
        {{-- Temporary pagination only --}}
        <div>
            {{ $patients->links() }}
        </div>
    </div>
@endsection
