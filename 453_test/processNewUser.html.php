<?php

$username = $_POST['email'];
$password = $_POST['password'];

/* $hashPassword = password_hash($password,PASSWORD_DEFAULT); */

try{
	
	$pdo = new PDO('mysql:host=localhost;dbname=cozy_homes', 'pagarwal', 'pa251188');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
	
}

catch(PDOException $e){
	$error = 'Unable to connect to server';
	include 'error.html.php';
	exit();
}

try{
	$sql = 'insert into userdetails SET 
									UserName=:email,
									PwdHash=:password';
	$s = $pdo->prepare($sql);
	$s->bindValue(':email', $username);
    $s->bindValue(':password',$password);
	
	$s->execute();
}
catch(PDOException $e){
	$error = 'Unable to insert login and passwordhash';
	include 'error.html.php';
	exit();
}

echo 'Sign-up complete. You are a member now.';

?>

<html>
<head>

</head>
<body>

    <p><a href="index.php">Let's get started</a></p>
</body>
</html>
