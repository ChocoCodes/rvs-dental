@extends('layouts.layout')

@section('hideNavbar', true)
@section('content')
    @include('pages.appointments.partials.form', [
        'mode' => 'Edit',
        'appointment' => $appointment,
        'method' => 'PUT',
        'action' => route('appointments.update', $appointment),
        'submitLabel' => 'Update Appointment'
    ])
    </div>
@endsection
