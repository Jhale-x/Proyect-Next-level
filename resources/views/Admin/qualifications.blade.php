@extends('layouts.Adminlanding')

@section('title', 'Calificaciones')

@section('content')
    @php
        $qualificationsEndpoints = [
            'base' => url('/admin/qualifications'),
        ];
    @endphp

    @include('partials.qualifications_dynamic', ['qualificationsEndpoints' => $qualificationsEndpoints])
@endsection
