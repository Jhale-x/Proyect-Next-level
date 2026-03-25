let map;
let userMarker;
let routeLayerId = "route";

let colegio = [-74.579858, -8.392186];
let usuarioGlobal = null;
let esSatelite = true;

function initMap() {

    const mapboxToken = document.getElementById('map').dataset.token;
    mapboxgl.accessToken = mapboxToken;

    map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: colegio,
        zoom: 17
    });

    map.on('style.load', () => {

        agregarMarcadorColegio();

        if (usuarioGlobal) {
            agregarMarcadorUsuario(usuarioGlobal);
            dibujarRuta(usuarioGlobal, colegio);
        }
    });

    agregarMarcadorColegio();

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition((position) => {

            usuarioGlobal = [
                position.coords.longitude,
                position.coords.latitude
            ];

            agregarMarcadorUsuario(usuarioGlobal);

            dibujarRuta(usuarioGlobal, colegio);

        }, (error) => {
            console.warn("Error de geolocalización:", error.message);
        });
    }
}

function agregarMarcadorColegio() {

    const el = document.createElement('div');
    el.style.backgroundImage = "url('/images/next-level-logo.png')";
    el.style.width = "50px";
    el.style.height = "50px";
    el.style.backgroundSize = "cover";
    el.style.borderRadius = "50%";
    el.style.border = "2px solid white";

    new mapboxgl.Marker(el)
        .setLngLat(colegio)
        .setPopup(new mapboxgl.Popup().setText("Next Level - Colegio & Academia"))
        .addTo(map);
}

function agregarMarcadorUsuario(usuario) {

    userMarker = new mapboxgl.Marker({ color: "blue" })
        .setLngLat(usuario)
        .setPopup(new mapboxgl.Popup().setText("Tu ubicación"))
        .addTo(map);
}

function dibujarRuta(origen, destino) {

    const token = mapboxgl.accessToken;
    const url = `https://api.mapbox.com/directions/v5/mapbox/driving/${origen};${destino}?geometries=geojson&access_token=${token}`;

    fetch(url)
        .then(res => res.json())
        .then(data => {

            if (!data.routes || data.routes.length === 0) {
            console.error("No se pudo calcular la ruta");
            return;
            }

            const route = data.routes[0].geometry;

            const coordinates = route.coordinates;
            const bounds = coordinates.reduce((bounds, coord) => {
                return bounds.extend(coord);
            }, new mapboxgl.LngLatBounds(coordinates[0], coordinates[0]));

            map.fitBounds(bounds, {
                padding: 80,
                duration: 1000
            });

            if (map.getSource(routeLayerId)) {
                map.removeLayer(routeLayerId);
                map.removeSource(routeLayerId);
            }

            map.addSource(routeLayerId, {
                type: 'geojson',
                data: {
                    type: 'Feature',
                    geometry: route
                }
            });

            map.addLayer({
                id: routeLayerId,
                type: 'line',
                source: routeLayerId,
                paint: {
                    'line-color': '#e30613',
                    'line-width': 6
                }
            });

        });
}

function comoLlegar() {

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition((position) => {

            usuarioGlobal = [
                position.coords.longitude,
                position.coords.latitude
            ];

            dibujarRuta(usuarioGlobal, colegio);

        });

    }
}

function toggleCapas() {

    if (esSatelite) {
        map.setStyle('mapbox://styles/mapbox/satellite-streets-v12');
    } else {
        map.setStyle('mapbox://styles/mapbox/streets-v11');
    }

    esSatelite = !esSatelite;
}

document.addEventListener("DOMContentLoaded", initMap);
