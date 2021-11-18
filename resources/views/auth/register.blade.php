@extends('auth.master')

@section('title', 'Registro')

@section('css')
<style>
.egel-form-group {
    margin-top: 1.5rem;
}
</style>
@endsection

@section('body')
{{-- <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(../assets/images/big/3.jpg);">
</div> --}}
<div class="col-lg-12 col-md-12 bg-white">
    <div class="p-3">
        <h2 class="mt-3 text-center">Registro para alumnos</h2>
        <hr>
        <form class="mt-4" method="POST" action="{{ route('alumno.register') }}">
            @csrf
            <div class="row">
                <div class="col-lg-4 text-center">
                    <img src="{{ asset('images/'.property('images.logos.fcc')) }}" alt="FCC">
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <x-forms.input type="text" label="Nombre" name="name" tooltip="top" with-error/>
                        </div>
                        <div class="col-lg-6">
                            <x-forms.input type="text" label="Apellido paterno" name="pat_surname"
                                tooltip="top" with-error/>
                        </div>
                        <div class="col-lg-6">
                            <x-forms.input type="text" label="Apellido materno" name="mat_surname"
                                tooltip="top" with-error/>
                        </div>

                        <div class="col-lg-12">
                            <x-forms.input type="email" label="e-mail" name="email" tooltip='top' with-error/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <x-forms.input type="password" label="Contraseña" name="password" tooltip='top'
                        with-error/>
                </div>
                <div class="col-lg-4">
                    <x-forms.input type="password" label="Confirmar contraseña" name="password_confirmation" tooltip='top'
                        with-error/>
                </div>
                <div class="col-lg-4">
                    <x-forms.input type="text" label="Teléfono" name="telephone" tooltip='top'
                        with-error/>
                </div>

                <div class="col-lg-4">
                    <x-forms.input type="text" label="Matrícula" name="matricula" tooltip='top'
                        with-error/>
                </div>

                <div class="col-lg-8">
                    <div class="egel-form-group">
                        <select class="custom-select mr-sm-2" name="carrera_id" id="slctCarrera"
                        data-toggle="tooltip" data-placement="top" data-original-title="Selecciona tu carrera">
                            @php $oldCarrera = old("carrera_id") @endphp
                            <option @empty($oldcarrera) selected="" @endempty>Selecciona tu carrera</option>
                            @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}" @if($carrera->id==$oldCarrera) selected="" @endempty>
                                {{ $carrera->name }}
                            </option>
                            @endforeach
                        </select>

                        {{-- <x-forms.select-error name="carrera_id" id="slctCarrera" label="Selecciona tu carrera"
                        :items="$carreras" item-val="name"/> --}}
                    </div>
                    <x-forms.error element-name="carrera_id" element-label="carrera"/>
                </div>

                <div class="col-lg-6 text-center mt-5">
                    ¿Ya estás registrado? <a href="{{ route('login') }}" class="text-danger">Ingresa</a>
                </div>
                <div class="col-lg-6 text-center mt-5">
                    <button type="submit" class="btn btn-block btn-dark">Registrarse</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/register.js') }}"></script>
@endsection
