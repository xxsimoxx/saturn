<?php
/**
 * Remove empty paragraphs from shortcode
 *
 * Removes empty paragraph tags from shortcode content
 *
 * @param string $content Content to be cleaned
 * @return string $content Cleaned content
 */
function saturn_paragraph_fix( $content ) {
    $remove_array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
        ']<br>'   => ']',
    ];

    $content = strtr( $content, $remove_array );

    return $content;
}



add_filter( 'the_content', 'saturn_paragraph_fix', 10, 1 );



function get_osm_map( $atts ) {
    $attributes = shortcode_atts(
        [
            'markers' => '',
        ],
        $atts
    );

    /**
     * [55.134874, -7.453658, "Market Square, Buncrana, Co. Donegal"],
     * [55.2512645,-7.2618951, "The Diamond, Carndonagh, Co. Donegal"],
     */
    $address_points = '';
    $markers        = explode( '|', $attributes['markers'] );
    foreach ( $markers as $marker ) {
        $address_points .= '[' . trim( $marker ) . '],';
    }

    $out = '<div id="osm-map"></div>
    <script>
    window.addEventListener("load", function (event) {
        var osmMap = L.map("osm-map").setView([0, 0], 16);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "&copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors"
        }).addTo(osmMap);
        L.control.scale().addTo(osmMap);

        // Markers
        var addressPoints = [
            ' . $address_points . '
        ];
        var markers = L.markerClusterGroup({
            spiderfyOnMaxZoom: false,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: false
        });

        for (var i = 0; i < addressPoints.length; i++) {
			var a = addressPoints[i];
			var title = a[2];
			var marker = L.marker(new L.LatLng(a[0], a[1]), { title: title });
			marker.bindPopup(title);
			markers.addLayer(marker);
		}
        osmMap.addLayer(markers);

        osmMap.fitBounds([addressPoints]);

        var currentZoom = parseInt(osmMap.getZoom());
        osmMap.setZoom(currentZoom);
    }, false);
    </script>';

    return $out;
}

function saturn_fa( $atts ) {
    $attributes = shortcode_atts(
        [
            'class' => '',
        ],
        $atts
    );

    $class = sanitize_text_field( $attributes['class'] );

    return '<i class="' . $class . '"></i>';
}
add_shortcode( 'fa', 'saturn_fa' );


add_shortcode( 'osm-map', 'get_osm_map' );
