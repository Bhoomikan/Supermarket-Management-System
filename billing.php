<?php
error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "ganga@1998";
$dbname = "SUPERMARKET";
#echo "<h1>test1</h1>";
$q = intval($_GET['q']);
$Mobile_No = intval($_GET['Mobile_No']);
$Bal = intval($_GET['Bal']);
$x = intval($_GET['x']);
$Amt = intval($_GET['Amt']);
//$y = intval($_GET['y']);
//$S = intval($_GET['S']);
//$B = intval($_GET['B']);
//$BN = intval($_GET['BN']);
$Prod_Id = intval($_GET['Prod_Id']);
$CusId = intval($_GET['CusId']);
$Qnty = intval($_GET['Qnty']);
$c = intval($_GET['c']);
$ProdStr = $_GET['ProdStr'];
//$PID = intval($_GET['PId']);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
#echo "<h2>test2</h2>";
if($q) {
    $sql = "SELECT NAME, PRICE FROM PRODUCT WHERE PROD_ID='".$q."'";
    #echo "test3".$sql."<br>";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            #echo "Prod_id: " . $row["PROD_ID"]. " - Name: " . $row["NAME"]. " Price:" . $row["PRICE"]. "<br>";
            $Name = $row["NAME"];
            $Price = $row["PRICE"];
            $ar = array($Name,$Price);
            echo json_encode($ar);
            #echo " ".$ar."<br>";
            #echo $Name;
            #echo $ar[0];
        }
    } else {
        echo "0 results";
    }
}
else if($Mobile_No){
    //$GLOBALS['x'] = $Cus_Id;
    $getdue = "SELECT DUES FROM CUSTOMER WHERE MOBILE_NO='".$Mobile_No."'";
    $result1 = mysqli_query($conn, $getdue);
    if (mysqli_num_rows($result1) > 0) {
        global $Due;
        while($row = mysqli_fetch_assoc($result1)) {
            $Due = $row["DUES"];
            //echo json_encode($Due);
        }
        $gtCusId = "SELECT CUS_ID FROM CUSTOMER WHERE MOBILE_NO='".$Mobile_No."'";
        $result4 = mysqli_query($conn, $gtCusId);
        if (mysqli_num_rows($result4) > 0) {
            while($row = mysqli_fetch_assoc($result4)) {
                $Cus_Id = $row["CUS_ID"];
            }
        }

        $arr = array($Due,$Cus_Id);
        echo json_encode($arr);
    } else {
       // echo "0 results";
        //echo json_encode(file_get_contents('addcustomer.html'));
        //header('Location: addcustomer.html');
       // exit;
        //echo json_encode("<script type='text/javascript'>window.location.href = 'addcustomer.html';</script>");
        //exit();
        echo json_encode("Create Account");
    }

    /*$bill_no = "SELECT * FROM BILL ORDER BY BILL_NO DESC LIMIT 1";
    $result3 = mysqli_query($conn, $bill_no);
    //echo json_encode($result3);

    if (mysqli_num_rows($result3) > 0) {
        global $BillNo;
        while($row = mysqli_fetch_assoc($result3)) {
            $BillNo = $row["BILL_NO"];
           // echo json_encode($BillNo);
        }
    } else {
        echo "0 results";
    }*/

    /*$gtCusId = "SELECT CUS_ID FROM CUSTOMER WHERE MOBILE_NO='".$Mobile_No."'";
    $result4 = mysqli_query($conn, $gtCusId);
    if (mysqli_num_rows($result4) > 0) {
        while($row = mysqli_fetch_assoc($result4)) {
            $Cus_Id = $row["CUS_ID"];
        }
    }

    $arr = array($Due,$Cus_Id);
    echo json_encode($arr);*/

}

else if($Bal && $x){
    $rembal = "UPDATE CUSTOMER SET DUES ='".$Bal."' WHERE MOBILE_NO='".$x."'";
    if(mysqli_query($conn, $rembal)) {
        echo json_encode("New Dues updated successfully!!");
    } else {
        echo json_encode("Error updating record: " . mysqli_error($conn));
    }
}

