var placesIDs = Array(),
        nearbyMarkers = Array(),
        markers = Array();
jQuery( document ).ready(function($) {

    var infobox = new InfoBox({
        disableAutoPan: true, //false
        maxWidth: 275,
        alignBottom: true,
        pixelOffset: new google.maps.Size(-122, -48),
        zIndex: null,
        closeBoxMargin: "0 0 -16px -16px",
        closeBoxURL: '#',
        infoBoxClearance: new google.maps.Size(1, 1),
        isHidden: false,
        pane: "floatPane",
        enableEventPropagation: false
    });
    var propertyInfo = new InfoBox({
        disableAutoPan: false,
        maxWidth: 250,
        pixelOffset: new google.maps.Size(-72, -70),
        zIndex: null,
        boxStyle: {
            'background' : '#ffffff',
            'opacity'    : 1,
            'padding'    : '6px',
            'box-shadow' : '0 1px 2px 0 rgba(0, 0, 0, 0.12)',
            'width'      : '145px',
            'text-align' : 'center',
            'border-radius' : '4px'
        },
        closeBoxMargin: "28px 26px 0px 0px",
        closeBoxURL: "",
        infoBoxClearance: new google.maps.Size(1, 1),
        pane: "floatPane",
        enableEventPropagation: false
    });

	// map
	var ApusThemeMap = {

		init: function() {
			// half map
            if ($('#property-half-map').length > 0) {
                var map = $('#property-half-map');
                var markers = [];
                if ( $('#tab-properties-grid .property-box').length >0 ) {
                    $('#tab-properties-grid .property-box').each(function(){
                        var $item = $(this);
                        var marker = {
                            latitude: $item.data('latitude'),
                            longitude: $item.data('longitude'),
                            content: $item.find('.property-map-content').html(),
                            marker_content: $item.find('.property-map-marker').html(),
                        };
                        markers.push(marker);
                    });
                }
                var propertyMap = map.google_map({
                    geolocation: map.data('geolocation'),
                    infowindow: {
                        borderBottomSpacing: 0,
                        height: 120,
                        width: 424,
                        offsetX: 48,
                        offsetY: -87
                    },
                    zoom: map.data('zoom'),
                    marker: {
                        height: 56,
                        width: 56
                    },
                    cluster: {
                        height: 40,
                        width: 40,
                        gridSize: 60
                    },
                    styles: map.data('styles'),
                    markers: markers
                });
            }
			// single property
			if ( $('#single-property-map').length > 0 ) {
				var $item = $('#single-property-map');
				var lat = $item.data('latitude');
				var lng = $item.data('longitude');
				var map = null;
                var panorama = null;
                var fenway = new google.maps.LatLng(lat, lng);
                var mapOptions = {
                    center: fenway,
                    zoom: 15,
                    scrollwheel: false
                };
                var panoramaOptions = {
                    position: fenway,
                    pov: {
                        heading: 34,
                        pitch: 10
                    }
                };

                propertyMap = new google.maps.Map(document.getElementById('single-property-map'), mapOptions);

                $('.property-map-position .tab-google-street-view-map').click(function(){
                    if ( panorama == null ) {
                        setTimeout( function(){
                            panorama = new google.maps.StreetViewPanorama(document.getElementById('single-property-street-view-map'), panoramaOptions);
                        } , 300);
                    }
                });
                
                propertyMap.setOptions({styles: $item.data('styles')});
                ApusThemeMap.addMarkers($item, propertyMap);
                var propertyControl = new ApusThemeMap.propertyControls( propertyMap, propertyMap.getCenter() );
			}
		},
        // add makers
		addMarkers: function( $item, propertyMap ) {
			var lat = $item.data('latitude');
			var lng = $item.data('longitude');
            var latlng = new google.maps.LatLng(lat, lng);
            
            var marker = new google.maps.Marker({
                position: latlng,
                map: propertyMap,
                draggable: false,
                animation: google.maps.Animation.DROP,
            });

            markers.push(marker);
        },

		tooglePoints: function( place_item, position, propertyMap, propertyType) {
            var service = new google.maps.places.PlacesService( propertyMap );
            var bounds = propertyMap.getBounds();
            var types = new Array();

            switch(propertyType) {
                case 'transportations':
                    types = ['bus_station', 'subway_station', 'train_station', 'airport'];
                    break;
                case 'supermarkets':
                    types = ['grocery_or_supermarket', 'shopping_mall'];
                    break;
                case 'schools':
                    types = ['school', 'university'];
                    break;
                case 'libraries':
                    types = ['library'];
                    break;
                case 'pharmacies':
                    types = ['pharmacy'];
                    break;
                case 'hospitals':
                    types = ['hospital'];
                    break;
            }

            if ( !nearbyMarkers[propertyType] || nearbyMarkers[propertyType].length <= 0 ){
                
                var placemarkers = [];
                service.nearbySearch({
                    location: position,
                    bounds: bounds,
                    radius: 2000,
                    types: types
                }, function propertyCallback( results, status ) {
                    if ( status === google.maps.places.PlacesServiceStatus.OK ) {
                        for ( var i = 0; i < results.length; i++ ) {
                            var place = results[i];
                            var marker = new google.maps.Marker({
                                map: propertyMap,
                                position: place.geometry.location,
                                icon: place_item.data('icon')
                            });
                            marker.setMap( propertyMap  );
                            google.maps.event.addListener(marker, 'mouseover', function() {
                                propertyInfo.setContent(place.name);
                                propertyInfo.open(propertyMap, this);
                            });
                            google.maps.event.addListener(marker, 'mouseout', function() {
                                propertyInfo.open(null,null);
                            });
                            placemarkers.push( marker );
                        }
                        nearbyMarkers[propertyType] = placemarkers;
                    }
                });
            } else {
                for ( var i=0 ; i < nearbyMarkers[propertyType].length; i++ ) {
                    nearbyMarkers[propertyType][i].setMap( null  ); 
                }
                nearbyMarkers[propertyType] = [];
            }
        },

        propertyControls: function( propertyMap, center) {
            if ($('#property-search-places .place-btn').length > 0) {
                $('#property-search-places .place-btn').each(function(){
                    var self = $(this);
                    var type = $(this).data('type');
                    $(this).click(function() {
                        if($(this).hasClass('active')) {
                            $(this).removeClass('active');
                            ApusThemeMap.tooglePoints( self, center, propertyMap, type );
                        } else {
                            $(this).addClass('active');
                            ApusThemeMap.tooglePoints(self, center, propertyMap, type);
                        }
                        google.maps.event.addListener(propertyMap, 'bounds_changed', function() {
                            if( self.hasClass('active') ) {
                                var newCenter = propertyMap.getCenter();
                                ApusThemeMap.tooglePoints(self, newCenter, propertyMap, type);
                            }
                        });
                    });
                });
            }
        }

	}

	ApusThemeMap.init();
});