let map;
let userMarker;
let routeLayerId = "route";

const colegio = [-74.579858, -8.392186];
let usuarioGlobal = null;
let esSatelite = true;

function initMap() {
    const mapElement = document.getElementById('map');
    const mapboxToken = mapElement.dataset.token;

    if (!mapboxToken) {
        console.error("Token de Mapbox no encontrado en data-token");
        return;
    }

    mapboxgl.accessToken = mapboxToken;

    map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: colegio,
        zoom: 17
    });

    map.on('load', () => {
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
                console.warn("Geolocalización denegada o error:", error.message);
            });
        }
    });

    map.on('style.load', () => {
            agregarMarcadorColegio();
            if (usuarioGlobal) {
                agregarMarcadorUsuario(usuarioGlobal);
                dibujarRuta(usuarioGlobal, colegio);
            }
    });
}

function agregarMarcadorColegio() {
    const el = document.createElement('div');
    el.style.backgroundImage = "url('/images/Logo-Next-Level.png')";
    el.style.width = "50px";
    el.style.height = "50px";

    el.style.backgroundPosition = "center"; // Centra la imagen horizontal y verticalmente
    el.style.backgroundRepeat = "no-repeat"; // Evita que la imagen se duplique si es chica
    el.style.backgroundSize = "cover";

    el.style.borderRadius = "50%";
    el.style.border = "2px solid white";
    el.style.boxShadow = "0px 0px 10px rgba(0,0,0,0.3)";

    new mapboxgl.Marker(el)
        .setLngLat(colegio)
        .setPopup(new mapboxgl.Popup({ offset: 25 }).setText("Next Level - Colegio & Academia"))
        .addTo(map);
}

function agregarMarcadorUsuario(usuario) {
    if (userMarker) userMarker.remove();

    userMarker = new mapboxgl.Marker({ color: "blue" })
        .setLngLat(usuario)
        .setPopup(new mapboxgl.Popup({ offset: 25 }).setText("Tu ubicación"))
        .addTo(map);
}

function dibujarRuta(origen, destino) {
    const token = mapboxgl.accessToken;
    const url = `https://api.mapbox.com/directions/v5/mapbox/driving/${origen[0]},${origen[1]};${destino[0]},${destino[1]}?geometries=geojson&access_token=${token}`;

    fetch(url)
        .then(res => res.json())
        .then(data => {
            if (!data.routes || data.routes.length === 0) return;

            const route = data.routes[0].geometry;

            try {
                if (map.getLayer(routeLayerId)) map.removeLayer(routeLayerId);
                if (map.getSource(routeLayerId)) map.removeSource(routeLayerId);
            } catch (error) {
                console.log("Recreando capas de ruta tras cambio de estilo.");
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
                layout: { 'line-join': 'round', 'line-cap': 'round' },
                paint: {
                    'line-color': '#db0808',
                    'line-width': 6
                }
            });

            const bounds = new mapboxgl.LngLatBounds(origen, origen).extend(destino);
            map.fitBounds(bounds, { padding: 80, duration: 1000 });
        })
        .catch(err => console.error("Error al obtener ruta:", err));
}

function comoLlegar() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            usuarioGlobal = [
                position.coords.longitude,
                position.coords.latitude
            ];
            agregarMarcadorUsuario(usuarioGlobal);
            dibujarRuta(usuarioGlobal, colegio);
        });
    }
}

function toggleCapas() {
    const imgMiniatura = document.getElementById('miniMapa');
    const token = mapboxgl.accessToken;

    const coords = "-74.579858,-8.392186,16/100x100";

    if (esSatelite) {
        map.setStyle('mapbox://styles/mapbox/satellite-streets-v12');

        if (imgMiniatura) {
            imgMiniatura.src = `https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/${coords}?access_token=${token}`;
        }
    } else {
        map.setStyle('mapbox://styles/mapbox/streets-v11');

        if (imgMiniatura) {
            imgMiniatura.src = `https://api.mapbox.com/styles/v1/mapbox/satellite-v9/static/${coords}?access_token=${token}`;
        }
    }

    esSatelite = !esSatelite;
}

document.addEventListener("DOMContentLoaded", initMap);
