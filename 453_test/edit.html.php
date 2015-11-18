<?php 

$username = $_GET['username'];



if (isset($_POST['update'])){
	
	$username=$_GET	['username'];
	$password=$_POST['password'];
	$email=$_POST['email'];
	$telephone=$_POST['telephone'];
	$postcode=$_POST['postcode'];
	try{
 $pdo = new PDO('mysql:host=localhost;dbname=cozy_homes', 'pagarwal', 'pa251188');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
  
  $error = 'Unable to connect to the database server.';
  include 'error.html.php';
  exit();
}

try {
	$sql = 'UPDATE userdetails SET Password=:password, 
								   email=:email,
								   telephone=:telephone,
								   PostCode=:postcode
							WHERE username=:username';
							
	$s = $pdo->prepare($sql);
		$s->bindValue(':username', $username);
		$s->bindValue(':password', $password);
		$s->bindValue(':email', $email);
		$s->bindValue(':postcode', $postcode);
		$s->bindValue(':telephone', $telephone);
		   
		$s->execute();
		
		$message = "Updated";
		echo "<script type='text/javascript'>alert('$message');</script>";
		//header("Location:listingPage.html.php?username=$username");
		
		
		
		
}
catch (PDOException $e)
{
  
  $error = 'Unable to update to the database server.';
  include 'error.html.php';
  exit();
}


	
}




try{
 $pdo = new PDO('mysql:host=localhost;dbname=cozy_homes', 'pagarwal', 'pa251188');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
  
  $error = 'Unable to connect to the database server.';
  include 'error.html.php';
  exit();
}

try{
	
	$sql = 'SELECT * FROM userdetails WHERE UserName=:username';
	 $s = $pdo->prepare($sql);
    $s->bindValue(':username', $username);
    
	$s->execute();
	$result = $s->fetchAll();	
}
catch (PDOException $e)
{
  $error = 'Error fetching userdetails: ' . $e->getMessage();
  include 'error.html.php';
  exit();
}






?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>List of Departments</title>
<style>
 <style>
 
 
 
           body{font-family:Verdana; background-color:Black;}
		   table{
    border: 1px solid black;
	border-radius: 8px;
	box-shadow:inset 0 0 7px #D4D4D4;
	
}
		   
		   td {  padding: 15px;} 
		   .inputStyle{
    border-radius: 7px;
	box-shadow:inset 0 0 7px #D4D4D4;
	
	height: 40px;
	font-size: 0.8em;
	border: 1px solid #D4D4D4;
	width:300px ;
}
input:focus {outline:none;}

.inputStyleSubmit{
    border-radius: 7px;
	background-color:#FF8732;
	color:white;
	height: 40px;
	font-size: 0.8em;
	border: 1px solid #FF8732;
	width:200px ;
	cursor:pointer;
	
}
        </style>
</style>
</head>
<body style="font-family:Constantia;">

   
<form action ="" method ="POST">   
   <H2><?php echo $username;?>!</H2><h3> You can update your profile using the below form: </h3>
   
    <table>
    <?php foreach ($result as $userdetails): ?>
      <tr>
	 <td><label for="username">Username : </label></td>
				<td><input class="inputStyle" type="text" disabled id="username" name="username"  value="<?php echo $userdetails['UserName'];?>"/></td>
				
	 <td><label for="Password">Password : </label></td>
				<td><input class="inputStyle type="text" id="password" name="password"  value="<?php echo $userdetails['Password'];?>"/></td>
				
	 <td><label for="email">Email : </label></td>
				<td><input class="inputStyle type="text" id="email" name="email"  value="<?php echo $userdetails['email'];?>"/></td>
				</tr>

	<tr>
	 <td><label for="telephone">telephone : </label></td>
				<td><input class="inputStyle type="text" id="telephone" name="telephone"  value="<?php echo $userdetails['telephone'];?>"/></td>
				
	 <td><label for="postcode">PostCode : </label></td>
				<td><input class="inputStyle type="text" id="postcode" name="postcode"  value="<?php echo $userdetails['PostCode'];?>"/></td>
				
				<td></td>
				<td align="left"><input class="inputStyleSubmit" type="submit" value="Update" name="update" /></td></tr>
				<?php endforeach; ?>
				</table>
			

</form>			
				
				
				
				
     
      
   
   
   
  </body>
</html>
