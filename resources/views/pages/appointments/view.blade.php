@extends('layouts.layout')

@section('content')
    <div class="flex gap-2">
        <a href="{{ route('appointments.edit', $appointment) }}">Edit Appointment</a>
        <button type="button" id="upload-btn">Add Procedure Images</button>
        <a href="{{ route('appointments.generate', $appointment) }}">Generate Certificate</a>
        <a href="{{ route('appointments.generate', $appointment) }}">Medical Form</a>
    
    </div>

    <div id="upload-form" class="hidden mt-4 p-4 rounded-lg bg-gray-50">
        <x-forms.container 
            action="{{ route('appointments.upload', $appointment) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4"
        >
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Select Images
                </label>

                <input type="file"
                    name="images[]"
                    multiple
                    class="block w-full text-sm border border-gray-300 rounded p-2 bg-white"
                    accept=".jpg,.png,.jpeg"
                >
            </div>
        </x-forms.container>
    </div>

    @include('pages.appointments.partials.procedure-form')
@endsection

@push('scripts')
    <script>
        const btn = document.getElementById('upload-btn');
        const form = document.getElementById('upload-form');

        btn.addEventListener('click', () => {
            form.classList.toggle('hidden');
        });
    </script>
@endpush
