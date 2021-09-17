<x-cards.empty-page>
    <x-slot name="header">
        @isset($header) {{ $header }} @endisset
    </x-slot>

    <h4 class="card-title" style="color: #003c5e; font-size: 1.5rem">{{ $title }}</h4>
    <h6 class="card-subtitle">{{ $subtitle }}</h6>
    {{ $slot }}


    <x-slot name="footer">
        @isset($footer) {{ $footer }} @endisset
    </x-slot>
</x-cards.empty-page>
