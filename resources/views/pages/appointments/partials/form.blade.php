<x-forms.container
    action="{{ $action }}"
    method="POST"
    class="flex flex-col gap-2 w-3/10"
>
    @method($method ?? 'POST')
    @php
        $status = ['Schedules', 'Completed', 'Cancelled', 'No Show'];
        $slots = ['Morning (9AM-12PM)', 'Afternoon (1PM-6PM)'];
    @endphp
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded p-3">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li class="text-red-500 text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex gap-2">
        {{-- Patient Name --}}   
        <x-forms.patient-search />
    </div>
 
    {{-- Dentist in charge --}}
    <x-ui.dentist-dropdown :selected="$appointment->dentist_id"/>

    <div class="flex gap-2">
        {{-- Appointment Date --}}
        <div class="flex flex-col gap-1 w-full md:flex-1">
            <label for="scheduled_at" class="font-bold text-sm md:text-base">Appointment Date</label>
            <x-forms.input
                type="date"
                name="scheduled_at"
                id="scheduled_at"
                min="{{ now()->format('Y-m-d') }}"
                value="{{ old('scheduled_at', $appointment->scheduled_at?->format('Y-m-d')) }}"
                required
                variant="form"
                class="w-full"
            />
        </div>
        {{-- Time Slot --}}
        <div class="flex flex-col gap-1 w-full md:flex-1">
            <label for="slot" class="font-bold text-sm md:text-base">Time Slot</label>
            <x-forms.select name="slot" id="slot" variant="form" class="w-full">
                <option value="" disabled {{ old('slot', $appointment->slot) ? '' : 'selected' }}>Select Time Slot</option>
                @foreach ($slots as $slotOption)
                    <option value="{{ $slotOption }}"
                        {{ old('slot', $appointment->slot) === $slotOption ? 'selected' : '' }}
                    >
                        {{ $slotOption }}
                    </option>
                @endforeach
            </x-forms.select>
        </div>
    </div>

    {{-- Appointment Status --}}
    <div class="flex flex-col gap-1 w-full md:flex-1">
        <label for="status" class="font-bold text-sm md:text-base">Status</label>
        <x-forms.select name="status" id="status" variant="form" class="w-full">
            <option value="" disabled {{ old('status', $appointment->status) ? '' : 'selected' }}>Select Status</option>
            @foreach ($status as $option)
                <option value="{{ $option }}"
                    {{ old('status', $appointment->status) === $option ? 'selected' : '' }}
                >
                    {{ $option }}
                </option>
            @endforeach
        </x-forms.select>
    </div>

    {{-- Appointment Remarks --}}
    <div class="flex flex-col gap-1 w-full md:flex-1">
        <label for="status" class="font-bold text-sm md:text-base">Additional Remarks</label>
        <textarea name="remarks" id="remarks" placeholder="Enter remarks here...">
            {{ old('remarks', $appointment->remarks) }}
        </textarea>
    </div>

    <x-ui.button 
        type="submit" 
        variant="primary" 
        class="px-1 py-3"
    >
        {{ $submitLabel }}
    </x-ui.button>
</x-forms.container>