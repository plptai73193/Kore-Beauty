var markers = [
    ['1', 10.771748, 106.723530],
    ['2', 10.773578, 106.700961],
    ['3', 10.794999, 106.721946],
    ['4', 10.803184, 106.732475],
    ['5', 10.800449, 106.743194]
];

function initialize() {

    var center = { lat: 10.773578, lng: 106.700961 },
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: new google.maps.LatLng(10.7, 106.7),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

    var Markers = [];

    var iconNormal = 'common/images/ping.png',
        iconSelected = 'common/images/ping2.png',
        bounds = new google.maps.LatLngBounds();

    function setMarkers(map) {
        for (var i = 0; i < markers.length; i++) {
            var marker = markers[i],
                myLatLng = new google.maps.LatLng(marker[1], marker[2]),
                eachMarker = new google.maps.Marker({
                    record_id: i,
                    position: myLatLng,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    icon: iconNormal,
                    title: marker[0]
                });
            //var selectedMarker;
            bounds.extend(myLatLng);
            Markers.push(eachMarker);


            // choose from list
            $('.overlay li').on('click', function() {
                mapItem = $(this).index();
                changeMarker(mapItem);
                var thisLat = markers[mapItem][1],
                    thisLon = markers[mapItem][2];
                map.panTo({ lat: thisLat, lng: thisLon });
            });

            function changeMarker(record_id) {
                for (i in Markers) {
                    Markers[i].setIcon(iconNormal);
                    Markers[record_id].setIcon(iconSelected);
                }
            }
        }
    }
    map.fitBounds(bounds);
    setMarkers(map);

}
google.maps.event.addDomListener(window, 'load', initialize);