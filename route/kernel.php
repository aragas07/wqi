<?php
    $url = explode("/",$_SERVER['REQUEST_URI']);
    $user = new UserController();
    $home = new HomeController();
    $station = new StationController();
    switch($url[2]){
        case "login": $user->login($_POST['email'],$_POST['password']); break;
        case "publishData": $home->publishData($_POST['year'],$_POST['station']); break;
        case "chartData": $home->chartData(); break;
        case "graphData": $home->graphData($_POST['parameter'],$_POST['station'],$_POST['year']); break;
        case "getGraphParams": $home->getGraphParams(); break;
        case "addingStationData": $station->addingStationData(); break;
        case "getStationData": $station->getStationData($_POST['id']); break;
        case "getStations": $station->getStations(); break;
        case "addStation": $station->addStation($_POST['station_no'],$_POST['station_id'],$_POST['class'],addslashes($_POST['laDegree'].'°'.$_POST['laMinute'].'’'.$_POST['laSecond'].'”'.$_POST['laDirection']),addslashes($_POST['loDegree'].'°'.$_POST['loMinute'].'’'.$_POST['loSecond'].'”'.$_POST['loDirection']),$_POST['region']); break;
        case "updateStation": $station->updateStation($_POST['id'],$_POST['station_no'],$_POST['station_id'],$_POST['class'],addslashes($_POST['laDegree'].'°'.$_POST['laMinute'].'’'.$_POST['laSecond'].'”'.$_POST['laDirection']),addslashes($_POST['loDegree'].'°'.$_POST['loMinute'].'’'.$_POST['loSecond'].'”'.$_POST['loDirection']),$_POST['region']); break;
        case "getParameter": $station->getParameter(); break;
        case "addingParameterData": $station->addingParameterData($_POST['id']); break;
        case "addParameter": $station->addParameter($_POST['parNo'],$_POST['parAcr'],$_POST['parId'],$_POST['parUnit']); break;
        case "updateParameter": $station->updateParameter($_POST['id'],$_POST['parAcr'],$_POST['parId'],$_POST['parUnit']); break;
        case "getWQG": $user->getWQG(); break;
        case "getNotes": $user->getNotes(); break;
        case "getPersonnel": $user->getPersonnel(); break;
        case "deletePersonnel": $user->deletePersonnel($_POST['id']); break;
        case "getPersonnelData": $user->getPersonnelData($_POST['id']); break;
        case "addPersonnel": $user->addPersonnel($_POST['accType'],$_POST['Id'],$_POST['username'],$_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['suffix'],$_POST['email'],$_POST['password']); break;
        case "updatePersonnel": $user->updatePersonnel($_POST['eid'],$_POST['accType'],$_POST['Id'],$_POST['username'],$_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['suffix'],$_POST['email'],$_POST['password']); break;
        case "getStation": $home->getStation(); break;
        case "getcy": $home->getcy(); break;
        case "getData": $home->getData($_POST['year'],$_POST['station']); break;
        case "updateData": $station->updateData($_POST['id'],$_POST['January'],$_POST['February'],$_POST['March'],$_POST['April'],$_POST['May'],$_POST['June'],$_POST['July'],$_POST['August'],$_POST['September'],$_POST['October'],$_POST['November'],$_POST['December'],$_POST['stationId'],$_POST['parameter'],$_POST['year'],$_POST['wqg']); break;
        case "getWQIdata": $station->wqidata($_POST['year']); break;
        case "publicwqidata": $station->wqidata($_POST['year']); break;
        
    }