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
$Prod_Id = $Prod_Name = $Prod_Type = $Prod_Qty = $Exp_Date = $Price = $Adm_Id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Prod_Id = $_POST["Prod_Id"];
    $Prod_Name = $_POST["Prod_Name"];
  	$Prod_Type = $_POST["Prod_Type"];
    $Prod_Qty = $_POST["Prod_Qty"];
    $Exp_Date = $_POST["Exp_Date"];
    $Price = $_POST["Price"];
    $Adm_Id = $_POST["Adm_Id"];
    
}


$sql = "INSERT INTO PRODUCT (PROD_ID, NAME, TYPE, QUANTITY, EXP_DATE, PRICE, ADM_ID)
VALUES ('$Prod_Id', '$Prod_Name', '$Prod_Type', '$Prod_Qty', '$Exp_Date', '$Price', '$Adm_Id')";

#echo "<h1>$sql</h1>";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}