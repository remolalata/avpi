<?php
include'../db_connection.php';
$old_password = $_POST['old_password'];
$user_id = $_POST['user_id'];

$key_password="password";
$encrypted_string=openssl_encrypt($old_password,"AES-128-ECB",$key_password);

$query = mysqli_query($conn, "select * from users where user_id='$user_id' and password='$encrypted_string' ");
$count = mysqli_num_rows($query);
echo json_encode(array(
	'count' => $count,
    'old_password' => $old_password,
    'user_id' => $user_id
	));
?>