<?php
$string_to_encrypt="encoder";
$key_password="password";
$encrypted_string=openssl_encrypt($string_to_encrypt,"AES-128-ECB",$key_password);
$decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$key_password);

echo $encrypted_string;
echo "<br>";
echo $decrypted_string;
?>