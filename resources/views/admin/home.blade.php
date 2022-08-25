@extends('admin.admin-master')

@section('css')
<link href="{{ asset('template/assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template/assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('template/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
@endsection

@section('body')
<x-cards.page>
    <x-slot name="title">Inicio</x-slot>
    <x-slot name="subtitle"></x-slot>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total de postulaciones</h4>
                    <div id="posts-chart" class="mt-2 c3" style="height: 283px; width: 100%; max-height: 283px; position: relative;">
                    </div>
                    <ul class="list-style-none mb-0">
                        @forelse ($postulationTotals as $postStatus)
                            <li>
                                <i class="fas fa-circle font-10 mr-2" style="color: {{$postStatus->color}}"></i>
                                <span class="text-muted">{{$postStatus->value}}</span>
                                <span class="text-dark float-right font-weight-medium">{{$postStatus->status_count}}</span>
                            </li>
                        @empty
                            <x-badges.default>{{ trans('messages.convocatoria.zero-postulations') }}</x-badges.default>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-start">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $postulationsTotal }}</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100">
                                        Postulaciones en la convocatoria actual
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted">
                                        <i class="icon-layers"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Enlaces rápidos</h4>
                            <div class="mt-4 activity">
                                <div class="d-flex align-items-start border-left-line pb-3">
                                    <x-buttons.item action="{{ route('postulacion.index') }}"
                                            type='info' icon="fas fa-tasks">
                                        Postulaciones
                                    </x-buttons.item>
                                </div>
                                <div class="d-flex align-items-start border-left-line pb-3">
                                    <x-buttons.item action="{{ route('admin.convocatoria.active') }}"
                                            type='danger' icon="far fa-newspaper">
                                        Convocatorias Actual
                                    </x-buttons.item>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-cards.page>
@endsection

@section('js')
<script src="{{ asset('template/assets/libs/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('template/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('template/assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('template/assets/extra-libs/c3/c3.min.js') }}"></script>
<script src="{{ asset('template/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('template/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('template/dist/js/pages/dashboards/dashboard1.js') }}"></script>

<script type="text/javascript">
    var postulationsData = Array.from(JSON.parse( {!!json_encode($postulationTotals->toJson())!!} ));
    var postsDataChart = postulationsData.map(item => [item.value, item.status_count]);
    var statusColors = postulationsData.map(item => [item.color]);
</script>
@endsection

