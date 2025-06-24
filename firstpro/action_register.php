<?php

/**  [username] => admin [email] => admin@gmail.com [password] => alaa */
//comment
#comment two
//echo "<pre>";
//print_r($_POST); super global variable $_POST contains form data submitted via POST method
//echo $_REQUEST['username'].'<br/>';
//var_dump($_REQUEST); //array(3) { ["username"]=> string(5) "ahmad" ["email"]=> string(15) "ahmad@gmail.com" ["password"]=> string(15) "Sueddeutsche1-@" }

//die("died");
$userName = htmlspecialchars (trim($_POST['username'])); // Sanitize username input
// تنظيف المدخلات   
// htmlspecialchars prevents XSS attacks by converting special characters to HTML entities
// trim removes whitespace from the beginning and end of the string
echo "age".$_POST['age'];
$age = $_POST['age']; // Directly accessing the age input, no sanitization needed for numeric values
$age = 42;
if($_POST['age'] > 20){
   echo "Age is greater than 20";
}
// === identical in type and value
// == equal in value, but not necessarily in type
if($age == 42){
    echo "Age is 42, you are a genius!";
    } else {
    echo "Age is not 42, you are not a genius!";
}

die();
$email = htmlspecialchars(trim($_POST['email']));   
$password = md5( htmlspecialchars(trim($_POST['password'])));

//echo "Username: $userName "."<br/>"; 
//echo "Email: $email"."<br/>";
//echo  "Password: $password"."<br/>";
$data = "Username: $userName "."<br/>"."Username: $userName "."<br/>"."Password: $password"."<br/>"; 
//echo "Email: $email"."<br/>"; 
file_put_contents('data.txt',$data, FILE_APPEND | LOCK_EX);

echo file_get_contents('data.txt');

header("Location: register.php?msg=success&action=new&name=$userName"); // Redirect to register page with success message
