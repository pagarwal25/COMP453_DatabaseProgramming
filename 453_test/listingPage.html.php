<?php

if(isset($_POST['telephone'])){
	

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$PostCode = $_POST['zip'];

try
{

  $pdo = new PDO('mysql:host=localhost;dbname=cozy_homes', 'pagarwal', 'pa251188');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
  
  exit();
}

try
  {
    $sql = 'INSERT INTO userdetails SET
        UserName = :username,
        Password = :password,
        email = :email,
        telephone=:telephone,
		PostCode=:zipcode';
    $s = $pdo->prepare($sql);
    $s->bindValue(':username', $username);
    $s->bindValue(':password', $password);
    $s->bindValue(':email', $email);
	$s->bindValue(':telephone', $telephone);
	$s->bindValue(':zipcode', $PostCode);
    
    $s->execute();
  }
  catch (PDOException $e)
  {
    
  }
}
else
{
	$username= $_GET['username'];
}


?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body a link="black" vlink="white">
<nav class= "navbar nav-default  nav-fixed-top">
<div id="navlist">
<p> Cozy Homes'</p>
</div>
<div id="content">
<ul id="navlist">
			
           <!-- <li><a href="">Bla</a></li>
            <li><a href="">More bla</a></li>
            <li><a href="">Super bla</a></li>
            <li><a href="">Bhooo</a></li>
            <li><a href="">Bhaaoo</a></li>
            <li><a href="">Bhootttttt</a></li> -->
			<li><a href="">Welcome <?php echo $username;?>!</a></li>
 </ul>
 </div>


</nav>

</body>
<html>