<?php
include "connect.php";

$pid = 1;
$mother_d_v;
$sale_d_v;
$khatha_a_v;
$khatha_b_v;
$bc_v;
$tax_v;
$ec_v;
$ldi_val;


$sql = "SELECT mother_d,sale_d,khatha_a,khatha_b,bc,tax,ec,ldi_value from ldi where pid = $pid";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $mother_d_v = $row["mother_d"];
        $sale_d_v =  $row["sale_d"];
        $khatha_a_v = $row["khatha_a"];
        $khatha_b_v =  $row["khatha_b"];
        $bc_v = $row["bc"];
        $tax_v = $row["tax"];
        $ec_v =  $row["ec"];
        $ldi_val = $row["ldi_value"];
        //echo $row["mother_d"]. " | " . $row["sale_d"]. "|" . $row["khatha_a"]. " |".$row["khatha_b"]." | ".$row["bc"]." | ".$row["tax"]." | ".$row["ec"]." | ".$row["ldi_value"]."<br>";
    }
} else {
    echo "0 results";
}

$mother_value = split ("#", $mother_d_v)[0]; 
$sale_value = split ("#", $sale_d_v)[0]; 
$khatha_a_value = split ("#", $khatha_a_v)[0]; 
$khatha_b_value = split ("#", $khatha_b_v)[0]; 
$bc_value = split ("#", $bc_v)[0]; 
$tax_value = split ("#", $tax_v)[0]; 
$ec_value = split ("#", $ec_v)[0];

$tax_no = split ("#", $tax_v)[1]; 

$ec_no = split ("#", $ec_v)[1]; 


$mother_location = split ("#", $mother_d_v)[2]; 
$sale_location = split ("#", $sale_d_v)[2]; 
$khatha_a_location = split ("#", $khatha_a_v)[2]; 
$khatha_b_location = split ("#", $khatha_b_v)[2]; 
$bc_location = split ("#", $bc_v)[2]; 
$tax_location = split ("#", $tax_v)[2]; 
$ec_location = split ("#", $ec_v)[2]; 


$ldi_v = $mother_value+ $sale_value+$khatha_a_value+$khatha_b_value+$bc_value+($tax_value*$tax_no)+($ec_value*$ec_no);

echo $ldi_val = $ldi_v/10.0;
$sql  = "UPDATE `ldi` SET `ldi_value`= '$ldi_val' WHERE `pid` = '$pid'";
//echo $sql;
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}










?>