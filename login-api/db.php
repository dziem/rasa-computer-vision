<?php
 header('Access-Control-Allow-Origin: *'); 
 header('Access-Control-Allow-Headers: Content-Type'); 
 $con = mysqli_connect("localhost","root","","rasa_api") or die("could not connect DB");
?>