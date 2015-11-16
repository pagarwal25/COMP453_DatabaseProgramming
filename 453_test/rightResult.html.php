<?php
$zipcode =$_POST['zipcode'];
$priceMin =$_POST['minPrice'];
$priceMax =$_POST['maxPrice'];
$type =$_POST['Property_type'];
$username =$_POST['username'];


try
{

  $pdo = new PDO('mysql:host=localhost;dbname=cozyhomes', 'root', 'c5shreelawns');
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
	$sql = 'SELECT Apartment.ApartmentID,
				   property.PropertyName,
				   propertytype.TypeName,
				   apartment.Price,
				   apartment.LeasePeriod,
				   property.Address,
				   property.ZipCode,
				   property.PhoneNo,
				   property.Rating
			FROM Property, Apartment, propertytype
			WHERE propertytype.TypeID= apartment.TypeID AND
				  apartment.PropertyID = property.PropertyID AND
				  propertytype.TypeName = :TypeName AND
				  property.ZipCode = :ZipCode AND
				  Price BETWEEN :minPrice AND :maxPrice';
	 $s = $pdo->prepare($sql);
    $s->bindValue(':minPrice', $priceMin);
    $s->bindValue(':maxPrice', $priceMax);
	$s->bindValue(':ZipCode', $zipcode);
	$s->bindValue(':TypeName', $type);
	$s->execute();
	$result = $s->fetchAll();

	//$result = $pdo->query($sql);
}

catch (PDOException $e)
  {
    $error = 'Error fetching departments: ' . $e->getMessage();
  include 'error.html.php';
  exit();
  }

  echo "data fetched";




  if (isset($_POST['like'])){
	  echo "entered if";
		$ApartmentID = $_POST['ApartmentID'];
		$PropertyName = $_POST['PropertyName'];
		$TypeName = $_POST['TypeName'];
		$Price = $_POST['Price'];
		$LeasePeriod = $_POST['LeasePeriod'];
		$Address = $_POST['Address'];
		$ZipCode = $_POST['ZipCode'];
		$PhoneNo = $_POST['PhoneNo'];

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

		 try
		{
		$sql = 'INSERT INTO userinterest SET
        username = :username,
        ApartmentID = :ApartmentID,
        PropertyName = :PropertyName,
        TypeName = :TypeName,
		Price = :Price,
		LeasePeriod = :LeasePeriod,
		Address = :Address,
		ZipCode = :ZipCode,
		PhoneNo = :PhoneNo';
		$s = $pdo->prepare($sql);
		$s->bindValue(':username', $username);
		$s->bindValue(':ApartmentID', $ApartmentID);
		$s->bindValue(':PropertyName', $PropertyName);
		$s->bindValue(':TypeName', $TypeName);
		$s->bindValue(':Price', $Price);
		$s->bindValue(':LeasePeriod', $LeasePeriod);
		$s->bindValue(':Address', $Address);
		$s->bindValue(':ZipCode', $ZipCode);
		$s->bindValue(':PhoneNo', $PhoneNo);

		$s->execute();
		}
		catch (PDOException $e)
		{
		$error = 'Error adding in userinterest records: ' . $e->getMessage();
		include 'error.html.php';
		exit();
		}
		header('Location: .');
  exit();

  }
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<title>List of Departments</title>
<style>
table,th,td
{
border:1px solid black;
padding:5px;
}
</style>
</head>
<body>

    <h3>List of all the options:</h3>

    <center>
	<table >
	<tr>
	<th>BuildingName</th>
	<th>Aprtment Type</th>
	<th>Price</th>
	<th>LeasePeriod (in mths)</th>
	<th>Address</th>
	<th>ZipCode</th>
	<th>PhoneNo</th>
	<th>Rating</th>

	</tr>
    <?php foreach($result as $Apartment): ?>
      <tr>
      <td> <?php echo $Apartment['PropertyName']; ?> </td>
       <td style= "width:150px"> <?php echo $Apartment['TypeName']; ?> </td>
        <td> <?php echo $Apartment['Price']; ?> </td>
         <td> <?php echo $Apartment['LeasePeriod']; ?> </td>
		 <td> <?php echo $Apartment['Address']; ?> </td>
		 <td> <?php echo $Apartment['ZipCode']; ?> </td>
		 <td> <?php echo $Apartment['PhoneNo']; ?> </td>
		 <td> <?php echo $Apartment['Rating']; ?> </td>
		 <td>
			<form action = "rightResult.html.php" method = "POST">
				<input type="hidden" name="ApartmentID" value="<?php echo $Apartment['ApartmentID']; ?>">
				<input type="hidden" name="PropertyName" value="<?php echo $Apartment['PropertyName']; ?>">
				<input type="hidden" name="TypeName" value="<?php echo $Apartment['TypeName']; ?>">
				<input type="hidden" name="Price" value="<?php echo $Apartment['Price']; ?>">
				<input type="hidden" name="LeasePeriod" value="<?php echo $Apartment['LeasePeriod']; ?>">
				<input type="hidden" name="Address" value="<?php echo $Apartment['Address']; ?>">
				<input type="hidden" name="ZipCode" value="<?php echo $Apartment['ZipCode']; ?>">
				<input type="hidden" name="PhoneNo" value="<?php echo $Apartment['PhoneNo']; ?>">

				<input type="hidden" name="zipcode" value="<?php echo $zipcode; ?>">
				<input type="hidden" name="minPrice" value="<?php echo $priceMin; ?>">
				<input type="hidden" name="maxPrice" value="<?php echo $priceMax; ?>">
				<input type="hidden" name="Property_type" value="<?php echo $type; ?>">
				<input type="hidden" name="username" value="<?php echo $username; ?>">

				<button type="submit" name="like"><i class="glyphicon glyphicon-thumbs-up"></i></button>
			</form>
		 </td>
         <!-- <td>
         <form action="?deleteDept" method="post">
          <input type="hidden" name="id" value="<?php echo $department['dnumber']; ?>">
         <input type="submit" value="delete">
        </form>
      </td>  -->
      </tr>
    <?php endforeach; ?>
    </table>
	</center>

  </body>
</html>
