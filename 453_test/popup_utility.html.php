<?php

$PropertyID = $_POST['PropertyID'];
$PropertyName = $_POST['PropertyName'];
$Price =$_POST['Price'];

//connection block
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

$sql = "select utilitytype.UtilityDescription AS description,propertyutility.Availability AS availability,propertyutility.Charges AS charges
		FROM property,propertyutility,utilitytype 
		WHERE property.PropertyID= propertyutility.PropertyID AND 
		propertyutility.UtilityID = utilitytype.UtilityID AND 
		property.PropertyID= '$PropertyID'";
$result = $pdo->query($sql);


?>

<html>
<body>

<?php echo $PropertyName;?>
<table>
<?php foreach($result as $utility){?>
<tr>
<td><?php echo $utility['description'];?></td>
<td><?php echo $utility['availability'];?></td>
<td><?php echo $utility['charges'];?></td>
<?php $Price = $Price + $utility['charges']; ?>
</tr>
<?php 	
}?>
</table>

<?php echo "Total rent of the apartment will be = "."$".number_format($Price,2,'.','');?>
</body>
</html>





