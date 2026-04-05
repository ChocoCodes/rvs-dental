<div class="flex flex-col gap-6">
    <div class="flex justify-between items-start">
        <h2 class="text-xl font-bold text-gray-900">Appointment Details</h2>
        <button id="close-detail" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <div class="space-y-4">
        <div>
            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Patient</label>
            <p class="text-lg font-medium text-gray-900">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</p>
        </div>

        <div>
            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Dentist</label>
            <p class="text-base text-gray-700">{{ $appointment->dentist->full_name ?? 'N/A' }}</p>
        </div>

        <div>
            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Schedule</label>
            <p class="text-base text-gray-700">{{ \Carbon\Carbon::parse($appointment->scheduled_at)->format('F j, Y g:i A') }}</p>
        </div>

        <div>
            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</label>
            <p class="text-base text-gray-700">{{ $appointment->status }}</p>
        </div>

        <div>
            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Remarks</label>
            <p class="text-base text-gray-700">{{ $appointment->remarks ?? 'No remarks provided.' }}</p>
        </div>
    </div>
</div>
