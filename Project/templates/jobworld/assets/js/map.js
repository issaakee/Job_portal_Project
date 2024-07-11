"use strict";


function LoadMap_main_default() {
    // option
    if ($('#main-map-template').length) {
        var myLocationEnabled = true;
        var style_map = [{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"}]}, {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"}]}, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100}, {"lightness": 45}]}, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"}]}, {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#46bcec"}, {"visibility": "on"}]}];
        var scrollwheelEnabled = false;

        var markers = new Array();
        var mapOptions = {
            center: new google.maps.LatLng(34.015008, -118.473215),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: scrollwheelEnabled,
            // styles:style_map
        };
        var markers_map = new Array(
            [34.05843, -118.491046, 'icon_id-2', '', 'Contraband Coffee Bar', 'black'],
            [34.066673, -118.486562, 'icon_pushpin', '', 'Blue Ribbon Sushi', ''],
            [34.009714, -118.480296, 'icon_id-2', '', 'Korchma Taras Bulba', ''],
            [34.010408, -118.473215, 'icon_pushpin', '', 'Coffee Bar', 'black'],
            [34.01521, -118.474889, 'icon_id-2', '', 'Perfect Places With Pool', ''],
            [34.022502, -118.480124, 'icon_pushpin', '', 'Trending Summer Places', 'black'],
            [34.024423, -118.459868, 'icon_id-2', '', 'Blue Ribbon Sushi', ''],
            [34.024885, -118.44871, 'icon_pushpin', '', 'Which Bar to Choose', ''],
            [34.002368, -118.482828, 'icon_id-2', '', 'Blue Ribbon Sushi', 'black']
        );

        var map = new google.maps.Map(document.getElementById('main-map-template'), mapOptions);

        $.each(markers_map, function (index, marker_map) {

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(marker_map[0], marker_map[1]),
                map: map,
                icon: 'assets/img/markers/marker-transparent.png'
            });

            var markerOptions_1 = {
                content: '<div class="infobox ' + marker_map[5] + '">' +
                    '<div class="content">' +
                        '<div class="title"> <a href="09_Job_Open.html">' + marker_map[4] + '</a></div>' +
                        '<div class="body">'+
                        'Strategic Technologies'+
                        '</div>'+
                    '</div>'+
                '</div>',
                disableAutoPan: false,
                maxWidth: 0,
                pixelOffset: new google.maps.Size(-175, -205),
                zIndex: null,
                infoBoxClearance: new google.maps.Size(1, 1),
                position: new google.maps.LatLng(marker_map[0], marker_map[1]),
                isHidden: false,
                pane: "floatPane",
                enableEventPropagation: false,
                closeBoxURL: "assets/img/close.png"
            };
            marker.infobox = new InfoBox(markerOptions_1);
            marker.infobox.isOpen = false;
            // marker
            var markerOptions_2 = {
                draggable: false,
                content: '<div class="google_marker ' + marker_map[5] + '"><span><i class="'+marker_map[2]+'"></i></span></div>',
                disableAutoPan: true,
                pixelOffset: new google.maps.Size(-25, -95),
                position: new google.maps.LatLng(marker_map[0], marker_map[1]),
                closeBoxMargin: "",
                closeBoxURL: "",
                isHidden: false,
                //pane: "mapPane",
                enableEventPropagation: true
            };
            marker.marker = new InfoBox(markerOptions_2);      
            marker.marker.isHidden = false;      
            marker.marker.open(map, marker);
            markers.push(marker);

            // action        
            google.maps.event.addListener(marker, "click", function (e) {
                var curMarker = this;

                $.each(markers, function (index, marker) {
                    // if marker is not the clicked marker, close the marker
                    if (marker !== curMarker) {
                        marker.infobox.close();
                        marker.infobox.isOpen = false;
                    }
                });

                if (curMarker.infobox.isOpen === false) {
                    curMarker.infobox.open(map, this);
                    curMarker.infobox.isOpen = true;
                    map.panTo(curMarker.getPosition());
                } else {
                    curMarker.infobox.close();
                    curMarker.infobox.isOpen = false;
                }

            });
        });

        var mcOptions = {
            gridSize: 40,
            styles: [
                {
                    height: 52,
                    url: 'assets/img/cluster/m1.png',
                    width: 52,
                    textColor: '#fff'
                }
            ]
        };

        var marker_clusterer = new MarkerClusterer(map, markers, mcOptions);
        var clusterListener = google.maps.event.addListener(marker_clusterer, 'clusteringend', function (clusterer) {
            var availableClusters = clusterer.getClusters();
            var activeClusters = new Array();
            $.each(availableClusters, function (index, cluster) {
                if (cluster.getMarkers().length > 1) {
                    $.each(cluster.getMarkers(), (function (index, marker) {
                        if (marker.marker.isHidden == false) {
                            marker.marker.isHidden = true;
                            marker.marker.close();
                        }
                    }));
                } else {
                    $.each(cluster.getMarkers(), function (index, marker) {
                        if (marker.marker.isHidden == true) {
                            marker.marker.open(map, this);
                            marker.marker.isHidden = false;
                        }
                    });
                }
            });
        });
        if (myLocationEnabled) {
            // [START gmap mylocation]

            // Construct your control in whatever manner is appropriate.
            // Generally, your constructor will want access to the
            // DIV on which you'll attach the control UI to the Map.
            var controlDiv = document.createElement('div');

            // We don't really need to set an index value here, but
            // this would be how you do it. Note that we set this
            // value as a property of the DIV itself.
            controlDiv.index = 1;

            // Add the control to the map at a designated control position
            // by pushing it on the position's array. This code will
            // implicitly add the control to the DOM, through the Map
            // object. You should not attach the control manually.
            map.controls[google.maps.ControlPosition.RIGHT_TOP].push(controlDiv);

            HomeControl(controlDiv, map)

            // [END gmap mylocation]
        }
    }
}

