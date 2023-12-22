<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="Employee";

try{
    $con = new PDO("mysql:host=$servername; dbname=$dbname",$username,$password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT employee_id, full_name, email_id FROM employee_info WHERE employee_id = 10032 ";  
    $stmt = $con->prepare($sql);

    $stmt->execute();
    
    $employeeData = array();


    while ($row1 = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $employeeData[] = array(
            'id' => $row1['employee_id'],
            'name' => $row1['full_name'],
            'email' => $row1['email_id']
           
        );
        //echo var_dump($employeeData);
    }
    
    include("EmpInfoTable.php"); 
     
}catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$con = null;
?>