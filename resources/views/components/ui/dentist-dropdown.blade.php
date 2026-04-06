<div class="flex flex-col gap-1">
    <label for="{{ $name }}">Assigned Dentist</label>
    <select 
        name="{{ $name }}" 
        id="{{ $name }}"
        {{ $required ?? '' }}
    >
        <option value="">
            {{ $dentists->isEmpty() ? 'No dentists available.' : 'Select a dentist.' }}
        </option>

        @foreach ($dentists as $dentist)
            <option 
                value="{{ $dentist->dentist_id }}"
                {{ old($name, $selected) == $dentist->dentist_id ? 'selected' : '' }}
            >
                Dr. {{ $dentist->full_name }}            
            </option>
        @endforeach
    </select>
</div>