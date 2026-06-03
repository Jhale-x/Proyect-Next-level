@extends('layouts.Apoderadolanding')

@section('title', 'Calificaciones')

@section('content')
    @php
        $qualificationsEndpoints = [
            'base' => url('/alumno/qualifications'),
        ];
    @endphp

    @include('partials.qualifications_dynamic', ['qualificationsEndpoints' => $qualificationsEndpoints])
@endsection
