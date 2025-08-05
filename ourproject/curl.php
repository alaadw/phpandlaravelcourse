<?php
/**  What is cURL?
cURL stands for Client URL. It is a command-line tool and library used to transfer data to or from a server, using many different protocols like:

HTTP / HTTPS (most common)

FTP / SFTP

SMTP / IMAP */
$data = ['username' => 'Alaa4', 'email' => 'alaa.dw@hotmail.com', 'password'=> '12345678', 'user_type' => '1'];

$ch = curl_init("http://localhost/ourproject/action_register.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
