function initMap() {
    var uluru = {lat: -34.5694447, lng: -58.45688999999999};

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: uluru,
      disableDefaultUI: true,
      zoomControl: true
    });

    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
    var cityCircle = new google.maps.Circle({
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.2,
        map: map,
        center: uluru,
        radius: 1000
      });
    
}