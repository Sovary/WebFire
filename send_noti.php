<?php
require "conn.php";
$msg=$_POST['msg'];
$title=$_POST['title'];
$path_to_fcm="https://fcm.googleapis.com/fcm/send";
$server_key="XXXXXXX";
$sql="SELECT fcm_token FROM fcm_info;";
$con=getConn();
$rs=$con->query($sql);
$registrationId=array();
$registration_ids=array();
while ($key=$rs->fetch_assoc()) {
	$registration_ids[]=$key['fcm_token'];
}
$j=array("title"=>$title,"body"=>$msg,"icon"=>"http://medayi.com/pc_version/img/main_logo.png");

$fields = array
(
	'registration_ids' 	=> $registration_ids,
	'data'=>$j,
);
 
$headers = array
(
	'Authorization: key=' . $server_key,
	'Content-Type: application/json'
);
$payload=json_encode($fields);
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, $path_to_fcm );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, $payload );
$result = curl_exec($ch );
/*if($result==FALSE){
	die("Not Send");
}*/
curl_close( $ch );
echo $result;
?>