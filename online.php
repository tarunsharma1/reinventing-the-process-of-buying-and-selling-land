<?php
include "connect.php"
$comment = $_GET["param1"];
$lat = $_GET["param2"];
$lng = $_GET["param3"];
echo $comment;
echo $lat;
echo $lng;

$sql = "INSERT INTO `locations`( `latitude`, `longitude`,`image`, `comments`) VALUES ($lat,$lng,'',$comment)";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
$conn.close();

?>