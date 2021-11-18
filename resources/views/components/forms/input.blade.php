@if( $modifiers->has('with-error') && $modifiers->get('with-error')=='top' )
    <x-forms.error element-name="{{ $name }}" element-label="{{ $label }}"/>
@endif
{{-- @dump(old($name)) --}}
<div class="egel-form-group">
    <input
        class="form-control @error($name) is-invalid @enderror"
        type='{{ $type }}'
        @attribute(name)
        @attribute(id)
        @attribute(placeholder, $label)
        @attribute(value, old($name, $value))

        @if( $modifiers->has('tooltip') )
            data-toggle="tooltip" data-placement="{{ $modifiers->get('tooltip') }}" data-original-title="{{ $label }}"
        @endif
        @if( $modifiers->has('with-error') )
            onfocus="checkIsInvalid(this)"
        @endif
        {{ $attributes }}
    >
</div>
@if( $modifiers->has('with-error') && $modifiers->get('with-error')=='bottom' )
    <x-forms.error element-name="{{ $name }}" element-label="{{ $label }}"/>
@endif
