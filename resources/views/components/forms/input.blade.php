<div class="egel-form-group">
    <input
        class="form-control @error($name) is-invalid @enderror"
        type='{{ $type }}'
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name) }}"
        placeholder="{{ $label }}"
        data-toggle="tooltip" data-placement="top" data-original-title="{{ $label }}"
        onfocus="checkIsInvalid(this)">
</div>
@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errorMessage($message) }}</strong>
    </span>
@enderror
