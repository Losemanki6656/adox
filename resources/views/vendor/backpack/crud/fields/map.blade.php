<!-- field_type_name -->
@include('crud::fields.inc.wrapper_start')

<label>{!! $field['label'] !!}</label>

<input
    type="hidden"
    name="{{ $field['name'] }}"
    id="{{ $field['name'] }}"
    value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}"
    @include('crud::fields.inc.attributes')
>

<div id="map" style="height: 400px"></div>

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('crud::fields.inc.wrapper_end')

@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}
    @push('crud_fields_styles')
        <!-- no styles -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
              integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    @endpush

    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- no scripts -->

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <script>

            let value = '{{ $field['value'] ?? "41.30036729968222,69.26528797587619" }}';

            let coordinates = value.split(',');
            let map = L.map('map').setView(coordinates, 13);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright"></a>'
            }).addTo(map);

            let currentMarker = L.marker(coordinates).addTo(map);

            map.on('click', function (e) {

                const lat = e.latlng.lat.toFixed(6);
                const lng = e.latlng.lng.toFixed(6);
                let coordinate = lat + ',' + lng;

                if (currentMarker) {
                    map.removeLayer(currentMarker);
                }

                document.getElementById('coordinate').value = coordinate;

                currentMarker = L.marker([lat, lng]).addTo(map);
            });
        </script>
    @endpush
@endif
