mapboxgl.accessToken = 'pk.eyJ1IjoiZml4YW5kZ28iLCJhIjoiY2x3bXkwZmo3MHN0cjJxcGdmOTl0ZGpqMSJ9.3h2wrul2X1OxFwzaZflQug';

var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [-74.5, 40], // starting position [lng, lat]
    zoom: 9 // starting zoom
});

map.on('click', function(e) {
    document.getElementById('location').value = e.lngLat.lat + ',' + e.lngLat.lng;
});