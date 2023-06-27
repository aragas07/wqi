<script>
htall.include('layout/publish.html')
</script>
<div id="extend">

    <div class="row col-12 m-0 p-0" style="">
        <?php
            include '../admin/conn/conn.php';
            function dms_to_degree($dms){
                // extract degrees, minutes, and seconds
                $pattern = "/(\d+)°(\d+)\’([\d\.]+)\”([NSWE])/"; 
                preg_match($pattern, $dms, $matches);

                $degrees = (float) $matches[1];
                $minutes = (float) $matches[2];
                $seconds = (float) $matches[3];
                $direction = $matches[4];

                // convert to decimal degrees
                $decimal_degrees = $degrees + ($minutes / 60) + ($seconds / 3600);

                // add negative sign for south and west directions
                if ($direction == "S" || $direction == "W") {
                    $decimal_degrees *= -1;
                }
                $decimal_degrees =number_format($decimal_degrees, 6);
                return $decimal_degrees;
            }
        ?>

        <div class="col-6 bg-light">
            <div id="print" class="">
                <h3 class="text-center mt-3">MONITORING STATIONS OF PUJADA BAY</h3>
                <table id="tableStation" class="table table-bordered border-dark ">
                    <thead>
                        <tr class="text-center" id="thRow">
                            <th>STA. NO.</th>
                            <th>STATION IDENTIFICATION</th>
                            <th colspan="2">GEOCOORDINATES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    if(isset($_GET['search']) || !empty($_GET['search'])){
                                        $sql = "SELECT * FROM station WHERE Station_No LIKE '%".$_GET['search']."%' || Station_Identification LIKE '%".$_GET['search']."%' || Latitude LIKE '%".$_GET['search']."%' || Longitude LIKE '%".$_GET['search']."%'";
                                    }else{
                                        $sql = "SELECT * FROM station";
                                    }

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {

                                    ?>
                        <tr id="tdRow">
                            <td class="text-center"><?php echo $row['Station_No']?></td>
                            <td><?php echo $row['Station_Identification']?></td>
                            <td><?php echo $row['Latitude'] ;?></td>
                            <td><?php echo $row['Longitude'] ;?> </td>
                            <?php
                                        }
                                    } else {
                                        echo "<td colspan='5' class='text-center fw-bold'>0 results</td>";
                                    }

                                        ?>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-6" id="map" style="height: 870px;">

        </div>
        
        <script>
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 11.5,
                    center: {lat: 6.873890, lng: 126.227305} // default center point
                });

                // Loop through the results and add markers to the map
                <?php
                // Query the database for the coordinates
                $sql = "SELECT * FROM station";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Convert DMS coordinates to decimal degrees
                        $lat_dms = $row["Latitude"];
                        $lng_dms = $row["Longitude"];
                        $data = 'Station ID: '.$row['Station_No'].'<br>Station Identification: '.$row['Station_Identification'].'<br>Coordinate: Lat - '.$row['Latitude']. ' and Long - '.$row['Longitude'] ;
                        $lat_deg = dms_to_degree($lat_dms);
                        $lng_deg = dms_to_degree($lng_dms);
                ?>
                (function() {
                    var marker = new google.maps.Marker({
                        position: {lat: <?php echo $lat_deg; ?>, lng: <?php echo $lng_deg; ?>},
                        map: map,
                        icon: 'template/admin/img/icon.png'
                    });

                    var infoWindow = new google.maps.InfoWindow({
                        content:  '<?php echo $data;?>',
                    });

                    google.maps.event.addListener(marker, 'mouseover', function() {
                       
                        infoWindow.open(map, marker);
                    });

                    google.maps.event.addListener(marker, 'mouseout', function() {
                     
                        infoWindow.close(); // Close the info window
                    });
                })();

               
                <?php
                    }
                } else {
                    echo "N/A";
                }
                ?>
            

                // Create a custom control for the legend
                var legendControlDiv = document.createElement('div');
                var legendControl = new LegendControl(legendControlDiv);
                map.controls[google.maps.ControlPosition.TOP_RIGHT].push(legendControlDiv);

                // Define the legend control
                function LegendControl(controlDiv) {
                    // Create the legend element
                    var legend = document.createElement('div');
                    legend.style.backgroundColor = 'white';
                    legend.style.margin = '2px';
                    legend.style.padding = '10px';
                    legend.style.fontFamily = 'Arial, sans-serif';

                    // Add the legend content
                    legend.innerHTML = '<h5>Legend</h5>' +
                        '<div><span style="width: 20px; height: 20px; display: inline-block;"><img src="template/admin/img/icon.png" width="20"></span> Station</div>';


                    // Append the legend to the control div
                    controlDiv.appendChild(legend);
                }
                // Create a custom control for the legend
                var legendControlDivLeft = document.createElement('div');
                var legendControlLeft = new LegendControlLeft(legendControlDivLeft);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(legendControlDivLeft);

                // Define the legend control
                function LegendControlLeft(controlDiv) {
                    // Create the legend element
                    var legendLeft = document.createElement('div');
                    legendLeft.style.backgroundColor = 'white';
                    legendLeft.style.margin = '2px';
                    legendLeft.style.padding = '10px';
                    legendLeft.style.fontFamily = 'Arial, sans-serif';

                    // Add the legend content
                    legendLeft.innerHTML = '<h5>Pujada Bay</h5>' +
                        '<div><span style="width: 20px; height: 20px;">Mati City, Davao Oriental</span></div>';


                    // Append the legend to the control div
                    controlDiv.appendChild(legendLeft);
                }

            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-Y7OV_eA9mGi1vJtnLWZaBTO6ptogD5w&callback=initMap" async defer></script>

    </div>
</div>