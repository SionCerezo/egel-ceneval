<div class="card" style="border-left: 5px solid #00c9f0">
    @isset($header) {{ $header }} @endisset

    <div class="card-body">
        {{ $slot }}
    </div>

    @isset($footer) {{ $footer }} @endisset
</div>
