var map;
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 40.29529991586372, lng: 21.792559570312505 },
    zoom: 8
  });
  marker = new google.maps.Marker({
    position: { lat: 40.29529991586372, lng: 21.792559570312505 },
    map: map,
    draggable: true,
    title: "Drag me!"
  });
  google.maps.event.addListener(marker, "dragend", function(event) {
    document.getElementById("lat").value = event.latLng.lat();

    document.getElementById("long").value = event.latLng.lng();

    //  infoWindow.open(map, marker);
  });
}
