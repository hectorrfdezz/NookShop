@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Perfil de {{ $user->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @isset($weather)
        <p>Clima actual: {{ $weather }}</p>
    @endisset

    @isset($alert)
        <div class="alert alert-warning">{{ $alert }}</div>
    @endisset

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        <div class="mb-3">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="form-control">
        </div>

        <div id="map" style="height: 300px;"></div>

        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $user->latitude) }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $user->longitude) }}">

        <div class="mb-3">
            <label for="address">Dirección</label>
            <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=places" async defer></script>
<script>
    let map;
    let marker;
    function initMap() {
        const lat = parseFloat(document.getElementById('latitude').value) || 37.3891;
        const lng = parseFloat(document.getElementById('longitude').value) || -5.9845;
        const userLatLng = {lat: lat, lng: lng};
        map = new google.maps.Map(document.getElementById('map'), {
            center: userLatLng,
            zoom: 10,
        });
        marker = new google.maps.Marker({
            position: userLatLng,
            map: map,
            draggable: true
        });
        google.maps.event.addListener(marker, 'dragend', function() {
            const position = marker.getPosition();
            document.getElementById('latitude').value = position.lat();
            document.getElementById('longitude').value = position.lng();
            reverseGeocode(position.lat(), position.lng());
        });
    }
    function reverseGeocode(lat, lng) {
        const geocoder = new google.maps.Geocoder();
        const latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
        geocoder.geocode({location: latlng}, (results, status) => {
            if (status === 'OK') {
                if (results[0]) {
                    document.getElementById('address').value = results[0].formatted_address;
                }
            }
        });
    }
</script>
@endsection
