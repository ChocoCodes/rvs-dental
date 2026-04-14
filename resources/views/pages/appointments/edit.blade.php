@extends('layouts.layout')

@section('hideNavbar', true)
@section('content')
    @include('pages.appointments.partials.form', [
        'appointment' => $appointment,
        'method' => 'PUT',
        'action' => route('appointments.update', $appointment),
        'submitLabel' => 'Update Appointment'
    ])
@endsection