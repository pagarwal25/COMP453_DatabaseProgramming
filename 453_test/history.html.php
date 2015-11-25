
<?php

$username = $_GET['username'];

	//connection string
	try
	{

	  $pdo = new PDO('mysql:host=localhost;dbname=cozy_homes', 'statavarthy', 'tata1988');
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $pdo->exec('SET NAMES "utf8"');
	}
	catch (PDOException $e)
	{

	  $error = 'Unable to connect to the database server.';
	  include 'error.html.php';
	  exit();
	}
	
	//delete rec. from userinterest when thumps-down clicked
	if (isset($_GET['unlike']))
	{
		//echo "entered delete bloack";
		$ApartmentID = $_GET['ApartmentID'];
		echo $ApartmentID;
		$sql_delete="DELETE FROM userinterest WHERE 
							  ApartmentID = '$ApartmentID'";
							  
		$result = $pdo->query($sql_delete);
	}



//selecting distict zipcode
$sql_zipcode = "SELECT distinct(ZipCode) FROM userinterest WHERE username='$username' ORDER BY ZipCode";
$result_zipcode = $pdo->query($sql_zipcode);

//selecting apartments, particular user is interested in 
$sql_apartments = "SELECT * FROM userinterest WHERE username='$username' ORDER BY ZipCode";
$result_apartments = $pdo->query($sql_apartments);

?>

<html>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script type="text/javascript">
	window.onload = function() {
		document.getElementById("popup").onclick = function(){
			return !window.open(this.href, "pop", "width=500,height=600");
		}
	}
	
</script>
<style>
a{
	color:white;
	
}
</style>
</head>
<body vlink="white" link="white">

<br/>
<?php foreach($result_zipcode as $zipcode){ ?>
		<center><p style="background-color:#333333; color:white; font-size:1.5em; text-align:center;font-family:calibri; width:25%;"><a href="popup_agents.html.php?zipcode=<?php echo $zipcode['ZipCode'];?>" id="popup"><?php echo $zipcode['ZipCode'];?></a></p></center>
		
		<?php foreach($result_apartments as $apartments){

			if($zipcode['ZipCode'] == $apartments['ZipCode']){?>
			
				<center>
				<p>Building Name: <?php echo $apartments['PropertyName'];?></p>
				<p>Apartment Type: <?php echo $apartments['TypeName'];?></p>
				<p>Price: $<?php echo $apartments['Price'];?></p>
				<p>Lease Period: <?php echo $apartments['LeasePeriod'];?> mths.</p>
				<p>Addess: <?php echo $apartments['Address'];?></p>
				<p>Contact No.: <?php echo $apartments['Phoneno'];?></p>
				<form action = "history.html.php" method = "GET">
					<input type="hidden" id ="ApartmentID" name="ApartmentID" value="<?php echo $apartments['ApartmentID']; ?>">
					<input type="hidden" id ="username" name="username" value="<?php echo $username; ?>">
					<button type="submit"  name="unlike" id="unlike"><i class="glyphicon glyphicon-thumbs-down"></i></button>
				</form><br/>
				<?php 
			} else{ break;}
			
			
			}
	 }

?>

</body>
</html>