<?php
vc_map(array(
    "name" => 'Google Maps',
    "base" => "maps",
    "category" => __('mediPress', 'medipress'),
	"icon" => "tb-icon-for-vc",
    "description" => __('Google Maps API V3', 'medipress'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __('API Key', 'medipress'),
            "param_name" => "api",
            "value" => '',
            "description" => __('Enter you api key of map, get key from (https://console.developers.google.com)', 'medipress')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Address', 'medipress'),
            "param_name" => "address",
            "value" => 'New York, United States',
            "description" => __('Enter address of Map', 'medipress')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Coordinate', 'medipress'),
            "param_name" => "coordinate",
            "value" => '',
            "description" => __('Enter coordinate of Map, format input (latitude, longitude)', 'medipress')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Click Show Info window', 'medipress'),
            "param_name" => "infoclick",
            "value" => array(
                __("Yes, please", 'medipress') => true
            ),
            "group" => __("Marker", 'medipress'),
            "description" => __('Click a marker and show info window (Default Show).', 'medipress')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Marker Coordinate', 'medipress'),
            "param_name" => "markercoordinate",
            "value" => '',
            "group" => __("Marker", 'medipress'),
            "description" => __('Enter marker coordinate of Map, format input (latitude, longitude)', 'medipress')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Marker Title', 'medipress'),
            "param_name" => "markertitle",
            "value" => '',
            "group" => __("Marker", 'medipress'),
            "description" => __('Enter Title Info windows for marker', 'medipress')
        ),
        array(
            "type" => "textarea",
            "heading" => __('Marker Description', 'medipress'),
            "param_name" => "markerdesc",
            "value" => '',
            "group" => __("Marker", 'medipress'),
            "description" => __('Enter Description Info windows for marker', 'medipress')
        ),
        array(
            "type" => "attach_image",
            "heading" => __('Marker Icon', 'medipress'),
            "param_name" => "markericon",
            "value" => '',
            "group" => __("Marker", 'medipress'),
            "description" => __('Select image icon for marker', 'medipress')
        ),
        array(
            "type" => "textarea_raw_html",
            "heading" => __('Marker List', 'medipress'),
            "param_name" => "markerlist",
            "value" => '',
            "group" => __("Multiple Marker", 'medipress'),
            "description" => __('[{"coordinate":"41.058846,-73.539423","icon":"","title":"title demo 1","desc":"desc demo 1"},{"coordinate":"40.975699,-73.717636","icon":"","title":"title demo 2","desc":"desc demo 2"},{"coordinate":"41.082606,-73.469718","icon":"","title":"title demo 3","desc":"desc demo 3"}]', 'medipress')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Info Window Max Width', 'medipress'),
            "param_name" => "infowidth",
            "value" => '200',
            "group" => __("Marker", 'medipress'),
            "description" => __('Set max width for info window', 'medipress')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Map Type", 'medipress'),
            "param_name" => "type",
            "value" => array(
                "ROADMAP" => "ROADMAP",
                "HYBRID" => "HYBRID",
                "SATELLITE" => "SATELLITE",
                "TERRAIN" => "TERRAIN"
            ),
            "description" => __('Select the map type.', 'medipress')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style Template", 'medipress'),
            "param_name" => "style",
            "value" => array(
                "Default" => "",
                "Subtle Grayscale" => "Subtle-Grayscale",
                "Shades of Grey" => "Shades-of-Grey",
                "Blue water" => "Blue-water",
                "Pale Dawn" => "Pale-Dawn",
                "Blue Essence" => "Blue-Essence",
                "Apple Maps-esque" => "Apple-Maps-esque",
            ),
            "group" => __("Map Style", 'medipress'),
            "description" => 'Select your heading size for title.'
        ),
        array(
            "type" => "textfield",
            "heading" => __('Zoom', 'medipress'),
            "param_name" => "zoom",
            "value" => '13',
            "description" => __('zoom level of map, default is 13', 'medipress')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Width', 'medipress'),
            "param_name" => "width",
            "value" => 'auto',
            "description" => __('Width of map without pixel, default is auto', 'medipress')
        ),
        array(
            "type" => "textfield",
            "heading" => __('Height', 'medipress'),
            "param_name" => "height",
            "value" => '350px',
            "description" => __('Height of map without pixel, default is 350px', 'medipress')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Scroll Wheel', 'medipress'),
            "param_name" => "scrollwheel",
            "value" => array(
                __("Yes, please", 'medipress') => true
            ),
            "group" => __("Controls", 'medipress'),
            "description" => __('If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'medipress')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Pan Control', 'medipress'),
            "param_name" => "pancontrol",
            "value" => array(
                __("Yes, please", 'medipress') => true
            ),
            "group" => __("Controls", 'medipress'),
            "description" => __('Show or hide Pan control.', 'medipress')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Zoom Control', 'medipress'),
            "param_name" => "zoomcontrol",
            "value" => array(
                __("Yes, please", 'medipress') => true
            ),
            "group" => __("Controls", 'medipress'),
            "description" => __('Show or hide Zoom Control.', 'medipress')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Scale Control', 'medipress'),
            "param_name" => "scalecontrol",
            "value" => array(
                __("Yes, please", 'medipress') => true
            ),
            "group" => __("Controls", 'medipress'),
            "description" => __('Show or hide Scale Control.', 'medipress')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Map Type Control', 'medipress'),
            "param_name" => "maptypecontrol",
            "value" => array(
                __("Yes, please", 'medipress') => true
            ),
            "group" => __("Controls", 'medipress'),
            "description" => __('Show or hide Map Type Control.', 'medipress')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Street View Control', 'medipress'),
            "param_name" => "streetviewcontrol",
            "value" => array(
                __("Yes, please", 'medipress') => true
            ),
            "group" => __("Controls", 'medipress'),
            "description" => __('Show or hide Street View Control.', 'medipress')
        ),
        array(
            "type" => "checkbox",
            "heading" => __('Over View Map Control', 'medipress'),
            "param_name" => "overviewmapcontrol",
            "value" => array(
                __("Yes, please", 'medipress') => true
            ),
            "group" => __("Controls", 'medipress'),
            "description" => __('Show or hide Over View Map Control.', 'medipress')
        )
    )
));