{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-md-12"> --}}
            @isset($convocatoria)
            {{-- <div class="card" style="border-left: 4px solid #00c9f0">
                <div class="card-body"> --}}
                    {{-- @if ( class_basename(auth()->user()) != User::class )

                    @endif --}}
                    <div class="egel-conv-periodo">
                        <span class="egel-conv-periodo-name">{{ $convocatoria->periodo->name}} </span>
                        <span class="egel-conv-periodo-year">{{ $convocatoria->periodo->year}} </span>
                    </div>

                    <h4 class="card-title" style="color: #003c5e; font-size: 1.5rem">
                        {{ $convocatoria->title }}
                    </h4>

                    <h6 class="card-subtitle">
                        <div class="meta-info-blog">
                            <span><i class="fa fa-calendar"></i>
                                <a href="https://www.free-css.com/free-css-templates">
                                    {{ localDate($convocatoria->start_date) }} - {{ localDate($convocatoria->end_date) }}
                                </a>
                            </span>
                        </div>
                    </h6>
                    <hr/>

                    {!! $convocatoria->description !!}
                    <br>

                {{-- </div>
            </div> --}}

            @else
            {{-- <div class="card" style="border-left: 4px solid #00c9f0">
                <div class="card-body"> --}}
                    <h4 class="card-title" style="color: #003c5e; font-size: 1.5rem">
                        Convocatoria examen EGEL Ceneval
                    </h4>
                    <hr>
                    <p class="egel-convocatoria-descrip">
                        No hay convocatorias abiertas por el momento.
                    </p>
                {{-- </div>
            </div> --}}
            @endisset
        {{-- </div>
    </div>
</div> --}}
