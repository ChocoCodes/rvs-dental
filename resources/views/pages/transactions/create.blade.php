@extends('layouts.layout')

@php
    $paymentMode = ['Cash', 'GCash', 'Card'];
@endphp

@section('content')
<div class="w-full h-full px-2 pb-2 md:px-4 md:pb-4 grid grid-cols-12 gap-4">
    {{-- Patient and Appointment Panel --}}
    <div id="patient-search-container" class="h-content col-span-12 md:h-full md:col-span-5 lg:col-span-4 font-sans border border-border rounded-xl flex flex-col items-start overflow-hidden">
        <div class="flex flex-col w-full border-b border-b-gray-500 p-3">
            <p class="font-bold">Patients & Appointments</p>
            <p class="text-gray-500 italic">Search first, then select appointment</p>
        </div>
        <div class="flex flex-col gap-2 w-full items-start p-3">
            <p>SEARCH PATIENT</p>
            <x-forms.patient-search />
        </div>
        <div id="patient-info-container" class="p-3"></div>
        <div class="p-3">
            <p>APPOINTMENTS</p>
            <div id="appointment-container" class="flex flex-col gap-3 w-full"></div>
        </div>
    </div>
    {{-- Ledger Record Panel --}}
    <div class="h-content md:h-full col-span-12 md:col-span-7 lg:col-span-8 flex flex-col overflow-hidden border border-edge rounded-xl bg-white shadow-sm">
        <div class="flex justify-between items-center p-4 border-b border-gray-400">
            <h1 class="text-3xl font-bold">New Transaction</h1>
            <a href="{{ route('transactions.index') }}" class="text-primary hover:underline font-mono">
                &larr; Back to Transactions
            </a>
        </div>
        {{-- Ledger Table --}}
        <div class="flex flex-col gap-2">
            <p>PROCEDURES & CHARGES</p>
            <table>
                <thead>
                    <th>PROCEDURE</th>
                    <th>LEDGER</th>
                    <th>PRICE</th>
                </thead>
                <tbody id="ledger-info-table"></tbody>
            </table>
        </div>
        {{-- Transaction Table --}}
        <div class="flex flex-col gap-2">
            <p>TRANSACTION HISTORY</p>
            <table>
                <thead>
                    <th>Description</th>
                    <th>Mode</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
                </thead>
                <tbody id="transaction-info-table"></tbody>
            </table>
        </div>
        
    </div>
</div>
@endsection

@push('scripts')
    @vite(['resources/js/transactions/create.js'])
@endpush