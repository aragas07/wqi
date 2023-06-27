<?php
class StationController{
    private $conn;
    function __construct(){
        $c = new DBConnection();
        $this->conn = $c->conn();
    }

    public function getStations(){
        $sql = "SELECT * FROM station";
        $result = $this->conn->query($sql);
        $tbody = "";
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $tbody .= "<tr>
                    <td>".$row['Station_No']."</td>
                    <td>".$row['Station_Identification']."</td>
                    <td><div class='row col-12'><div class='col-6 text-center'>".$row['Latitude']."</div>
                    <div class='col-6 text-center'>".$row['Longitude']."</div></div></td>
                    <td class='text-center'><i class='fas fa-edit' id='".$row['Station_No']."'></i></td>
                </tr>";
            }
        }
        echo json_encode(['tbody'=>$tbody]);
    }
    
    public function addingStationData(){
        $sqlR = "SELECT * FROM region";
        $resultR = $this->conn->query($sqlR);
        $region = "<option>Select..</option>";
        while($row = $resultR->fetch_assoc()){
            $region .= "<option value='".$row['Region_No']."'>".$row['Region_Name']."</option>";
        }
        $sqlClass = "SELECT * FROM class";
        $resultClass = $this->conn->query($sqlClass);
        $classType = "";
        while($row = $resultClass->fetch_assoc()){
            $classType .= "<option>".$row['Class']."</option>";
        }
        echo json_encode(['region'=>$region,'class'=>$classType]);
    }

    public function addStation($station_no,$station_id,$station_class,$latitude,$longitude,$region){
        $sql = "INSERT INTO station (Region_No,Station_No, Station_Identification, Latitude, Longitude, Class)
                VALUES ('$region','$station_no', '$station_id', '$latitude','$longitude', '$station_class')";
        $success = 'error';
        $title = "Sorry we have a problem about database connection";
        if ($this->conn->query($sql) === TRUE) {
            $title = "New record created successfully";
            $success = "success";
        }
        echo json_encode(['icon'=>$success,'title'=>$title]);
    }

    public function getStationData($id){
        $sql = "SELECT * FROM station WHERE Station_No Like '$id' ";
        $result = $this->conn->query($sql);
        $region = "";
        $degrees_pos = "";
        $degrees = "";
        $minutes_pos = "";
        $minutes = "";
        $seconds_pos = "";
        $seconds = "";
        $direction = "";
        $degrees_posLo = "";
        $degreesLo = "";
        $minutes_posLo = "";
        $minutesLo = "";
        $seconds_posLo = "";
        $secondsLo = "";
        $directionLo = "";
        $class = "";
        $station = "";
        $stationId = "";
        while($row = $result->fetch_assoc()){
            $region = $row['Region_No'];
            $latitude =  $row['Latitude'];
            $longtitude = $row['Longitude'];
            $degrees_pos = strpos($latitude, "°");
            $station = $row['Station_No'];
            $degrees = substr($latitude, 0, $degrees_pos);
            $minutes_pos = strpos($latitude, "’");
            $minutes = substr($latitude, $degrees_pos + 2, $minutes_pos - $degrees_pos - 2);
            $seconds_pos = strpos($latitude, "”");
            $seconds = substr($latitude, $minutes_pos + 3, $seconds_pos - $minutes_pos - 3);
            $direction = substr($latitude, -1);
            $degrees_posLo = strpos($longtitude, "°");
            $degreesLo = substr($longtitude, 0, $degrees_posLo);
            $minutes_posLo = strpos($longtitude, "’");
            $minutesLo = substr($longtitude, $degrees_posLo + 2, $minutes_posLo - $degrees_posLo - 2);
            $seconds_posLo = strpos($longtitude, "”");
            $secondsLo = substr($longtitude, $minutes_posLo + 3, $seconds_posLo - $minutes_posLo - 3);
            $directionLo = substr($longtitude, -1);
            $class = $row['Class'];
            $stationId = $row['Station_Identification'];
        }
        echo json_encode([
            'region'=>$region,
            'degrees_pos'=>$degrees_pos,
            'degrees'=>$degrees,
            'minutes_pos'=>$minutes_pos,
            'minutes'=>$minutes,
            'seconds_pos'=>$seconds_pos,
            'seconds'=>$seconds,
            'direction'=>$direction,
            'degrees_posLo'=>$degrees_posLo,
            'degreesLo'=>$degreesLo,
            'minutes_posLo'=>$minutes_posLo,
            'minutesLo'=>$minutesLo,
            'seconds_posLo'=>$seconds_posLo,
            'secondsLo'=>$secondsLo,
            'directionLo'=>$directionLo,
            'station'=>$station,
            'class'=>$class,
            'stationId'=>$stationId
        ]);
    }

    public function updateStation($id,$station_no,$station_id,$station_class,$latitude,$longitude,$region){
        $sql = "UPDATE station SET Station_Identification = '$station_id', Latitude = '$latitude', Longitude = '$longitude', Class = '$station_class'
        WHERE Station_No = '$id' ";
        $success = 'error';
        $title = "Sorry we have a problem about database connection";
        if ($this->conn->query($sql) === TRUE) {
            $title = "Station Updated successfully";
            $success = "success";
        }
        echo json_encode(['icon'=>$success,'title'=>$title]);
    }

    public function getParameter(){
        $sql = "SELECT * FROM parameter";
        $result = $this->conn->query($sql);
        $tbody = "";
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $tbody .= "<tr>
                    <td>".$row['Parameter_No']."</td>
                    <td>".$row['Parameter_Acronym']."</td>
                    <td>".$row['Parameter']."</td>
                    <td>".$row['Unit']."</td>
                    <td class='text-center'><i class='fas fa-edit' id='".$row['Parameter_No']."'></i></td>
                </tr>";
            }
        }
        echo json_encode(['tbody'=>$tbody]);

    }

    public function addingParameterData($id){
        $sql = "SELECT * FROM parameter WHERE Parameter_No Like '$id' ";
        $result = $this->conn->query($sql);
        $paramNo = "";
        $paramAcro = "";
        $param = "";
        $unit = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $paramNo = $row['Parameter_No'];
                $paramAcro = $row['Parameter_Acronym'];
                $param = $row['Parameter'];
                $unit = $row['Unit'];
            }
        }
        echo json_encode(['paramNo'=>$paramNo,'paramAcro'=>$paramAcro,'param'=>$param,'unit'=>$unit]);
    }

    public function addParameter($parNo,$parAcr,$par,$unit){
        $sql = "INSERT INTO parameter (Parameter_No, Parameter_Acronym, Parameter, Unit)
                VALUES ('$parNo', '$parAcr', '$par','$unit')";
        $success = 'error';
        $title = "Sorry we have a problem about database connection";
        if ($this->conn->query($sql) === TRUE) {
            $title = "New record created successfully";
            $success = "success";
        }
        echo json_encode(['icon'=>$success,'title'=>$title]);
    }

    public function updateParameter($parNo,$parAcr,$par,$unit){
        $sql = "UPDATE parameter SET Parameter_Acronym = '$parAcr', Parameter = '$par', Unit ='$unit'
        WHERE Parameter_No Like '$parNo'  ";
        $success = 'error';
        $title = "Sorry we have a problem about database connection";
        if ($this->conn->query($sql) === TRUE) {
            $title = "Parameter updated successfully";
            $success = "success";
        }
        echo json_encode(['icon'=>$success,'title'=>$title]);
    }

    public function updateData($id,$january,$february,$march,$april,$may,$june,$july,$august,$september,$october,$november,$december,$stationId,$parameter,$year,$wqg){
        $icon = 'error';
        $title = 'Sorry we have a problem about updating the data';
        $getYear = $this->conn->query("SELECT * FROM monthly_report WHERE Station_No = '$stationId' AND CY = $year");
        if($id == '' || mysqli_num_rows($getYear) == 0){
            $icon = 'success';
            $title = 'The data has been successfully updated';
            $result = $this->conn->query("SELECT * FROM parameter WHERE Parameter_Acronym = '$parameter'");
            while($res = $result->fetch_assoc()){
                $paramid = $res['Parameter_No'];
                $this->conn->query("INSERT INTO monthly_report (January,February,March,April,May,June,July,August,September,October,November,December,Parameter_No,CY,Station_No,wqg)
                VALUES('$january','$february','$march','$april','$may','$june','$july','$august','$september','$october','$november','$december','$paramid',$year,'$stationId','$wqg')");
            }
        }else{
            $icon = 'success';
            $title = 'The data has been successfully updated';
            $this->conn->query("UPDATE monthly_report SET January = '$january', February = '$february', March = '$march', April = '$april', May = '$may', June = '$june', July = '$july',
            August = '$august', September = '$september', October = '$october', November = '$november', December = '$december', wqg = '$wqg' WHERE idmonthly_report = $id");
        }
        echo json_encode(['icon'=>$icon,'title'=>$title,'numrows'=>mysqli_num_rows($getYear),'id'=>$id, 'idlength'=>strlen($id)]);
    }

    public function wqidata($year){
        $result = $this->conn->query("SELECT * FROM station");
        $tbody = "";
        while($row = $result->fetch_assoc()){
            $tbody .= "<tr>
                <td>".$row['Station_Identification']."</td>
                <td>".$this->getWQI($year,$row['Station_No'],"January")."</td>
                <td>".$this->getWQI($year,$row['Station_No'],"February")."</td>
                <td>".$this->getWQI($year,$row['Station_No'],"March")."</td>
                <td>".$this->getWQI($year,$row['Station_No'],"April")."</td>
                <td>".$this->getWQI($year,$row['Station_No'],"May")."</td>
                <td>".$this->getWQI($year,$row['Station_No'],"June")."</td>
                <td>".$this->getWQI($year,$row['Station_No'],"July")."</td>
                <td>".$this->getWQI($year,$row['Station_No'],"August")."</td>
                <td>".$this->getWQI($year,$row['Station_No'],"September")."</td>
                <td>".$this->getWQI($year,$row['Station_No'],"October")."</td>
                <td>".$this->getWQI($year,$row['Station_No'],"November")."</td>
                <td>".$this->getWQI($year,$row['Station_No'],"December")."</td>
            </tr>";
        }
        echo json_encode(['tbody'=>$tbody]);
    }

    public function getWQI($srcYear, $srcStation,$srcMonth){
        $result = $this->conn->query("SELECT mr.Parameter_No as P_No,p.Parameter_Acronym as Parameter, mr.$srcMonth as month, mr.Station_No as Station, s.Class as Class FROM monthly_report as mr JOIN parameter as p JOIN station as s On mr.Parameter_No = p.Parameter_No and s.Station_No = mr.Station_No WHERE CY = '$srcYear' AND mr.Station_No ='$srcStation'");
        
        $par = [];
        $Vn = [];
        $month = [];
        if($result ->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $class = $row['Class'];
                $p_No = $row['P_No'];
                
                $sqlVn = "SELECT $class as Value FROM water_body_classification WHERE Parameter_No = '$p_No'";
                $resultVN = $this->conn->query($sqlVn);
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
                $Qn[] = round(((float)$An[$index] - (float)$Vo[$index]) / ((float)$value - (float)$Vo[$index]),9);
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
        }else{
            return "-";
        }
    }
}