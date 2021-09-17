@error($name)
<span class="invalid-feedback" role="alert">
    <strong>{{ $errorMessage($message) }}</strong>
</span>
@enderror
<input
    class="form-control @error($name) is-invalid @enderror"
    type='{{ $type }}'
    name="{{ $name }}"
    id="{{ $id }}"
    value="{{ old($name) }}"
    onfocus="checkIsInvalid(this)"
    @if(!empty($label))
        placeholder="Ingresa el {{ $label }}"
    @endif
    {{ $attributes }}
>
