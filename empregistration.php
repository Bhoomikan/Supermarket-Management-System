<?php
error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "ganga@1998";
$dbname = "SUPERMARKET";

echo "<h1>Test1</h1>";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

#echo "<h1>Test</h1>";
// define variables and set to empty values
$Emp_Id = $Passwd = $FName = $LName = $Area = $City = $Phone_No = $Salary = $Adm_Id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Emp_Id = $_POST["Emp_Id"];
    $Passwd = $_POST["Passwd"];
    $FName = $_POST["FName"];
  	$LName = $_POST["LName"];
    $Area = $_POST["Area"];
    $City = $_POST["City"];
    $Phone_No = $_POST["Phone_No"];
    $Salary = $_POST["Salary"];
    $Adm_Id = $_POST["Adm_Id"];
    
}


$sql = "INSERT INTO EMPLOYEE (EMP_ID, FNAME, LNAME, PASSWD, AREA, CITY, PHN_NO, SALARY, ADM_ID)
VALUES ('$Emp_Id', '$FName', '$LName', '$Passwd', '$Area', '$City', '$Phone_No', '$Salary', '$Adm_Id')";

#echo "<h1>$sql</h1>";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}