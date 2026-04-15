@extends('layouts.layout')

@section('hideNavbar', true)
@section('content')
    <div class="bg-background min-h-screen">
        @include('pages.appointments.partials.form', [
        'title' => 'Edit Appointment',
        'appointment' => $appointment,
        'method' => 'PUT',
        'action' => route('appointments.update', $appointment),
        'submitLabel' => 'Update Appointment'
    ])
    </div>
@endsection
