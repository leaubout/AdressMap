<?php
    
    require_once '../bdd/address.php';
    $addressList = read($pdo);    
    
    $title = "Affichage des contacts";
    ob_start();?>
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.3/css/jquery.dataTables.css">
        <style>
            #map-canvas{ 
            	height: 600px; 
            	width: 80%; 
            	margin: 50px auto;
            } 
            .gm-style-iw {
                min-width: 200px;
                min-height: 40px;
                max-width: 400px;
                max-height: 400px;
            }
        </style>   
<?php
    $afterBootstrap = ob_get_clean();

    ob_start();?>
        <!-- DataTables -->
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.js"></script>    

        <script>
            $(document).ready( function () {
                $('#table_id').DataTable();
            } );
        </script>
<?php         
    $afterjQuery = ob_get_clean();    

    require_once '../layout/header.php';
    $counter = count($addressList);
?>    
        <div class="container">
            <h2>Liste de vos contacts</h2>
            <table id="table_id" class="display">
                <thead>
                <tr>
                    <?php foreach($addressList[0] as $addressColumns => $value){?>
                    <th><?php echo $addressColumns?></th>
                    <?php }?>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody><?php foreach($addressList as $address) {?>
                    <tr>
                        <?php foreach($address as $key => $value){?>
                        <td><?php echo $value?></td>
                        <?php }?>
                        <td>
                            <a class="btn btn-success" href="update.php?id=<?= $address['id'] ?>">Mettre à jour</a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="delete.php?id=<?= $address['id'] ?>">Supprimer</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table><br><br> 
            <h2>Carte de vos contacts</h2>
            <div id="map-canvas"></div>
            <a href="index.php" class="btn btn-info">Revenir à l'accueil</a>
        </div>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    	<script>

          var geocoder;
          var map;

          function makeMap(){
              geocoder.geocode( { 'address': "Paris, France"}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
            	    var centerPosition = results[0].geometry.location;

                    var mapOptions = {
                            zoom: 6,
                            center: centerPosition
                    };
                    
                    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            	    
                } else {
                  alert('Geocode was not successful for the following reason: ' + status);
                }
              });
           }
          
          function makeMarker(id, title, address, description, url){
            geocoder.geocode( { 'address': address}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
          	    var nameMarker = "marker" + id;
                nameMarker = new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location
                });

                //var infoWindowContent = '<div style="minWidth:200px;minHeight:50px;maxHeight:100px">';
                var infoWindowContent = '<div>';
                infoWindowContent += '<h4 style="margin-top:3px;margin-bottom:3px">' + title + '</h4>';
                infoWindowContent += '<p style="margin-top:2px;margin-bottom:2px">' + description + '</p>';  
                infoWindowContent +='<hr style="margin:5px">';
                infoWindowContent += '<a href="'+ url + '" style="margin:2px">' + url + '</a>';
                infoWindowContent += '</div">';

                var infowindow = new google.maps.InfoWindow({
             	   content: infoWindowContent
             	});

                //infowindow.open(map,nameMarker);
                
                google.maps.event.addListener(nameMarker,'click', function(){
                    infowindow.open(map,nameMarker);
                    //document.getElementById(id).style.width = '200px';
                    //document.getElementById(id).style.height = '150px';

                });

              }else {
                alert('Geocode was not successful for the following reason: ' + status);
             }
            });
          }

           function initialize() {
        	  geocoder = new google.maps.Geocoder();

        	  makeMap();
        	  
<?php   foreach($addressList as $address){ 
?>
              makeMarker("<?= $address['id']; ?>","<?= $address['title']; ?>",
                "<?= $address['address']; ?>","<?= $address['description']; ?>","<?= $address['url']; ?>");
<?php
        } 
?>
           }

           google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        
<?php
    require_once '../layout/footer.php'; 
?>
    