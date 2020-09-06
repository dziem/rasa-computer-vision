<?php
include "db.php";
setcookie("rasa_logged_in", "", time() - 3600, '/');
$data['status'] = 'done';
echo json_encode($data);
?>