function LoadMap_with_images() {
    // option
    if ($('#main-map_images-template').length) {
        var myLocationEnabled = true;
        var style_map = [{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"}]}, {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"}]}, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100}, {"lightness": 45}]}, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"}]}, {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#46bcec"}, {"visibility": "on"}]}];
        var scrollwheelEnabled = false;

        var markers = new Array();
        var mapOptions = {
            center: new google.maps.LatLng(34.015008, -118.473215),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: scrollwheelEnabled,
            // styles:style_map
        };
        var markers_map = new Array(
            [34.05843, -118.491046, 'icon_id-2', 'assets/img/pic/users/rewiever-p.jpg', 'Contraband Coffee Bar', 'black'],
            [34.066673, -118.486562, 'icon_pushpin', 'assets/img/pic/users/rewiever-d.jpg', 'Blue Ribbon Sushi', ''],
            [34.009714, -118.480296, 'icon_id-2', 'assets/img/pic/users/rewiever-c.jpg', 'Korchma Taras Bulba', ''],
            [34.010408, -118.473215, 'icon_pushpin', 'assets/img/pic/users/rewiever-p.jpg', 'Coffee Bar', 'black'],
            [34.01521, -118.474889, 'icon_id-2', 'assets/img/pic/users/rewiever-d.jpg', 'Perfect Places With Pool', ''],
            [34.022502, -118.480124, 'icon_pushpin', 'assets/img/pic/users/rewiever-c.jpg', 'Trending Summer Places', 'black'],
            [34.024423, -118.459868, 'icon_id-2', 'assets/img/pic/users/rewiever-c.jpg', 'Blue Ribbon Sushi', ''],
            [34.024885, -118.44871, 'icon_pushpin', 'assets/img/pic/users/rewiever-p.jpg', 'Which Bar to Choose', ''],
            [34.002368, -118.482828, 'icon_id-2', 'assets/img/pic/users/rewiever-d.jpg', 'Blue Ribbon Sushi', 'black']
        );

        var map = new google.maps.Map(document.getElementById('main-map_images-template'), mapOptions);

        $.each(markers_map, function (index, marker_map) {

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(marker_map[0], marker_map[1]),
                map: map,
                icon: 'assets/img/markers/marker-transparent.png'
            });

            var markerOptions_1 = {
                content: '<div class="infobox s_preview <!--' + marker_map[5] + '-->">' +
                        '<div class="preview"><a href="09_Job_Open.html"><img src="' + marker_map[3] + '"/></a></div>' +
                        '<div class="content">' +
                            '<div class="title"><a href="09_Job_Open.html">' + marker_map[4] + '</a></div>' +
                            '<div class="body">'+
                            '<div class="options">'+
                                '<span class="opt">Data Analyst</span>'+
                                '<span class="opt-light"><i class="icon_pin_alt"></i>Los Angeles, CA</span>'+
                            '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>',
                disableAutoPan: false,
                maxWidth: 0,
                pixelOffset: new google.maps.Size(-175, -205),
                zIndex: null,
                infoBoxClearance: new google.maps.Size(1, 1),
                position: new google.maps.LatLng(marker_map[0], marker_map[1]),
                isHidden: false,
                pane: "floatPane",
                enableEventPropagation: false,
                closeBoxURL: "assets/img/close.png"
            };
            marker.infobox = new InfoBox(markerOptions_1);
            marker.infobox.isOpen = false;
            // marker
            var markerOptions_2 = {
                draggable: false,
                content: '<div class="google_marker ' + marker_map[5] + '"><span><i class="'+marker_map[2]+'"></i></span></div>',
                disableAutoPan: true,
                pixelOffset: new google.maps.Size(-25, -95),
                position: new google.maps.LatLng(marker_map[0], marker_map[1]),
                closeBoxMargin: "",
                closeBoxURL: "",
                isHidden: false,
                //pane: "mapPane",
                enableEventPropagation: true
            };
            marker.marker = new InfoBox(markerOptions_2);      
            marker.marker.isHidden = false;      
            marker.marker.open(map, marker);
            markers.push(marker);

            // action        
            google.maps.event.addListener(marker, "click", function (e) {
                var curMarker = this;

                $.each(markers, function (index, marker) {
                    // if marker is not the clicked marker, close the marker
                    if (marker !== curMarker) {
                        marker.infobox.close();
                        marker.infobox.isOpen = false;
                    }
                });

                if (curMarker.infobox.isOpen === false) {
                    curMarker.infobox.open(map, this);
                    curMarker.infobox.isOpen = true;
                    map.panTo(curMarker.getPosition());
                } else {
                    curMarker.infobox.close();
                    curMarker.infobox.isOpen = false;
                }

            });
        });

        var mcOptions = {
            gridSize: 40,
            styles: [
                {
                    height: 52,
                    url: 'assets/img/cluster/m1.png',
                    width: 52,
                    textColor: '#fff'
                }
            ]
        };

        var marker_clusterer = new MarkerClusterer(map, markers, mcOptions);
        var clusterListener = google.maps.event.addListener(marker_clusterer, 'clusteringend', function (clusterer) {
            var availableClusters = clusterer.getClusters();
            var activeClusters = new Array();
            $.each(availableClusters, function (index, cluster) {
                if (cluster.getMarkers().length > 1) {
                    $.each(cluster.getMarkers(), (function (index, marker) {
                        if (marker.marker.isHidden == false) {
                            marker.marker.isHidden = true;
                            marker.marker.close();
                        }
                    }));
                } else {
                    $.each(cluster.getMarkers(), function (index, marker) {
                        if (marker.marker.isHidden == true) {
                            marker.marker.open(map, this);
                            marker.marker.isHidden = false;
                        }
                    });
                }
            });
        });
        if (myLocationEnabled) {
            // [START gmap mylocation]

            // Construct your control in whatever manner is appropriate.
            // Generally, your constructor will want access to the
            // DIV on which you'll attach the control UI to the Map.
            var controlDiv = document.createElement('div');

            // We don't really need to set an index value here, but
            // this would be how you do it. Note that we set this
            // value as a property of the DIV itself.
            controlDiv.index = 1;

            // Add the control to the map at a designated control position
            // by pushing it on the position's array. This code will
            // implicitly add the control to the DOM, through the Map
            // object. You should not attach the control manually.
            map.controls[google.maps.ControlPosition.RIGHT_TOP].push(controlDiv);

            HomeControl(controlDiv, map)

            // [END gmap mylocation]
        }
    }
}


