<?php
function getConn(){

	$con=mysqli_connect("localhost","root","","dbfire");
	if(mysqli_connect_errno()){
		die("not connected!");
	}else{
		echo "Connection success";
	}
	return $con;
}
?>