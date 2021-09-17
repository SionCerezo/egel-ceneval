@extends('usermaster')

@section('breadcrumb-items')
<li class="breadcrumb-item">
    <a href="{{ route('admin.home') }}" class="text-muted">Home</a>
</li>
@yield('admin-breadcrumb-items')
@endsection

@section('sidebar-items')
<x-bars.side.admin-sidebar/>
@endsection

