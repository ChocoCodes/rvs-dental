{{-- Patient Name --}}
<div class="flex flex-col gap-1">
    <label for="patient_name" class="font-bold text-sm md:text-base">Patient Name</label>
    <div class="relative">
        <input type="hidden" name="patient_id" id="patient_id">
        <input type="text" name="patient_name" id="patient_name" placeholder="Enter patient name...">
        <div class="absolute inset-y-0 right-1 flex items-center pl-2.5 pointer-events-none">
            <svg class="w-4 h-4 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </div>
        <ul id="patient-dropdown" class="hidden absolute z-50 mt-1 w-full bg-white shadow-sm max-h-60 overflow-y-auto">
        </ul>
    </div>
</div>

@push('scripts')
<script>
    (() => {})();
</script>
@endpush
    