@props(['year', 'month', 'appointments'])

@php
    $today = now()->startOfDay();
    $firstDayOfMonth = \Carbon\Carbon::create($year, $month, 1);
    $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth();

    $startOfCalendar = $firstDayOfMonth->copy()->startOfWeek(\Carbon\Carbon::SUNDAY);
    $endOfCalendar = $lastDayOfMonth->copy()->endOfWeek(\Carbon\Carbon::SATURDAY);

    // Ensure we always show 6 rows (42 days) for a consistent look
    if ($startOfCalendar->diffInDays($endOfCalendar) < 41) {
        $endOfCalendar->addWeek();
    }

    $days = [];
    $currentDay = $startOfCalendar->copy();

    while ($currentDay <= $endOfCalendar) {
        $days[] = $currentDay->copy();
        $currentDay->addDay();
    }
@endphp

<div id="calendar-grid" class="grid grid-cols-7 divide-x divide-y border-b border-edge divide-edge">
    @foreach($days as $date)
        @php
            $isCurrentMonth = $date->month == $month;
            $isToday = $date->isToday();
            $dateStr = $date->format('Y-m-d');
            $dayAppointments = $appointments[$dateStr] ?? collect();
        @endphp

        <div class="h-[100px] md:h-[120px] p-2 flex flex-col gap-1 transition-colors {{ $isCurrentMonth ? 'bg-white' : 'bg-gray-50' }} overflow-hidden">
            <div class="flex justify-between items-start mb-0.5">
                <span class="text-sm font-medium {{ $isToday ? 'text-cyan-400 font-bold' : ($isCurrentMonth ? 'text-gray-800' : 'text-gray-400') }}">
                    {{ $date->day }}
                </span>
            </div>

            @if($isCurrentMonth && $dayAppointments->isNotEmpty())
                <div class="flex-1 flex flex-col gap-1 overflow-y-auto scrollbar-hide pb-1 min-w-0">
                    @foreach($dayAppointments as $appt)
                        @php
                            $status = strtolower($appt->status);
                            $borderColor = 'border-cyan-400';
                            if (str_contains($status, 'cancel') || str_contains($status, 'no show')) {
                                $borderColor = 'border-red-400';
                            } elseif (str_contains($status, 'complete')) {
                                $borderColor = 'border-green-400';
                            }
                        @endphp

                        <button
                            type="button"
                            onclick="window.showAppointmentDetail({{ $appt->appointment_id }})"
                            class="block w-full text-center px-1 py-0.5 border {{ $borderColor }} bg-white text-gray-800 text-[10px] leading-tight truncate transition-transform cursor-pointer rounded-sm shadow-sm"
                            title="{{ $appt->patient_full_name }}"
                        >
                            {{ $appt->patient_full_name }}
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
</div>
