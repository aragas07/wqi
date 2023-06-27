<?php
class UserController{
    private $conn;
    function __construct(){
        $c = new DBConnection();
        $this->conn = $c->conn();
    }

    public function login($email,$password){
        $result = $this->conn->query("SELECT * FROM user WHERE binary Email = '$email' AND Password = '$password'");
        $success = false;
        $data = "";
        if(mysqli_num_rows($result) == 1){
            while($res = $result->fetch_assoc()){
                $_SESSION['Email'] = $res['Email'];
                $data = $res;
            }
            $success = true;
        }
        echo json_encode(['success'=>$success, 'auth'=>$data]);
    }

    public function getWQG(){
        
        $sql = "SELECT *
        FROM water_body_classification as wbc
        JOIN parameter as p
        ON wbc.Parameter_No = p.Parameter_No
        ORDER by p.Parameter_Acronym";
        $result = $this->conn->query($sql);
        $tbody = "";
        while($row = $result->fetch_assoc()){
            $tbody .= "<tr>
                <td>".$row['Parameter']."</td>
                <td>".$row['Unit']."</td>
                <td>".$row['SA']."</td>
                <td>".$row['SB']."</td>
                <td>".$row['SC']."</td>
                <td>".$row['SD']."</td>
                <td class='text-center hdn'><i class='fas fa-edit' id='".$row['idwater_body_classification']."'></i></td>
            </tr>";
        }
        echo json_encode(['tbody'=>$tbody]);
    }

    public function getNotes(){
        $notes="";
        $sql = "SELECT * FROM notes";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $notes .= '<li> '.$row['notes'].'</li>';
            }
        }
        echo json_encode(['notes'=>$notes]);
    }

    public function getPersonnel(){
        $result = $this->conn->query("SELECT * FROM user");
        $tbody = "";
        while($row = $result->fetch_assoc()) {
            if($row['User_ID'] == '0000-0000'){
                continue;
            }
            $tbody .= "<tr>
                <td>".$row['User_ID']."</td>
                <td>".$row['Account_Type']."</td>
                <td>".$row['Username']."</td>
                <td>".$row['Firstname']."</td>
                <td>".$row['Lastname']."</td>
                <td>".$row['Middlename']."</td>
                <td>".$row['Suffix']."</td>
                <td>".$row['Email']."</td>
                <td class='text-center'>
                    <i class='fas fa-edit mr-2' value='".$row['No_User']."'></i>
                    <i class='fas fa-trash' value='".$row['User_ID']."'></i>
                </td>
            </tr>";
        }
        echo json_encode(['tbody'=>$tbody]);
    }

    public function deletePersonnel($id){
        $sql = "DELETE FROM user WHERE No_User = '$id'";
        $success = 'error';
        $title = "Sorry we have a problem about database connection";
        if ($this->conn->query($sql) === TRUE) {
            $title = "Parameter updated successfully";
            $success = "success";
        }
        echo json_encode(['icon'=>$success,'title'=>$title]);
    }

    public function getPersonnelData($id){
        $sql = "SELECT * FROM user WHERE No_User Like '$id'";
        $result = $this->conn->query($sql);
        $accountType = "";
        $userId = "";
        $username = "";
        $firstname = "";
        $middlename = "";
        $lastname = "";
        $suffix = "";
        $email = "";
        $password = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $accountType = $row['Account_Type'];
                $userId = $row['User_ID'];
                $username = $row['Username'];
                $firstname = $row['Firstname'];
                $middlename = $row['Middlename'];
                $lastname = $row['Lastname'];
                $suffix = $row['Suffix'];
                $email = $row['Email'];
                $password = $row['Password'];
            }
        }
        echo json_encode([
            'accountType'=>$accountType,
            'userId'=>$userId,
            'username'=>$username,
            'firstname'=>$firstname,
            'middlename'=>$middlename,
            'lastname'=>$lastname,
            'suffix'=>$suffix,
            'email'=>$email,
            'password'=>$password
        ]);
    }

    public function updatePersonnel($noId,$accType,$accID,$accUsername,$accFname,$accMname,$accLname,$accSuffix,$accEmail,$accPassword){
        if(empty($accMname)){
            $accMname = "N/A";
        }
        if(empty($accSuffix)){
            $accSuffix = "N/A";
        }
        $sql = "UPDATE user SET User_ID = '$accID', Username = '$accUsername', Firstname = '$accFname', Lastname = '$accLname', Middlename = '$accMname', Suffix = '$accSuffix', Email = '$accEmail', Password = '$accPassword',  Account_Type = '$accType' WHERE No_User = '$noId'";

        $success = 'error';
        $title = "Sorry we have a problem about database connection";
        if ($this->conn->query($sql) === TRUE) {
            $title = "Account updated successfully";
            $success = "success";
        }
        echo json_encode(['icon'=>$success,'title'=>$title]);
    }
    public function addPersonnel($accType,$accID,$accUsername,$accFname,$accMname,$accLname,$accSuffix,$accEmail,$accPassword){
        if(empty($accMname)){
            $accMname = "N/A";
        }
        if(empty($accSuffix)){
            $accSuffix = "N/A";
        }
        $sql = "INSERT INTO user (User_ID, Username, Firstname, Lastname, Middlename, Suffix, Email, Password, Account_Type)
            VALUES ('$accID', '$accUsername', '$accFname','$accLname','$accMname','$accSuffix','$accEmail','$accPassword', '$accType')";
        $success = 'error';
        $title = "Sorry we have a problem about database connection";
        if ($this->conn->query($sql) === TRUE) {
            $title = "New account created successfully";
            $success = "success";
        }
        echo json_encode(['icon'=>$success,'title'=>$title]);
    }
}