@php
    $sexOptions = ['Male', 'Female'];
    $maritalStatusOptions = ['Single', 'Married', 'Widowed', 'Separated'];
@endphp

<x-forms.container
    action="{{ $action }}"
    method="POST"
    class="flex flex-col gap-2 w-1/4"
    enctype="multipart/form-data"
>
    @method($method ?? 'POST')

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded p-3">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li class="text-red-500 text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-col gap-1">
        <label for="image_filename">Patient Photo (Optional)</label>

        @if($patient->image_filename)
            <img src="{{ $patient->image_url }}"
                 alt="Current photo"
                 class="w-20 h-20 rounded-full object-cover"
            >
        @endif

        <input type="file" name="image_filename" id="image_filename" accept=".jpg,.jpeg,.png">
        <small>Max File Size: 10MB</small>
    </div>
    <div class="flex flex-col gap-1">
        <label for="first_name">First Name</label>
        <input 
            type="text" 
            name="first_name" 
            id="first_name" 
            value="{{ old('first_name', $patient->first_name) }}"
            required
        >
    </div>
    <div class="flex flex-col gap-1">
        <label for="last_name">Last Name</label>
        <input 
            type="text" 
            name="last_name" 
            id="last_name" 
            value="{{ old('last_name', $patient->last_name) }}"
            required
        >
    </div>
    <div class="flex flex-col gap-1">
        <label for="address">Address</label>
        <input 
            type="text" 
            name="address" 
            id="address" 
            value="{{ old('address', $patient->address) }}"
            required
        >
    </div>
    <div class="flex flex-col gap-1">
        <label for="contact_no">Contact Number</label>
        <input 
            type="text" 
            name="contact_no" 
            id="contact_no" 
            value="{{ old('contact_no', $patient->contact_no) }}"
            pattern="^09[0-9]{9}$" 
            required
        >
    </div>
    <div class="flex flex-col gap-1">
        <label for="date_of_birth">Birthdate</label>
        <input 
            type="date" 
            name="date_of_birth" 
            id="date_of_birth" 
            max="{{ now()->format('Y-m-d') }}" 
            value="{{ old('date_of_birth', $patient->date_of_birth?->format('Y-m-d')) }}"
            required
        >
    </div>
    <div class="flex flex-col gap-1">
        <label for="occupation">Occupation</label>
        <input 
            type="text" 
            name="occupation" 
            id="occupation"
            value="{{ old('occupation', $patient->occupation) }}"
        >
    </div>
    <div class="flex flex-col gap-1">
        <label for="guardian_name">Guardian Name (Optional)</label>
        <input 
            type="text" 
            name="guardian_name" 
            id="guardian_name"
            value="{{ old('guardian_name', $patient->guardian_name) }}"
        >
    </div>
    <div class="flex flex-col gap-1">
        <label for="sex">Sex</label>
        <select name="sex" id="sex">
            <option value="" disabled {{ old('sex', $patient->sex) ? '' : 'selected' }}>Select Sex</option>
            @foreach ($sexOptions as $option)
                <option 
                    value="{{ $option }}"
                    {{ old('sex', $patient->sex) === $option ? 'selected' : '' }}
                >
                   
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col gap-1">
        <label for="marital_status">Marital Status</label>
        <select name="marital_status" id="marital_status">
            <option value="" disabled  {{ old('marital_status', $patient->marital_status) ? '' : 'selected' }}>Select Marital Status</option>
            @foreach ($maritalStatusOptions as $option)
                <option value="{{ $option }}"
                    {{ old('marital_status', $patient->marital_status) === $option ? 'selected' : '' }}
                >
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>
    <x-ui.button 
        type="submit" 
        variant="primary" 
        class="px-1 py-3"
    >
        {{ $submitLabel }}
    </x-ui.button>
</x-forms.container>