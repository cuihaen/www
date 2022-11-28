 window.onload = function() {
    var container = document.getElementById('company');
    var options = {
        center: new daum.maps.LatLng(37.57238527004398, 127.00106407045745),
        level: 3 //확대되서 나오는 배율 
    };

    var map = new daum.maps.Map(container, options);
    
    var mapTypeControl = new daum.maps.MapTypeControl();
    map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);

    var zoomControl = new daum.maps.ZoomControl();
    map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);
    
    var markerPosition  = new daum.maps.LatLng(37.57238527004398, 127.00106407045745); 
    var marker = new daum.maps.Marker({
        position: markerPosition
    });

    marker.setMap(map);
    
    var overlay = new daum.maps.CustomOverlay({
        map: map,
        position: marker.getPosition()       
    });
}