<?php
class HomeController{
    private $conn;
    function __construct(){
        $c = new DBConnection();
        $this->conn = $c->conn();
    }

    public function publishData($year,$station){
        $src = "WHERE sub.CY = '$year' AND s.Station_No = '$station'";
        $sqlMR = "SELECT r.Region_Name,p.Parameter_Acronym, p.Unit,s.Station_No,s.Station_Identification, s.Class,sub.*,
        CASE WHEN sub.total = 0 and sub.divisor = 0 THEN '-' ELSE ROUND(sub.total/sub.divisor, 1)END as avgR
        FROM (
            SELECT *, 
                ( 
                    CASE WHEN January NOT LIKE '%-%' THEN January ELSE '0' END +
                    CASE WHEN February NOT LIKE '%-%' THEN February ELSE '0' END +
                    CASE WHEN March NOT LIKE '%-%' THEN March ELSE '0' END +
                    CASE WHEN April NOT LIKE '%-%' THEN April ELSE '0' END +
                    CASE WHEN May NOT LIKE '%-%' THEN May ELSE '0' END +
                    CASE WHEN June NOT LIKE '%-%' THEN June ELSE '0' END +
                    CASE WHEN July NOT LIKE '%-%' THEN July ELSE '0' END +
                    CASE WHEN August NOT LIKE '%-%' THEN August ELSE '0' END +
                    CASE WHEN September NOT LIKE '%-%' THEN September ELSE '0' END +
                    CASE WHEN October NOT LIKE '%-%' THEN October ELSE '0' END +
                    CASE WHEN November NOT LIKE '%-%' THEN November ELSE '0' END +
                    CASE WHEN December NOT LIKE '%-%' THEN December ELSE '0' END 
                ) AS total,
                  ( 
                    CASE WHEN January NOT LIKE '%-%' THEN 1 ELSE '0' END +
                    CASE WHEN February NOT LIKE '%-%' THEN 1 ELSE '0' END +
                    CASE WHEN March NOT LIKE '%-%' THEN 1 ELSE '0' END +
                    CASE WHEN April NOT LIKE '%-%' THEN 1 ELSE '0' END +
                    CASE WHEN May NOT LIKE '%-%' THEN 1 ELSE '0' END +
                    CASE WHEN June NOT LIKE '%-%' THEN 1 ELSE '0' END +
                    CASE WHEN July NOT LIKE '%-%' THEN 1 ELSE '0' END +
                    CASE WHEN August NOT LIKE '%-%' THEN 1 ELSE '0' END +
                    CASE WHEN September NOT LIKE '%-%' THEN 1 ELSE '0' END +
                    CASE WHEN October NOT LIKE '%-%' THEN 1 ELSE '0' END +
                    CASE WHEN November NOT LIKE '%-%' THEN 1 ELSE '0' END +
                    CASE WHEN December NOT LIKE '%-%' THEN 1 ELSE '0' END 
                ) AS divisor
            FROM monthly_report
        ) AS sub
          JOIN region as r
          JOIN parameter as p
          JOIN station as s
          ON s.Region_No = r.Region_No && sub.Parameter_No = p.Parameter_No && sub.Station_No = s.Station_No
            $src
         ORDER BY Parameter_Acronym ";
        $resMR = $this->conn->query($sqlMR);
        $data = "";
        if($resMR->num_rows >0){
            while($rowMR = $resMR->fetch_assoc()){
                $region = $rowMR['Region_Name'];

                $jan = 0;
                $feb = 0;
                $mar = 0;
                $apr = 0;
                $may = 0;
                $jun = 0;
                $jul = 0;
                $aug = 0;
                $sep = 0;
                $oct = 0;
                $nov = 0;
                $dec = 0;
                //check if not blank
                if($rowMR['January'] != "-"){
                    $jan =(double) $rowMR['January'];

                }
                if($rowMR['February']!= "-"){
                    $feb = (double)$rowMR['February'];

                }
                if($rowMR['March']!= "-"){
                    $mar =(double) $rowMR['March'];

                }
                if($rowMR['April']!= "-"){
                    $apr = (double)$rowMR['April'];

                }
                if($rowMR['May']!= "-"){
                    $may = (double)$rowMR['May'];

                }
                if($rowMR['June']!= "-"){
                    $jun = (double)$rowMR['June'];

                }
                if($rowMR['July']!= "-"){
                    $jul = (double)$rowMR['July'];

                }
                if($rowMR['August']!= "-"){
                    $aug =(double)$rowMR['August'];

                }
                if($rowMR['September']!= "-"){
                    $sep = (double)$rowMR['September'];

                }
                if($rowMR['October']!= "-"){
                    $oct =(double) $rowMR['October'];

                }
                if($rowMR['November']!= "-"){
                    $nov = (double)$rowMR['November'];

                }
                if($rowMR['December']!= "-"){
                    $dec =(double)$rowMR['December'];

                }

                $arr = array($jan , $feb , $mar , $apr , $may , $jun, $jul, $aug , $sep , $oct , $nov , $dec);
                $array = array_filter($arr, function($a) { return ($a !== 0); });
                $max = max($jan , $feb , $mar , $apr , $may , $jun, $jul, $aug , $sep , $oct , $nov , $dec);
                if(sizeof($array) == 0){
                    $min = "-";
                    $max = "-";
                }else{

                    $min = min($array);
                }
                
                $data .= "<tr>
                    <td>$region</td>
                    <td>".$rowMR['Parameter_Acronym']."</td>
                    <td>".$rowMR['Station_No']."</td>
                    <td>".$rowMR['Station_Identification']."</td>
                    <td>".$rowMR['January']."</td>
                    <td>".$rowMR['February']."</td>
                    <td>".$rowMR['March']."</td>
                    <td>".$rowMR['April']."</td>
                    <td>".$rowMR['May']."</td>
                    <td>".$rowMR['June']."</td>
                    <td>".$rowMR['July']."</td>
                    <td>".$rowMR['August']."</td>
                    <td>".$rowMR['September']."</td>
                    <td>".$rowMR['October']."</td>
                    <td>".$rowMR['November']."</td>
                    <td>".$rowMR['December']."</td>
                    <td>".$rowMR['avgR']."</td>
                    <td>".$min."</td>
                    <td>".$max."</td>
                    <td>".$rowMR['wqg']."</td>
                </tr>";
            }
        }
        echo json_encode(['data'=>$data]);
    }

