
<?php

include_once 'database.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        include_once './partials/head.php';
    ?>
    <style>
        #map {
            height: 500px;
            width: 80%;
        }
    </style>
    <script src="http://maps.googleapis.com/maps/api/js?&sensor=false">
    </script>
</head>

<body class="container" style="margin-bottom: 10px">
    <header>
        <?php
        include_once './partials/header.php';
    ?>
    </header>
    <h3 style="text-align: center">Store location</h3>
    <!--The div element for the map -->
    <div id="map" style="display: block; margin: auto"></div>
    <script>
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            var uluru = {
                lat: -36.845386,
                lng: 174.763701
            };
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {
                    zoom: 13,
                    center: uluru
                });
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });

            var infowindow = new google.maps.InfoWindow({
                content: '<iframe title="YouTube video player" type="text/html" width="100%" height="100%" src="https://www.youtube.com/embed/-gxpLGIKGB4" frameborder="0"></iframe>'
            });

            google.maps.event.addListener(marker, 'click', function initialize() {

                infowindow.open(map, marker);
            });
        }
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwm2E_OjJYenUuoA9oLDrsZ7o8W9aSKr4&callback=initMap">
    </script>


</body>
    <footer>
    <?php
            include './partials/footer.php';
    ?>
    </footer>
</html>