@extends('usermaster')

@section('breadcrumb-items')
<li class="breadcrumb-item">
    <a href="{{ route('alumno.home') }}" class="text-muted">Home</a>
</li>
@yield('alumno-breadcrumb-items')
@endsection

@section('menu-items-perfil')
    <!--haremos uso de otro componente para los items de mi menu de usuario-->
    <x-item href="{{ route('alumno.edit',session('fulluser')->id) }}" data-feather="user">
        My profile
    </x-item>
@endsection

@section('sidebar-items')
<x-bars.side.alumno-sidebar/>
@endsection

