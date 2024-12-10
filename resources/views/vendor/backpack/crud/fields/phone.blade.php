<!-- field_type_name -->
@include('crud::fields.inc.wrapper_start')

<label>{!! $field['label'] !!}</label>

<input
    type="text"
    name="{{ $field['name'] }}"
    id="{{ $field['name'] }}"
    value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}"
    @include('crud::fields.inc.attributes')
>

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('crud::fields.inc.wrapper_end')

@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    @push('crud_fields_styles')
    @endpush

    @push('crud_fields_scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
        <script>
            $("#phone").inputmask('(99)-999-99-99');
        </script>
    @endpush
@endif
