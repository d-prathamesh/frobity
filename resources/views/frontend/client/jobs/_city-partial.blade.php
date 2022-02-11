<input type="hidden" name="service_type" value="{{ $catId }}"/>
<div class="form-group">
        <p>City</p>
        <input type="text" value="" name="city" id="city" class="form-control" id="city"/>
        @if($errors->has('city'))
        <p class="error-text"> {{ $errors->first('city')}}  </p>
    @endif  
    <input type="hidden" name="longitude" id="longitude" value="">
    <input type="hidden" name="latitude" id="latitude" value=""> 
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <script>
        var autocomplete;
        function initialize() {
            autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */(document.getElementById('city')),
            { types: ['geocode'] });
            autocomplete.setComponentRestrictions(
            {'country': ['IN']});
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                document.getElementById('city').value = place.formatted_address;
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
            });
        }

        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
                });
            }
        }

        window.onload = initialize;
    </script>
    </div>