function map_property() {

    var map;
    if ($('#property-map').length) {
        var myLocationEnabled = true;
        var style_map = null;
        var scrollwheelEnabled = false;

        var markers = new Array();
        var mapOptions = {
            center: new google.maps.LatLng(45.812231, 15.920618),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: scrollwheelEnabled,
            //styles:style_map
        };

        var map = new google.maps.Map(document.getElementById('property-map'), mapOptions);



        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(45.812231, 15.920618),
            map: map,
            icon: 'assets/img/markers/marker-transparent.png'
        });

        var markerOptions_1 = {
            content: '<div class="infobox primary">' +
            '<div class="content">' +
            '<div class="title"> <a href="listing.html">Headquarters</a></div>' +
            '<div class="body">'+
            '<b>768 5th Ave, New York, NY 10019, USA</b>'+
            '</div>'+
            '</div>'+
            '</div>',
            disableAutoPan: false,
            maxWidth: 0,
            pixelOffset: new google.maps.Size(-175, -205),
            zIndex: null,
            infoBoxClearance: new google.maps.Size(1, 1),
            position: new google.maps.LatLng(45.812231, 15.920618),
            isHidden: false,
            pane: "floatPane",
            enableEventPropagation: false,
            closeBoxURL: "assets/img/close.png"
        };
        marker.infobox = new InfoBox(markerOptions_1);
        marker.infobox.isOpen = false;
        // marker
        var markerOptions_2 = {
            draggable: false,
            content: '<div class="google_marker black"><span><i class="icon_pin"></i></span></div>',
            disableAutoPan: true,
            pixelOffset: new google.maps.Size(-25, -95),
            position: new google.maps.LatLng(45.812231, 15.920618),
            closeBoxMargin: "",
            closeBoxURL: "",
            isHidden: false,
            //pane: "mapPane",
            enableEventPropagation: true
        };
        marker.marker = new InfoBox(markerOptions_2);      
        marker.marker.isHidden = false;      
        marker.marker.open(map, marker);
        markers.push(marker);

        // action        
        google.maps.event.addListener(marker, "click", function (e) {
            var curMarker = this;

            $.each(markers, function (index, marker) {
                // if marker is not the clicked marker, close the marker
                if (marker !== curMarker) {
                    marker.infobox.close();
                    marker.infobox.isOpen = false;
                }
            });

            if (curMarker.infobox.isOpen === false) {
                curMarker.infobox.open(map, this);
                curMarker.infobox.isOpen = true;
                map.panTo(curMarker.getPosition());
            } else {
                curMarker.infobox.close();
                curMarker.infobox.isOpen = false;
            }

        });

    }

}

