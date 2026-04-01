@extends('layouts.Docentelanding')

@section('title', 'Calificaciones')

@section('content')
    @php
        $qualificationsEndpoints = [
            'base' => url('/docente/qualifications'),
        ];
    @endphp

    @include('partials.qualifications_dynamic', ['qualificationsEndpoints' => $qualificationsEndpoints])
@endsection
