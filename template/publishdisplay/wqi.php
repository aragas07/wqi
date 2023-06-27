<script>
htall.include('layout/publish.html')
</script>
<div id="extend">
    <?php
            include '../admin/conn/conn.php';
            session_start();
            
            $_SESSION['quarter'] = "1";
            $_SESSION['year'] = date('Y');
            if(isset($_POST['year']) || isset($_POST['quarter'])){
                $year = $_POST['year'];
                $quarter = $_POST['quarter'];
                $_SESSION['year'] = $year;
                $_SESSION['quarter'] = $quarter;
            
            
            }else{
                $year = '';
                $quarter = '';
            }
        ?>
    <div class="col-md-12 m-0 p-0 bg-light bg-opacity-50 rounded shadow-lg overflow-auto">
        <div class="border col-md-4 shadow-lg p-2 text-dark">
            Water Quality Classification Scale:<br>0-25 ........ Excellent<br>26-50 ........ Good<br>51-75 ........
            Bad<br>76-100 ........ Very Bad<br>100 & above ........ Unfit<br>
        </div>
        <div class="p-2">
            <table id="employeeTable" class="table table-hover border-dark table-bordered">
                <thead>
                    <tr>
                        <th colspan="15" class="text-center">WATER QUALITY INDEX</th>
                    </tr>
                    <tr>
                        <th colspan="15" class="text-center">
                            <form method="post">
                                <div class="row g-3 col-md-12 d-flex justify-content-center">
                                    <div class="col-md-auto mb-2">

                                        <select type="text" name="quarter" class="form-select" id="validationRegion"
                                            onchange="this.form.submit()" required>
                                            <?php

                                                        for ($x = 1; $x <= 4; $x++) {

                                                            if($x == $_SESSION['quarter']){
                                                                echo "<option selected>$x</option>";    
                                                            }else{
                                                                echo "<option>$x</option>";
                                                            }
                                                        }
                                                        ?>



                                        </select>
                                    </div>

                                    <div class="col-md-auto mb-2">
                                        <span> Quarter CY </span>
                                    </div>
                                    <div class="col-md-auto mb-2">

                                        <select type="text" name="year" onchange="this.form.submit()"
                                            class="form-select" id="validationRegion" required>

                                            <?php
                                                        $CY = date('Y');
                                                        for ($x = 1; $x <= $CY; $CY--) {

                                                            if($CY == $_SESSION['year']){
                                                                echo "<option selected>$CY</option>";    
                                                            }else{
                                                                echo "<option>$CY</option>";
                                                            }
                                                        }
                                                        ?>

                                        </select>
                                    </div>
                                </div>
                            </form>
                        </th>
                    </tr>
                    <tr>
                        <th class="align-middle ">Region</th>
                        <th class="align-middle">Stn. No.</th>
                        <th class="align-middle">Sta. ID</th>
                        <th class="align-middle">Jan</th>
                        <th class="align-middle">Feb</th>
                        <th class="align-middle">Mar</th>
                        <th class="align-middle">Apr</th>
                        <th class="align-middle">May</th>
                        <th class="align-middle">Jun</th>
                        <th class="align-middle">Jul</th>
                        <th class="align-middle">Aug</th>
                        <th class="align-middle">Sep</th>
                        <th class="align-middle">Oct</th>
                        <th class="align-middle">Nov</th>
                        <th class="align-middle">Dec</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                                $sql = "SELECT * FROM
                            station as s
                            JOIN region as r
                            On  s.Region_No = r.Region_No

                            ";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){


                                ?>
                    <tr>
                        <td style="text-align: center; vertical-align: middle"><?php echo $row['Region_Name']?></td>
                        <td style="text-align: center; vertical-align: middle"><?php echo $row['Station_No'];?></td>
                        <td><?php echo $row['Station_Identification'];?></td>
                        <td><?php echo getWQI("January",$_SESSION['year'],$_SESSION['quarter'],$row['Station_No']);?>
                        </td>
                        <td><?php echo getWQI("February", $_SESSION['year'], $_SESSION['quarter'], $row['Station_No']); ?>
                        </td>
                        <td><?php echo getWQI("March", $_SESSION['year'], $_SESSION['quarter'], $row['Station_No']); ?>
                        </td>
                        <td><?php echo getWQI("April", $_SESSION['year'], $_SESSION['quarter'], $row['Station_No']); ?>
                        </td>
                        <td><?php echo getWQI("May", $_SESSION['year'], $_SESSION['quarter'], $row['Station_No']); ?>
                        </td>
                        <td><?php echo getWQI("June", $_SESSION['year'], $_SESSION['quarter'], $row['Station_No']); ?>
                        </td>
                        <td><?php echo getWQI("July", $_SESSION['year'], $_SESSION['quarter'], $row['Station_No']); ?>
                        </td>
                        <td><?php echo getWQI("August", $_SESSION['year'], $_SESSION['quarter'], $row['Station_No']); ?>
                        </td>
                        <td><?php echo getWQI("September", $_SESSION['year'], $_SESSION['quarter'], $row['Station_No']); ?>
                        </td>
                        <td><?php echo getWQI("October", $_SESSION['year'], $_SESSION['quarter'], $row['Station_No']); ?>
                        </td>
                        <td><?php echo getWQI("November", $_SESSION['year'], $_SESSION['quarter'], $row['Station_No']); ?>
                        </td>
                        <td><?php echo getWQI("December", $_SESSION['year'], $_SESSION['quarter'], $row['Station_No']); ?>
                        </td>



                    </tr>
                    <?php
                                    }
                                }

                                ?>
                </tbody>
            </table>
        </div>


        <?php



                    function getWQI($srcMonth, $srcYear, $srcQuart, $srcStation){
                        global $conn;
                        $par = [];
                        $Vn = [];
                        $month = [];
                        $sql = "SELECT mr.Parameter_No as P_No,p.Parameter_Acronym as Parameter, mr.$srcMonth as month, mr.Station_No as Station, s.Class as Class FROM 
                            monthly_report as mr
                            JOIN parameter as p
                            JOIN station as s
                            On mr.Parameter_No = p.Parameter_No and s.Station_No = mr.Station_No
                            WHERE mr.Station_No ='$srcStation' and CY = '$srcYear' and Quarter = '$srcQuart'";
                        $result = $conn->query($sql);
                        if($result ->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                $class = $row['Class'];
                                $p_No = $row['P_No'];

                                $sqlVn = "SELECT $class as Value FROM water_body_classification WHERE Parameter_No = '$p_No'";
                                $resultVN = $conn->query($sqlVn);
                                $rowVn = $resultVN->fetch_assoc();
                                if($row['month'] == "-" || $rowVn['Value'] == 'n/a'){
                                    continue;
                                }else{

                                    $par[] = $row['Parameter'];
                                    $month[] = str_replace("<","",$row['month']);


                                    $cVn = explode("-",$rowVn['Value']);

                                    if(count($cVn) === 2){
                                        $start = floatval(trim($cVn[0]));
                                        $end = floatval(trim($cVn[1])); 

                                        $middle = ($start + $end) / 2; 
                                        $Vn[] = $middle;
                                    }else{

                                        $Vn[] = str_replace("<","",$rowVn['Value']);
                                    }
                                }



                            }
                        }

                        if(!empty($Vn) && !empty($par) && !empty($month)){
                            $monthVerify = array_sum($month);


                            // Step 1: Calculate step1 = 1/Vn
                            $step1 = array_map(function ($value) {
                                return round(1 / $value, 9);
                            }, $Vn);

                            // Step 2: Calculate sum = sum(1/Vn)
                            $sum = round(array_sum($step1),7);

                            // Step 3: Calculate k = 1/sum
                            $k = round(1 / $sum,9);


                            // Step 4: Calculate (Relative/Unit Weight)Wn = k/Vn
                            $Wn = array_map(function ($value) use ($k) {
                                return round($k / $value, 9);
                            }, $Vn);

                            // Step 5: Calculate ideal Value(Vo)
                            $parameter = 'some_parameter'; // Replace with the actual parameter value
                            $Vo = [];
                            foreach ($par as $parameter) {
                                if ($parameter == 'DO') {
                                    $Vo[] = 14;
                                } elseif ($parameter == 'pH') {
                                    $Vo[] = 7;
                                } else {
                                    $Vo[] = 0;
                                }
                            }

                            // Step 6: Get observed values (An)
                            $An = $month;

                            // Step 7: Calculate Quality rating or Qn
                            $Qn = [];
                            foreach ($Vn as $index => $value) {
                                $Qn[] = round(($An[$index] - $Vo[$index]) / ($value - $Vo[$index]),9);
                            }

                            // Step 8: Calculate Qn = Quality rating or Qn * 100
                            $Qn = array_map(function ($value) {
                                return $value * 100;
                            }, $Qn);

                            // Step 9: Calculate WnQn = Qn * (Relative/Unit Weight)Wn
                            $WnQn = [];
                            foreach ($Qn as $index => $value) {
                                $WnQn[] = round($value * $Wn[$index],9);
                            }
                            $WQI = round(array_sum($WnQn),4);
                            // Output the results
                            $message = "";
                            $classified = "-";
                            if($WQI >= 0 && $WQI < 25){
                                $classified = $WQI.' - Excellent';
                            }elseif($WQI > 25 && $WQI <= 50){
                                $classified = $WQI.' - Good';
                            }elseif($WQI > 50 && $WQI <= 75){
                                $message = 'For the month of '.$srcMonth.' on '.$srcYear.', with a Water Quality Index (WQI) value of '. $WQI .', according to the provided scale, the water quality would be classified as "Bad".';
                            }elseif($WQI > 75 && $WQI <= 100){
                                $message = 'For the month of '.$srcMonth.' on '.$srcYear.', with a Water Quality Index (WQI) value of '. $WQI .',  according to the provided scale, the water quality would be classified as "Very Bad".';
                            }elseif($WQI > 100){
                                $classified = $WQI.' - Unfit';
                            }
                            return $classified;
                            //
                            //                            echo '<div class="col-12">
                            //                                <div class="col-12 text-center "><h1 class="fw-light fw-semibold">WQI</h1><hr></div><div class="col-12 row row-2"><div class="col-md-7">';
                            //                                                                echo "1/Vn: " . implode(", ", $step1) . "<br>";
                            //                                                                echo "sum: " . $sum . "<br>";
                            //                                                                echo "k: " . $k . "<br>";
                            //                                                                echo "Wn: " . implode(", ", $Wn) . "<br>";
                            //                                                                echo "Vo: " . implode(", ", $Vo) . "<br>";
                            //                                                                echo "An: " . implode(", ", $An) . "<br>";
                            //                                                                echo "Qn: " . implode(", ", $Qn) . "<br>";
                            //                                                                echo "WnQn: " . implode(", ", $WnQn) . "<br>";
                            //                            echo "WQI: " . $WQI ."<br>". $message ."<br></div><div class='col-md-5 border-start'>Water Quality Classification Scale:<br>0-25 ........ Excellent<br>26-50 ........ Good<br>51-75 ........ Bad<br>76-100 ........ Very Bad<br>100 & above ........ Unfit<br></div></div>";

                        }else{
                            return "-";
                        }
                    }

                    ?>




    </div>
</div>