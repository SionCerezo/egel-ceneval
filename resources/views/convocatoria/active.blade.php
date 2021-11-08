@extends('admin.admin-master')

@section('css')
<link href="{{ asset('css/egel/components/cards/convocatoria.css') }}" rel="stylesheet">
@endsection

@section('admin-breadcrumb-items')
<li class="breadcrumb-item">
    <a href="{{ route('admin.convocatoria.active') }}" class="text-muted">Convocatoria</a>
</li>
<li class="breadcrumb-item text-muted active" aria-current="page">Active</li>
@endsection

@section('body')
<div class="blog-item post-item">
    <x-cards.empty-page>
        <x-cards.convocatoria :convocatoria="$convocatoria" />
    </x-cards.empty-page>
</div>
@endsection

