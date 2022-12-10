<?php
error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "ganga@1998";
$dbname = "SUPERMARKET";

#echo "<h1>Test1</h1>";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

#echo "<h1>Test</h1>";
// define variables and set to empty values
$Cus_Id = $Mobile_No = $Name = $Area = $City = $Dues = $Emp_Id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Cus_Id = $_POST["Cus_Id"];
    $Mobile_No = $_POST["Mobile_No"];
  	$Name = $_POST["Name"];
    $Area = $_POST["Area"];
    $City = $_POST["City"];
    $Dues = $_POST["Dues"];
    $Emp_Id = $_POST["Emp_Id"];
    
}


$sql = "INSERT INTO CUSTOMER (CUS_ID, MOBILE_NO, NAME, AREA, CITY, DUES, EMP_ID)
VALUES ('$Cus_Id', '$Mobile_No', '$Name', '$Area', '$City', '$Dues', '$Emp_Id')";

#echo "<h1>$sql</h1>";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}