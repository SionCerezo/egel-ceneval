<div>
    <a href="{{ $attributes['action'] }}" class="btn btn-{{ $attributes['type'] }} btn-circle mb-2 btn-item">
        <i class="{{ $attributes['icon'] }}"></i>
    </a>
</div>
<div class="ml-3 mt-2">
    <a href="{{ $attributes['action'] }}">
        <p class="font-14 mb-2">{{ $slot }}</p>
    </a>
</div>