    public function chartData(){
        $class = [];
        $count =[];

        $sqlStation = "SELECT Class, count(class) as count  FROM station Group By Class";
        $resultSta = $this->conn->query($sqlStation);
        if($resultSta->num_rows > 0){
            while($row = $resultSta->fetch_assoc()){
                $class[]  = $row['Class'];
                $count[] = $row['count'];
            }
        }
        echo json_encode(['class'=>$class,'count'=>$count]);
    }

    public function getGraphParams(){
        $sqlPar = "SELECT DISTINCT Parameter_No, Parameter_Acronym FROM parameter ";
        $resultPar = $this->conn->query($sqlPar);
        $params = "";
        $station = "";
        $year = "";
        while($row = $resultPar->fetch_assoc()){
            $params .= '<option value="' . $row['Parameter_No'] . '">' . $row['Parameter_Acronym'] . '</option>';
        }

        $sqlStation = "SELECT Station_No FROM station ORDER BY Station_No ASC";
        $resultStation = $this->conn->query($sqlStation);
        if($resultStation->num_rows > 0){
            while($row = $resultStation->fetch_assoc()){
                $station .= '<option>'.$row['Station_No'].'</option>';
            }
        }
        
        $sql = "SELECT DISTINCT CY FROM monthly_report ";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $year .= '<option>' . $row['CY'] . '</option>';
            }
        }
        echo json_encode(['params'=>$params, 'stations'=>$station, 'year'=>$year]);
    }

    public function graphData($parameter, $station, $year){
        $data = [];
        $sqlMR = "SELECT * FROM monthly_report WHERE Parameter_No = '$parameter' and Station_No = '$station' and CY = '$year'";
        $resultMR = $this->conn->query($sqlMR);
        
        while($row = $resultMR->fetch_assoc()){
            $data[] = str_replace('<','',$row['January']);
            $data[] = str_replace('<','',$row['February']);
            $data[] = str_replace('<','',$row['March']);
            $data[] = str_replace('<','',$row['April']);
            $data[] = str_replace('<','',$row['May']);
            $data[] = str_replace('<','',$row['June']);
            $data[] = str_replace('<','',$row['July']);
            $data[] = str_replace('<','',$row['August']);
            $data[] = str_replace('<','',$row['September']);
            $data[] = str_replace('<','',$row['October']);
            $data[] = str_replace('<','',$row['November']);
            $data[] = str_replace('<','',$row['December']);
        }
        echo json_encode(['data'=>$data,'parameter'=>$parameter,'station'=>$station,'year'=>$year]);
    }

    public function getStation(){
        $result = $this->conn->query("SELECT * FROM station");
        $option = "";
        while($row = $result->fetch_assoc()){
            $option .= '<option value="'.$row['Station_No'].'">'.$row['Station_No'].'</option>';
        }
        echo json_encode(['data'=>$option]);
    }

    public function getcy(){
        // $result = $this->conn->query("SELECT CY FROM monthly_report GROUP BY CY ORDER BY CY DESC");
        // $option = "";
        // while($row = $result->fetch_assoc()){
        //     $option .= '<option value="'.$row['CY'].'">'.$row['CY'].'</option>';
        // }
        $option = "";
        for($i = date("Y"); $i > 1989; $i--){
            $option .= '<option value="'.$i.'">'.$i.'</option>';
        }
        echo json_encode(['data'=>$option]);
    }

    public function getData($year,$station){
        $result = $this->conn->query("SELECT * FROM station AS s INNER JOIN monthly_report AS m INNER JOIN parameter AS p ON s.Station_No = m.Station_No AND m.Parameter_No = p.Parameter_No WHERE s.Station_No = '$station' AND CY = $year AND Parameter_Acronym != 'BOD'");
        $data = array();
        while($row = $result->fetch_assoc()){
            // $data[] = json_encode(['row'=>$row]);
            array_push($data,$row);
        }
        $getLoc = $this->conn->query("SELECT * FROM station WHERE Station_No = '$station'");
        $loc = $getLoc->fetch_assoc();
        
        echo json_encode(['data'=>$data, 'loc'=>$loc['Station_Identification']]);
    }

    public function forecasting(){
        $access_key = 'f9a6a081-93af-4669-91b2-ec5bcd422afe';

        $opts = array(
        'http' => array(
            'method' => 'GET',
            'header' => 'X-Meteum-API-Key: ' . $access_key
        )
        );

        $context = stream_context_create($opts);

        $file =file_get_contents('https://api.meteum.ai/v1/forecast?lat=52.37125&lon=4.89388', false, $context);
    }
}