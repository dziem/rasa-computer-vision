<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Content-Type');
$ekstensi = array('jpg','png','jpeg');
$file = $_FILES['file']['name'];
$x = explode('.', $file);
$eks = strtolower(end($x));
$ukuran = $_FILES['file']['size'];
$target_dir = "C:/xampp/htdocs/chatbot/chatbot/img/";

if (! is_dir($target_dir)) {
	mkdir($target_dir, 0755, true);
}

//jika form file tidak kosong akan mengeksekusi script dibawah ini
if($file != ""){
	$temp = explode(".", $file);
	$newfilename = 'image'.rand(1000, 9999).round(microtime(true)) . '.' . $eks;
	//validasi file
	if(in_array($eks, $ekstensi) == true){
		//if($ukuran < 2500000){
			move_uploaded_file($_FILES['file']['tmp_name'], $target_dir.$newfilename);
			echo $newfilename;
		//}
	}
}
?>