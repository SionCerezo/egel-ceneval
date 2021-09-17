@extends('admin.admin-master')

@section('css')
<link href="{{ asset('css/egel/components/cards/convocatoria.css') }}" rel="stylesheet">
@endsection

@section('admin-breadcrumb-items')
<li class="breadcrumb-item">
    <a href="{{ route('admin.convocatoria.active') }}" class="text-muted">Postulaciones</a>
</li>
<li class="breadcrumb-item text-muted active" aria-current="page">Actuales</li>
@endsection

@section('body')
{{-- <div class="blog-item post-item">
</div> --}}
<div class="container-fluid">
    <x-cards.page>
        <x-slot name="title">Postulaciones de la convocatoria actual</x-slot>
        <x-slot name="subtitle">
            To use add class <code>.bg-info .text-whit</code> in the
            <code>&lt;thead&gt;</code>.
        </x-slot>
        <hr>
        @if($postulaciones->isNotEmpty())
        <div class="table-responsive">
            <table class="table">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Alumno</th>
                        <th>Estatus</th>
                        <th>Enviado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($postulaciones as $postulacion)
                        <tr>
                            {{-- Alumno --}}
                            <td>
                                <a href="{{ route('postulacion.show', ['postulacion' => $postulacion->id]) }}">
                                    {{ $postulacion->alumno->full_name }}
                                </a>
                            </td>

                            {{-- Estatus --}}
                            <td>
                                {{ $postulacion->status->value }}
                            </td>

                            {{-- Fecha de Envio --}}
                            <td>{{ $postulacion->created_at->format(
                                        property('dates.formats.convocatoria'));
                            }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="egel-convocatoria-descrip">
            Aun no hay alumnos registrados para este exámen.
        </p>
        @endif
    </x-cards.classic>
</div>

<div class="modal fade" id="info-modal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-information h1 text-info"></i>
                    <h4 class="mt-2">Mensaje</h4>
                    <p class="mt-3" id="info-msg"></p>
                    <button type="button" class="btn btn-info my-2" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="danger-error-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-wrong h1"></i>
                    <h4 class="mt-2">Error</h4>
                    <p class="mt-3"></p>
                    <button type="button" class="btn btn-light my-2" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div id="error-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-danger">
                <h4 class="modal-title" id="danger-header-modalLabel">Error</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p class="mt-3" id="error-msg"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light my-2" data-dismiss="modal">Aceptar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endsection

@section('js')
<script type="text/javascript">

    $(".dropdown-menu").on('click', "a.dropdown-item", function (evt) {
        evt.preventDefault();

        $hlink = $(this);
        btnStatus = $hlink.parent().prev();
        btnStatus.attr('disabled', 'disabled');
        btnStatus.prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');

        $.ajax({
            url: $(this).attr('href'),
            type: 'GET',

            success: function(result){
                btnStatus.html(result.value);

                let dropHtml = "";
                for (const action of result.actions) {
                    dropHtml += `<a class="dropdown-item" href="${action.route}">${action.value}</a>`;
                }
                dropActions = $hlink.parent();
                dropActions.html(dropHtml);

                $modalInfo = $("#info-modal");
                $modalInfo.find('p:first').html("El estatus de la convocatoria ha sido cambiado con éxito")
                $modalInfo.modal();
            },
            error: function(xhr,status,error){
                console.log(xhr);
                console.log(status);
                console.log(error);
            },
            complete: function(){
                btnStatus.removeAttr('disabled');
                btnStatus.children('span').remove();
            }
        });

    })

    $("form").on('submit', function (evt) {
        evt.preventDefault();
        console.log(evt)

        let dataForm = new FormData(this);
        let formAction = $(this).attr('action')

        $hlink = $(this);
        $btnSubmit = $(this).find("button[type='submit']")
        $btnSubmit.attr('disabled', 'disabled');
        $btnSubmit.prepend('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');

        let msg = "";
        let $modal;

        $.ajax({
            url: formAction,
            type: 'POST',
            data: dataForm,
            dataType: 'json',

            contentType: false,
            processData: false,
            cache: false,

            success: function(result){
                console.log(result);
                try {
                    if( result.success == undefined )
                        throw "Hubo un error en la respuesta del servidor, intentelo mas tarde";
                    if( !result.success ){
                        if( result.status = 404 )
                            throw "No se encontró la convocatoria a eliminar"
                    }

                    $btnSubmit.closest('tr').remove();

                    msg = "Convocatoria eliminada con éxito";
                    $modal = $('#info-modal');
                } catch (error) {
                    msg = error;
                    $modal = $("#danger-error-modal");
                }
            },
            error: function(xhr,status,error){
                console.log(xhr);
                console.log(status);
                console.log(error);

                msg = "Hubo un error en la respuesta del servidor, intentelo mas tarde";
                $modal = $("#danger-error-modal");
            },
            complete: function(){
                // $msgDetail.html(msg);
                $btnSubmit.removeAttr('disabled');
                $btnSubmit.children('span').remove();
                $modal.find('p:first').html(msg);
                $modal.modal();
            }
        });

    })
</script>
@endsection
