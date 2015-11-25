<?php

try
	{

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
	
	$sql ="select * from New_Admin";
	$result=$pdo->query($sql);
	
	?>
	
	<html>
	<body>
	<table>
	<?php foreach($result as $admin){  ?>
		<tr>
			<td><img src ="<?php echo $admin['ImageLink']?>"  border="3" height="100" width="100"></td>
			<td><?php echo $admin['UserName']?></td>
			<td><?php echo $admin['Password']?></td>
		</tr>
	<?php  } ?>	
	</table>
	</body>
	</html>