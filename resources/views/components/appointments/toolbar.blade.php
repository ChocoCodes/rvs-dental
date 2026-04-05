<div class="bg-gray-100 px-4 py-3 rounded-t-xl border border-edge flex flex-col md:flex-row justify-between items-center gap-4">

    <div class="bg-white flex items-center px-3 py-2 rounded-xl border border-edge w-full md:w-2/5">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
        <input type="text" placeholder="Search Appointment..." class="flex-1 ml-2 outline-none text-sm text-gray-700 bg-transparent">
        <span class="bg-secondary text-primary px-4 text-sm py-2 rounded flex items-center gap-1">
            Date &uarr;
        </span>
    </div>

    <div class="flex items-center gap-3 w-full md:w-auto">
        {{-- Calendar View Button --}}
        <x-ui.button variant="outline" class="rounded-xl gap-2">
            Calendar View
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
            </svg>
        </x-ui.button>

        {{-- Select Month Button --}}
        <x-ui.button variant="outline" class="rounded-xl gap-2">
            Select Month
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
            </svg>
        </x-ui.button>
    </div>
</div>
