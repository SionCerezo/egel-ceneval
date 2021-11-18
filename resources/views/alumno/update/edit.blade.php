@extends('alumno.alumno-master')

@section('Title','Actualizacion de datos')

@section('css')
<style>
.egel-form-group {
    margin-top: 1.5rem;
}
</style>
@endsection

@section('body')
    <!--Formulario de actualizacion-->
    <x-cards.page>
        <x-slot name="title">Actualización de datos</x-slot>
        <x-slot name="subtitle"></x-slot>

        <div class="col-lg-12 col-md-12 bg-white">
            <div class="p-3">
                <form class="mt-4" method="POST" action="{{route('alumno.update',auth()->user()->id)}}">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <!--<img src="" alt="FCC">-->
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-12">
                                    {{-- <label class="text-dark" for="username">Usuario</label> --}}
                                    <x-forms.input type="text" label="Name" value="{{session('fulluser')->name}}"/>
                                </div>
                                <div class="col-lg-6">
                                    <x-forms.input type="text" label="Apellido paterno" name="pat_surname" value="{{session('fulluser')->pat_surname}}"/>
                                </div>
                                <div class="col-lg-6">
                                    <x-forms.input type="text" label="Apellido materno" name="mat_surname" value="{{session('fulluser')->mat_surname}}"/>
                                </div>
                                <div class="col-lg-12">
                                    <x-forms.input type="email" label="e-mail" name="email" value="{{auth()->user()->email}}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <x-forms.input type="password" label="Nueva contraseña" name="password"/>
                        </div>
                        <div class="col-lg-4">
                            <x-forms.input type="password" label="Confirmar contraseña nueva" name="password_confirmation"/>
                        </div>
                        <div class="col-lg-4">
                            <x-forms.input type="text" label="Teléfono" name="telephone" value="{{session('fulluser')->telephone}}"/>
                        </div>
                        <div class="col-lg-4">
                            <x-forms.input type="text" label="Matrícula" name="matricula" value="{{session('fulluser')->matricula}}"/>
                        </div>
                        <div class="col-lg-8">
                            @error('carrera')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="egel-form-group">
                                <select class="custom-select mr-sm-2" name="carrera_id" id="slctCarrera"
                                data-toggle="tooltip" data-placement="top" data-original-title="Selecciona tu carrera">
                                    <!--Debemos de traer todas las carreras y dejar seleccionada la que tiene el usuario-->
                                    @foreach ($carreras as $carrera)
                                        @if ($carrera->id == session('fulluser')->carrera_id)
                                            <option value="{{$carrera->id}}" selected="">{{$carrera->name}} </option>
                                        @else
                                            <option value="{{ $carrera->id }}">{{ $carrera->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center mt-5">
                            <button type="submit" class="btn btn-block btn-dark">Actualizar</button>
                        </div>
                        <div class="col-lg-6 text center mt-5">
                            <a href="{{route('alumno.home')}}">Regresar al menu principal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-cardspage>

@endsection

@section('js')
<script src="{{ asset('js/register.js') }}"></script>
@endsection
