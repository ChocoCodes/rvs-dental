@extends('layouts.layout')

@php
    use App\Models\Appointment;
@endphp

@section('hideNavbar', true)
@section('content')
<div class="bg-background min-h-screen">
    @include('pages.appointments.partials.form', [
        'title' => 'Add Appointment',
        'appointment' => new Appointment(),
        'action' => route('appointments.store'),
        'submitLabel' => 'Schedule Appointment'
    ])
</div>
@endsection