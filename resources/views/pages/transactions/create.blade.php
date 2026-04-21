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
        <x-forms.container
    action="{{ route('transactions.store') }}"
    method="POST"
>
    {{-- Totals --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
        <div class="p-4 rounded-xl bg-gray-100">
            <p class="text-sm text-gray-500">TOTAL CHARGED</p>
            <p id="total-charged" class="text-xl font-bold">₱0.00</p>
        </div>
        <div class="p-4 rounded-xl bg-gray-100">
            <p class="text-sm text-gray-500">TOTAL PAID</p>
            <p id="total-paid" class="text-xl font-bold text-green-600">₱0.00</p>
        </div>
        <div class="p-4 rounded-xl bg-gray-100">
            <p class="text-sm text-gray-500">AFTER PAYMENT</p>
            <p id="remaining-balance" class="text-xl font-bold text-red-500">₱0.00</p>
        </div>
    </div>

    {{-- Record Payment --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
        {{-- Credit Amount --}}
        <div class="flex flex-col gap-1">
            <label class="text-sm text-gray-600">CREDIT AMOUNT</label>
            <input 
                type="number" 
                step="0.01"
                name="credit_amount"
                id="credit-amount"
                class="border rounded-lg px-3 py-2 w-full"
                placeholder="0.00"
                required
            >
        </div>
        {{-- Payment Mode --}}
        <div class="flex flex-col gap-1">
            <label class="text-sm text-gray-600">MODE</label>
            <select 
                name="mode_of_payment"
                id="mode-of-payment"
                class="border rounded-lg px-3 py-2 w-full"
                required
            >
                @foreach ($paymentMode as $mode)
                    <option value="{{ $mode }}">{{ $mode }}</option>
                @endforeach
            </select>
        </div>
        {{-- Pay in Full Button --}}
        <div class="flex items-end">
            <button 
                type="button"
                id="pay-full-btn"
                class="w-full border rounded-lg px-3 py-2 hover:bg-gray-100"
            >
                Pay in full
            </button>
        </div>
    </div>

    {{-- Hidden Fields --}}
    <input type="hidden" name="ledger_id" id="ledger-id">
    
    {{-- Submit --}}
    <div class="flex justify-end mt-6">
        <x-ui.button
            type="submit"
            variant="primary"
            class="px-8 py-3 rounded-xl text-lg"
        >
            Record Transaction
        </x-ui.button>
    </div>
</x-forms.container>
    </div>
</div>
@endsection

@push('scripts')
    @vite(['resources/js/transactions/create.js'])
@endpush