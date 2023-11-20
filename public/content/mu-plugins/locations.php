<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-04 16:53:05
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-09-20 12:57:02
 */

/**
 * Plugin Name: Rolling Donut Shop Locations
 * Description: Adds a LeafletJS map to the locations page
 */

//LEAFLET JS MAP SCRIPT
add_action('wp_footer', function() {
    if (is_page_template('templates/template-locations.blade.php')) {
        // Fetch locations from WordPress
           $args = [
            'post_type' => 'location',
            'posts_per_page' => -1,
         ];

        $query = new WP_Query($args);
        $locations = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $locations[] = [
                    'address' => get_field('address'),
                    'coordinates' => [get_field('latitude_coordinates'), get_field('longitude_coordinates')],
                ];
            }
            wp_reset_postdata();
        }

        // Convert PHP array to JSON
        $locations_json = json_encode($locations);
        ?>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Define geographical bounds to include Ireland and Great Britain
            var southWest = L.latLng(49.0, -11.0),
                northEast = L.latLng(59.0, 2.0),
                bounds = L.latLngBounds(southWest, northEast);

            // Initialize the map with Dublin, Ireland as the default location
            var map = L.map('map', {
                scrollWheelZoom: false,
                maxBounds: bounds,
                maxBoundsViscosity: 1.0,
                minZoom: 5,
                zoomControl: false // Disable default zoom control
            }).setView([53.34543, -6.2591], 15);

            // Add new zoom control at the bottom left corner
            L.control.zoom({
                position: 'bottomleft'
            }).addTo(map);

            // Enable scroll wheel zoom when the map is clicked
            map.on('click', function() {
                if (map.scrollWheelZoom.enabled()) {
                    map.scrollWheelZoom.disable();
                } else {
                    map.scrollWheelZoom.enable();
                }
            });

            // Add Wikimedia layer
            L.tileLayer('https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}{r}.png', {
                attribution: '<a href="https://wikimediafoundation.org/wiki/Maps_Terms_of_Use">Wikimedia</a>',
                minZoom: 1,
                maxZoom: 19
            }).addTo(map);

            // Custom pin
            var customPin = L.icon({
                iconUrl: 'https://rollingdonuts.lndo.site/content/uploads/2023/09/13-1.png',
                iconSize: [75,75],
            });

            // Function to geocode address and add marker to the map
            function geocodeAndAddMarker(address, fallbackCoordinates) {
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${address}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const lat = data[0].lat;
                        const lon = data[0].lon;
                        L.marker([lat, lon], { icon: customPin })
                        .bindPopup(address)
                        .addTo(map);
                    } else if (fallbackCoordinates) {
                        L.marker(fallbackCoordinates, { icon: customPin })
                        .bindPopup(address)
                        .addTo(map);
                    }
                })
                .catch(error => {
                    console.error('Geocoding error:', error);
                    if (fallbackCoordinates) {
                        L.marker(fallbackCoordinates, { icon: customPin })
                        .bindPopup(address)
                        .addTo(map);
                    }
                });
            }

            // Addresses with optional fallback coordinates
            var locations = <?php echo $locations_json; ?>;

            // Add markers for each address with fallback coordinates
            locations.forEach(location => geocodeAndAddMarker(location.address, location.coordinates));
        });
        </script>
        <?php
    }
});

//LOCATIONS POST TYPE CLEAN UP
add_action('init', function() {
    remove_post_type_support('location', 'editor');
});

add_filter('wpseo_metabox_prio', function() {
    return 'low';
});

add_action('add_meta_boxes', function() {
    remove_meta_box('wpseo_meta', 'location', 'normal');
}, 11);
