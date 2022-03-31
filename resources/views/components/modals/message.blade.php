
<div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-{{$attributes['type']}}">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-checkmark h1"></i>
                    <x-slot name="header">
                        @isset($header) {{ $header }} @endisset
                    </x-slot>

                    {{ $slot }}

                    <button type="button" class="btn btn-light my-2" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
