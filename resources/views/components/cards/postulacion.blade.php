@php
$user = $postulacion->alumno;
@endphp
<x-cards.page>
    <x-slot name="header">
        @isset($header) {{ $header }} @endisset
    </x-slot>

    <x-slot name="title">{{ $title }}</x-slot>
    <x-slot name="subtitle">{{ $subtitle }}</x-slot>


    <ul class="nav nav-tabs nav-bordered nav-justified mb-3">
    {{-- <ul class="nav nav-tabs nav-justified mb-3"> --}}
        <li class="nav-item">
            <a href="#tab-post-info" data-toggle="tab" aria-expanded="false" class="nav-link active">
                <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">Datos de la postulación</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#tab-comments" data-toggle="tab" aria-expanded="true" class="nav-link">
                <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                <span class="d-none d-lg-block">Comentarios</span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane show active" id="tab-post-info">
            <br>
            {{-- Datos del Alumno --}}
            <div class="row">
                <div class="col-md-12 border-bottom pb-3">
                    <span class="font-weight-medium text-dark">
                        <i class="icon-info mr-2 text-info"></i> {{ $titleDataSection }}
                    </span>
                </div>
                <div class="col-md-7 border-right">
                    <ul class="list-style-none">
                        <li class="my-3">
                            <span><i class="icon-user mr-2 text-info"></i>{{ $user->full_name }}</span>
                        </li>
                        <li class="my-3">
                            <span><i class="icon-graduation mr-2 text-info"></i>{{ $user->carrera->name }}</span>
                        </li>
                        <li class="my-3">
                            <span><i class="icon-envelope mr-2 text-info"></i>{{ $user->email }}</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <ul class="list-style-none">
                        <li class="my-3">
                            <span><i class="icon-user mr-2 text-info"></i>{{ $user->matricula }}</span>
                        </li>
                        <li class="my-3">
                            <span><i class="icon-phone mr-2 text-info"></i>{{ $user->telephone }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <hr/><br>

            {{-- Documentos --}}
            <div class="row">
                <div class="col-md-12 border-bottom pb-3">
                    <span class="font-weight-medium text-dark">
                        <i class="icon-docs mr-2 text-info"></i> Documentos enviados:
                    </span>
                </div>
                @foreach ($files as $document)
                    <div class="col-md-6 my-3">
                        <span>
                            <i class="icon-paper-clip mr-2 text-info"></i>
                            <a target="_blank" href="{{ route('file.response', ['file_id' => $document->path]) }}">
                                {{ class_basename($document->path) }}
                            </a>
                        </span>
                    </div>
                @endforeach
                @if($files->isEmpty())
                    <div class="col-md-12 text-center">
                        <br>
                        <h4><span class="badge badge-light">{{ trans('messages.postulation.zero-files') }}</span></h4>
                    </div>
                @else
                    <div class="col-md-12 text-center">
                        <form method="GET" action="{{ route('postulacion.download-files', ['postulacion' => $postulacion->id]) }}">
                            <button class="btn btn-outline-info waves-effect waves-light" type="">
                                <span class="btn-label"><i class="fa fa-download"></i></span>
                                Descargar todo
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <div class="tab-pane" id="tab-comments">
            {{-- <div class="card"> --}}
                <div class="row no-gutters">
                    <div class="col-12">
                        <div class="comment-box">
                            <div class="row">
                                <div class="col-9">
                                    <div class="input-field mt-0 mb-0">
                                        <input id="txt-new-comment" placeholder="Ingresa tu comentario" class="form-control border-0" type="text">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <a class="btn-circle btn-lg btn-cyan float-right text-white" id="sent-message"><i class="fas fa-paper-plane"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="chat-box scrollable position-relative ps-container ps-theme-default ps-active-y"
                                style="height: calc(100vh - 111px); max-height: 350px">
                            <!--chat Row -->
                            <ul class="chat-list list-style-none px-3 pt-3" id="chat-list">
                                @php $userId = auth()->user()->id; @endphp
                                @forelse ($comments as $comment)
                                    @php $selfComment = $comment->user_id==$userId @endphp
                                    <li class="chat-item list-style-none mt-3 @if ($selfComment) {{'odd'}} @endif">
                                        <div class="chat-content d-inline-block pl-3 @if ($selfComment) {{'text-right'}} @endif">
                                            @if ($selfComment)
                                                <span class="chat-time font-12 mt-1 mr-0 mb-3">18:27</span>
                                                <div class="msg p-2 d-inline-block mb-1">{{ $comment->comment }}</div>
                                            @else
                                                <div class="msg p-2 d-inline-block mb-1">{{ $comment->comment }}</div>
                                                <span class="font-12 mt-1 mr-0 mb-3">18:27</span>
                                            @endif
                                        </div>
                                    </li>
                                @empty
                                    <x-badges.default>
                                        {{ trans('messages.postulation.zero-comments') }}
                                    </x-badges.default>
                                @endforelse
                            </ul>
                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 499px;">
                                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 414px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>

    <x-slot name="footer">
        @isset($footer) {{ $footer }} @endisset
    </x-slot>
</x-cards.page>

<x-modals.message type='danger' show="false" id="commentErrorMdl">
    <p class="mt-3">Ocurrio un error al enviar el mensaje, por favor intenta de nuevo</p>
</x-modals.message>
