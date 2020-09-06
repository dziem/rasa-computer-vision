<?php
include "db.php";
session_start();
$input = file_get_contents('php://input');
$data = json_decode($input,true);
$message = array();

$username = $data['username'];
$password = $data['password'];
$sender_id = $data['sender_id'];
$mint = $data['mint'];
$q = mysqli_query($con,"select user_id, last_sender_id from user where username = '$username' and password = '$password'");
$row = mysqli_fetch_assoc ($q);
$count = mysqli_num_rows($q);
if($count > 0) {
	if(empty($row['last_sender_id']) || $mint == false){
		setcookie('rasa_logged_in', $sender_id,time()+3600*24*30, '/');
		$message['status']= 'success';
		$message['content']= $sender_id;
		$user_id = $row['user_id'];
		$qq = mysqli_query($con,"update user set last_sender_id='$sender_id' where user_id = '$user_id'");
	}else{
		setcookie('rasa_logged_in', $row['last_sender_id'],time()+3600*24*30, '/');
		$message['content']= $row['last_sender_id'];
		$message['status']= 'success';
	}
}else {
	$message['status']= "fail";         
	$message['content']= "fail, wrong password or username";         
}
echo json_encode($message);
?>