else if($Amt && $CusId && $ProdStr){
    /*$getCusId = "SELECT CUS_ID FROM CUSTOMER WHERE MOBILE_NO='".$y."'";
    $result2 = mysqli_query($conn, $getCusId);
    if (mysqli_num_rows($result2) > 0) {
        while($row = mysqli_fetch_assoc($result2)) {
            $cus_id = $row["CUS_ID"];
        }
    }*/
    $bill_date = date('Y-m-d');
    $bill = "INSERT INTO BILL (AMT, CUS_ID, BILL_DATE) VALUES('$Amt','$CusId','$bill_date')";

    mysqli_query($conn,$bill);

    /*if(mysqli_query($conn,$bill)){
        echo json_encode("Bill successfully stored in bill table");
    } else {
        echo json_encode("Error: " . $bill . "<br>" . mysqli_error($conn));
    }*/

//    $bill_no = "SELECT MAX(BILL_NO) FROM BILL";
    $bill_no = "SELECT * FROM BILL ORDER BY BILL_NO DESC LIMIT 1";
    $result3 = mysqli_query($conn, $bill_no);
    //echo json_encode($result3);

    if (mysqli_num_rows($result3) > 0) {
        while($row = mysqli_fetch_assoc($result3)) {
            $BillNo = $row["BILL_NO"];
            echo json_encode($BillNo);
        }
    } else {
        echo "0 results";
    }

    $Products = explode(",", $ProdStr);
    //$Products = explode(",", $ProdStr);
    //$P = $Products[1];
    //echo json_encode($Products[1]);
    $len = count($Products);
    //echo json_encode($len);
    for ($a = 0; $a < $len; $a++) {
        $PID = $Products[$a];
        $Have = "INSERT INTO HAVE (PROD_ID,BILL_NO) VALUES('$PID','$BillNo')";
        //echo json_encode("The vale of Have is s'$Have'");
        mysqli_query($conn,$Have);
        /*if(mysqli_query($conn,$Have)){
            echo json_encode(" successfully stored in Have table");
        } else {
            echo json_encode("Error: " . $bill . "<br>" . mysqli_error($conn));
        }*/
    } 



  /*  $BNF = $BN + 1;
    $sq = "UPDATE HAVE SET BILL_NO='$BNF' WHERE BILL_NO='$BN'";
    if(mysqli_query($conn,$sq)){
        echo json_encode("Have Stored");
    } else {
        echo json_encode("Error: " . $bill . "<br>" . mysqli_error($conn));
    }*/

}

/*else if($S && $B) {
   // $BN = $B + 1;
    $addHave = "INSERT INTO HAVE VALUES('$S','$B')";
    if(mysqli_query($conn, $addHave)) {
        echo json_encode("Stored successfully in Have");
    } else {
        echo json_encode("Error updating record: " . mysqli_error($conn));
    }
}*/

else if($Prod_Id && $CusId && $Qnty) {
    $pur_date = date('Y-m-d');
    $addPur = "INSERT INTO PURCHASES (PROD_ID,CUS_ID,PROD_QNTY,PUR_DATE) VALUES('$Prod_Id','$CusId','$Qnty','$pur_date')";
    mysqli_query($conn,$addPur);

    /*if(mysqli_query($conn, $addPur)) {
        echo json_encode("Stored successfully in PURCHASES");
    } else {
        echo json_encode("Error updating record: " . mysqli_error($conn));
    }*/

    $gtProdTy = "SELECT TYPE FROM PRODUCT WHERE PROD_ID='".$Prod_Id."'";
    $result5 = mysqli_query($conn, $gtProdTy);
    if (mysqli_num_rows($result5) > 0) {
        while($row = mysqli_fetch_assoc($result5)) {
            $ProdTy = $row["TYPE"];
        }
    }

    $addNF2 = "INSERT INTO NF2 VALUES ('$Prod_Id','$ProdTy')";
    if(mysqli_query($conn, $addNF2)) {
        echo json_encode("Stored successfully in NF2");
    } else {
        echo json_encode("Error updating record: " . mysqli_error($conn));
    }
}

else if($c && $CusId) {
    //$DH = "DELETE FROM HAVE WHERE PROD_ID='".$PId."' AND BILL_NO='".$BN."'";
    //mysqli_query($conn,$DH);
    $DP = "DELETE FROM PURCHASES WHERE PROD_ID='".$c."' AND CUS_ID='".$CusId."'";
    //echo json_encode("The vale of Have is s'$DP'");
    mysqli_query($conn,$DP);

    $DN = "DELETE FROM NF2 WHERE PROD_ID='".$c."'";
    mysqli_query($conn,$DN);

}
#echo $result;
#echo "$result";
#echo "Prod_id:".$result["PROD_ID"]." Prod_Name:".$result["NAME"]." Price:".$result["PRICE"];

mysqli_close($conn);
?>