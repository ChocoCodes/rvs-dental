@extends('layouts.layout')

@section('content')
    <h1 class="font-bold">Edit Patient Information</h1>

    @include('pages.patients.partials.form', [
        'patient' => $patient,
        'action' => route('patients.update', $patient),
        'method' => 'PUT',
        'submitLabel' => 'Save Changes'
    ])
@endsection