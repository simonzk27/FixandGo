var map;
var markers = [];

function initMap() {
    var initialLocation = {lat: -34.397, lng: 150.644};

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 6,
        center: initialLocation
    });

    // This event listener will call addMarker() when the map is clicked.
    map.addListener('click', function(event) {
        deleteMarkers();
        addMarker(event.latLng);
        document.getElementById('location').value = event.latLng.lat() + ',' + event.latLng.lng();
    });
}

// Adds a marker to the map and push to the array.
function addMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
    markers.push(marker);
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
    setMapOnAll(null);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    clearMarkers();
    markers = [];
}