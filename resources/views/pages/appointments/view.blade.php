@extends('layouts.layout')

@section('content')
    <a href="{{ route('appointments.edit', $appointment) }}">Edit Appointment</a>
@endsection