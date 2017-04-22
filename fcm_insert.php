<?php
require "conn.php";

$fcm_token=$_POST['fcm_token'];
$sql="INSERT INTO fcm_info VALUES('".$fcm_token."');";
$con=getConn();
if($con->query($sql)){
	echo "Token Done";
}

$con->close();

?>