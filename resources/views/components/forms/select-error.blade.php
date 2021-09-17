<select class="custom-select" name="{{ $name }}" id="{{ $id }}">
    <option selected="">Elegir...</option>
    @foreach ($items as $item)
        <option value="{{ $item->$itemKey }}">{{ $item->$itemVal }}</option>
    @endforeach
</select>
<x-forms.error element-name="{{ $name }}" element-label="{{ $label }}"/>
