<div class="bg-gray-100 px-4 py-3 rounded-t-xl border-b border-edge flex flex-col lg:flex-row justify-between items-stretch lg:items-center gap-4">

    <div class="bg-white flex items-center px-3 py-1.5 rounded-xl border border-edge w-full lg:w-2/5 focus-within:border-primary transition-colors">
        <div class="flex items-center flex-1 min-w-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-400 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input id="appointment-search" type="text" placeholder="Search Appointment..." class="flex-1 ml-2 outline-none text-sm text-gray-700 bg-transparent min-w-0">
        </div>
        
        <div class="flex items-center shrink-0">
            <select id="status-filter" class="outline-none text-sm text-gray-700 bg-transparent mx-2 cursor-pointer border-l border-edge pl-2 font-mono">
                @foreach(['Scheduled', 'Completed', 'No Show', 'Cancelled', 'All'] as $status)
                    <option value="{{ $status }}" {{ request('status', 'Scheduled') === $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
            <button id="date-sort-btn" class="bg-secondary hover:bg-primary/50 text-primary px-3 sm:px-4 text-sm py-2 rounded flex items-center gap-1 hover:cursor-pointer group whitespace-nowrap">
                Date
                <svg id="date-sort-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 transition-transform duration-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                </svg>
            </button>
        </div>
    </div>

    <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto justify-start sm:justify-end">
        {{-- New Appointment Button --}}
        <a href="{{ route('appointments.create') }}" class="flex items-center bg-primary px-4 py-2 text-sm text-secondary rounded-xl gap-1 whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M12 5v14m-7-7h14" />
            </svg>
            <span class="hidden sm:inline">New Appointment</span>
            <span class="sm:hidden">New</span>
        </a>
        {{-- Calendar View Button --}}
        <x-ui.button id="toggle-view-btn" variant="outline" class="rounded-xl gap-2 flex-1 sm:flex-initial justify-center">
            <span id="view-text">Calendar View</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
            </svg>
        </x-ui.button>

        {{-- Date Picker --}}
        <div class="bg-white flex items-center px-3 py-2 rounded-xl border border-border focus-within:border-edge transition-colors flex-1 sm:flex-initial">
            <input type="date" id="date-filter-input" class="outline-none text-sm text-gray-700 bg-transparent cursor-pointer w-full">
        </div>
    </div>
</div>
