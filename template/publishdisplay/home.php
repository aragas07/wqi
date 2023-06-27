<script>
htall.include('layout/publish.html')
</script>
<div id="extend">
    <?php
        $access_key = 'f9a6a081-93af-4669-91b2-ec5bcd422afe';

        $opts = array(
        'http' => array(
            'method' => 'GET',
            'header' => 'X-Meteum-API-Key: ' . $access_key
        )
        );

        $context = stream_context_create($opts);

        // $file =file_get_contents('https://api.meteum.ai/v1/forecast?lat=6.953642&lon=126.221396', false, $context);
        $file = file_get_contents('./../../forecast.json');
        $decode = json_decode($file,false);
    ?>
    <style>
        .text-height-4{
            font-size: 17px;
            font-weight: 570;
            color: #555;
        }
    </style>
    <div class="col-12 text-center">
        <h1 style="font-weight:900" class="col"><?php echo $decode->geo_object->locality->name ?></h1>
        <div class="row m-auto col-3" style="display: flex; justify-content: center">
            <img style="height: 100px" src="./../../assets/img/<?php echo $decode->fact->condition?>.jpg" alt="" srcset="">
            <h2><?php echo $decode->fact->temp;?>º<h5>C</h5></h2>
            <div class="col" style="display: flex; align-items: center">
                <div>
                    <p class="text-height-4 m-0">Wind speed: <?php echo (float)$decode->fact->wind_speed*10 ;?>km/h</p>
                    <p class="text-height-4 m-0">humidity: <?php echo $decode->fact->humidity ;?>%</p>
                    <p class="text-height-4 m-0">Water temperature: <?php echo $decode->fact->temp_water ;?></p>
                </div>
            </div>
        </div>
    </div>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
            <li data-target="#myCarousel" data-slide-to="5"></li>
            <li data-target="#myCarousel" data-slide-to="6"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="template/admin/img/Selected/1.jpg">
            </div>
            <div class="item">
                <img src="template/admin/img/Selected/2.jpg">
            </div>
            <div class="item">
                <img src="template/admin/img/Selected/3.jpg">
            </div>
            <div class="item">
                <img src="template/admin/img/Selected/4.jpg">
            </div>
            <div class="item">
                <img src="template/admin/img/Selected/5.jpg">
            </div>
            <div class="item">
                <img src="template/admin/img/Selected/6.jpg">
            </div>
            <div class="item">
                <img src="template/admin/img/Selected/7.jpg">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div style="width: 75%; margin: auto; border-radius: 7px;" class="mt-4 mb-4 bg-white bg-opacity-50 p-4 rounded-4 shadow-lg">

        <h3 class="fw-bold">ABOUT</h3><br>
        The Mati, Davao Oriental, coastal areas' web-based water quality index visualization and forecasting system is a
        complete platform that offers in-the-moment monitoring, analysis, and forecasting of the area's water quality
        conditions.
        The system shows representations of several water quality metrics, including temperature, pH levels, and
        dissolved oxygen, salinity, and pollutant concentrations, using a user-friendly web interface. Researchers,
        environmental organizations, and local people may all easily understand the present water quality conditions in
        the coastal regions close to Mati thanks to these visualizations.

    </div>
</div>