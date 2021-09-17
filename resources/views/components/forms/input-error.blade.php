@if ( $prepend )
    <div class="input-group-prepend">
        <label class="input-group-text" for="{{ $id }}" style="font-weight: bold; padding: 6px 25px;">
            {{ $label }}
        </label>
    </div>
@endif
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
<x-forms.error element-name="{{ $name }}" element-label="{{ $label }}"/>
