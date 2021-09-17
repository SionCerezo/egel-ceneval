@extends('usermaster')

@section('breadcrumb-items')
<li class="breadcrumb-item">
    <a href="{{ route('alumno.home') }}" class="text-muted">Home</a>
</li>
@yield('alumno-breadcrumb-items')
@endsection

@section('sidebar-items')
<x-bars.side.alumno-sidebar/>
@endsection