function HomeControl(controlDiv, map) {

    // Set CSS styles for the DIV containing the control
    // Setting padding to 5 px will offset the control
    // from the edge of the map.
    controlDiv.style.padding = '5px';

    // Set CSS for the control border.
    var controlUI = document.createElement('div');
    controlUI.id = 'my_location';
    controlUI.style.backgroundColor = 'white';
    controlUI.style.borderStyle = 'solid';
    controlUI.style.borderWidth = '2px';
    controlUI.style.cursor = 'pointer';
    controlUI.style.margin = '5px';
    controlUI.style.textAlign = 'center';
    controlUI.title = 'My Location';
    controlDiv.appendChild(controlUI);

    // Set CSS for the control interior.
    var controlText = document.createElement('div');
    controlText.style.fontFamily = 'Arial,sans-serif';
    controlText.style.fontSize = '12px';
    controlText.style.paddingLeft = '4px';
    controlText.style.paddingRight = '4px';
    controlText.innerHTML = '<strong>My Location</strong>';
    controlUI.appendChild(controlText);

    // Setup the click event listeners: simply set the map to Chicago.
    google.maps.event.addDomListener(controlUI, 'click', function () {
        var myloc = new google.maps.Marker({
            clickable: false,
            icon: new google.maps.MarkerImage('//maps.gstatic.com/mapfiles/mobile/mobileimgs2.png',
                                              new google.maps.Size(22, 22),
                                              new google.maps.Point(0, 18),
                                              new google.maps.Point(11, 11)),
            shadow: null,
            zIndex: 999,
            map: map
        });

        if (navigator.geolocation)
            navigator.geolocation.getCurrentPosition(function (pos) {
                var me = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
                myloc.setPosition(me);

                // Zoom in
                var bounds = new google.maps.LatLngBounds();
                bounds.extend(me);
                map.fitBounds(bounds);
                var zoom = map.getZoom();
                map.setZoom(zoom > zoomOnMapSearch ? zoomOnMapSearch : zoom);
            }, function (error) {
                console.log(error);
            });
    });
}
