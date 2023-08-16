<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TriSakay | Driver</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" href="img/Logo_Nobg.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
</head>

<body>
  <?php
  include('php/navbar.php');
  ?>

  <div id="map"></div>
  <script>
    var map = L.map("map").setView([14.969241646712474, 120.92740825955443], 15);

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
      maxZoom: 19,
      attribution: "TriSakay",
    }).addTo(map);

    var popup = L.popup();
    var routingControl;

    function updateLocation(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;

      map.setView([latitude, longitude], 15);

      fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`)
        .then(response => response.json())
        .then(data => {
          var address = data.display_name;
          var marker = L.marker([latitude, longitude]).addTo(map);
          marker.bindPopup("You are here<br>" + address).openPopup();
        })
        .catch(error => {
          console.log("Error: " + error.message);
        });
    }

    function handleLocationError(error) {
      console.log("Error: " + error.message);
    }

    if ("geolocation" in navigator) {
  
      navigator.geolocation.getCurrentPosition(updateLocation, handleLocationError);
    } else {
      console.log("Geolocation is not available in this browser.");
    }

    map.on('click', function (e) {
      var latitude = e.latlng.lat;
      var longitude = e.latlng.lng;

      fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`)
        .then(response => response.json())
        .then(data => {
          var address = data.display_name;
          var popup = L.popup()
            .setLatLng(e.latlng)
            .setContent("Clicked Location<br>" + address)
            .openOn(map);

          if (routingControl) {
            map.removeControl(routingControl);
          }

          routingControl = L.Routing.control({
            waypoints: [
              L.latLng(map.getCenter()),
              L.latLng(latitude, longitude)
            ],
            routeWhileDragging: true,
            geocoder: L.Control.Geocoder.nominatim(),
            router: L.Routing.osrmv1({
              language: 'en',
              profile: 'driving',
            }),
            summaryTemplate: '<div class="start">{name}</div><div class="info {costing}">{distance}, {time}</div>',
          }).addTo(map);
        })
        .catch(error => {
          console.log("Error: " + error.message);
        });
    });


  </script>
</body>

</html>