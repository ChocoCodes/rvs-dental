@extends('layouts.layout')

@php
    use App\Models\Patient;
@endphp

@section('content')
    <h1 class="font-bold">Add Patients</h1>

    @include('pages.patients.partials.form', [
        'patient' => new Patient(),
        'action' => route('patients.store'),
        'submitLabel' => 'Add New Patient'
    ])
@endsection