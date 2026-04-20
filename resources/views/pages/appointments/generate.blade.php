@extends('layouts.layout')

@section('hideNavbar', true)
@section('content')
    <div class="flex flex-col gap-4 my-auto max-w-4xl mx-auto w-full">
        @include('pages.appointments.partials.certificate')
        <div class="no-print flex justify-end">
            <button
                onclick="window.print()"
                class="px-6 py-3 rounded-xl flex gap-2 items-center hover:cursor-pointer transition-all bg-primary text-secondary"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 6 2 18 2 18 9"/>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                    <rect x="6" y="14" width="12" height="8"/>
                </svg>
                Print
            </button>
        </div>
    </div>
@endsection