@extends('layouts.layout')

@section('content')
    <div class="w-full h-full p-4 flex gap-4 overflow-hidden">

        <!-- Appointment List -->
        <div id="list-panel"
             class="flex-1 min-h-0 flex flex-col bg-white border rounded-xl shadow-sm transition-all duration-300">

            <x-appointments.toolbar/>

            <div id="appointment-container"
                 data-url="{{ route('appointments.index') }}"
                 class="flex-1 min-h-0 overflow-y-auto">

                <div id="appointment-list">
                    @include('components.appointments.list', ['appointments' => $appointments])
                </div>

                <div id="infinite-scroll-trigger" class="p-6 text-center" @if(!$hasMore) style="display: none;" @endif>
                    <div class="animate-pulse text-muted text-sm">Loading...</div>
                </div>
            </div>
        </div>

        <!-- Side Panel -->
        <div id="detail-panel"
             class="flex flex-col h-7/10 w-0 opacity-0 overflow-hidden bg-white border shadow-sm transition-all duration-300">

            <div id="detail-content" class="h-full w-full">
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    @vite(['resources/js/appointments/index.js'])
@endpush
