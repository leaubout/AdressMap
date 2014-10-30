<!DOCTYPE html>
<html>
    <head>
        <title>Simple Map</title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <style>
            html, body{
              height: 100%;
              margin: 0px;
              padding: 0px
            }

            #map-canvas{
              width: 80%;
              height: 600px;
              margin: 50px auto;
            }

            h4{
              margin-top, margin-bottom: 3px;
            }

            p{
              margin-top, margin-bottom: 2px;
            }

        </style>
    </head>
    <body>
      <div>138 rue Marcadet 75018 Paris</div>
    	<div id="map-canvas"></div>
    	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    	<script>

          var geocoder;
          var map;
          var marker;

          function codeAddress() {
            var address = "138 rue Marcadet 75018 Paris";
            geocoder.geocode( { 'address': address}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                marker = new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location
                });

              var controlDiv = document.createElement('div');
              var controlTitle = document.createElement('h4');
              controlTitle.style.marginTop = '3px';
              controlTitle.style.marginBottom = '3px';
              controlTitle.innerHTML = "Ligue de défense des droits de l'homme";
              controlDiv.appendChild(controlTitle);
              
              var controlDescription = document.createElement('p');
              controlDescription.style.marginTop = '2px';
              controlDescription.style.marginBottom = '2px';
              controlDescription.innerHTML = "Association de défense des droits de l'homme";
              controlDiv.appendChild(controlDescription);

              var controlHr = document.createElement('hr');
              controlDiv.appendChild(controlHr);

              var controlUrl = document.createElement('a');
              controlUrl.style.marginBottom = '5px';
              controlUrl.setAttribute('href','http://www.ldh-france.org');
              controlUrl.innerHTML = "www.ldh-france.org";
              controlDiv.appendChild(controlUrl);

              var infowindow = new google.maps.InfoWindow({
                content: controlDiv});

              infowindow.open(map,marker);
              
              google.maps.event.addListener(marker,'click', function(){
                infowindow.open(map,marker)});

              } else {
                alert('Geocode was not successful for the following reason: ' + status);
              }
            });
          }

           function initialize() {

              var mapOptions = {
                 zoom: 7,
                 center: new google.maps.LatLng(48.857, 2.352)
              };

              map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

              geocoder = new google.maps.Geocoder();
              codeAddress();
           }

           google.maps.event.addDomListener(window, 'load', initialize);
        </script>
    </body>
</html>
