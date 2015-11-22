
<?php

$username = $_GET['username'];

	//connection string
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



?>

<html>
<head>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<script type="text/javascript">


	
	
	
</script>
<style>
a{
	color:white;
	
}

</style>

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="/COMP453_DatabaseProgramming/453_test/css/main_popup.css">

</head>


<body a link="black" vlink="black" >



<nav class= "navbar nav-default  nav-fixed-top">

<div class="container-fluid">
   
    <div id="content">
      <ul id="navlist">
       <p style="font-family:Constantia;">Cozy Homes'</p>
		<li class="active headerItem"><form action="index.html"><button type="submit"  name="unlike" id="unlike"><i class="glyphicon glyphicon glyphicon-off"></i></button></form></li>
		 <li class="active headerItem"><a href="index.html">Logout</a></li>
		 <li class="active headerItem"><a href="listingPage.html.php?username=<?php echo $username;?>">Return</a></li>
		  
       
      </ul>
    </div>
  </div>

</nav>




<center> <p style="top:1em; font-family: calibri;font-size:1.8em;color:gray;">List of all the apartments added in your interest list</p> </center>

<hr width="50%">
<br/>
<?php foreach($result_zipcode as $zipcode){ ?>
		<center><p style="background-color:#333333; color:white; font-size:1.5em; text-align:center;font-family:calibri; width:25%;"><a href="popup_agents.html.php?zipcode=<?php echo $zipcode['ZipCode'];?>" id="popup"><?php echo $zipcode['ZipCode'];?></a></p></center>
		
		<?php
		//selecting apartments, particular user is interested in ------ query inside foreach because records were not coming correctly
			$sql_apartments = "SELECT * FROM userinterest WHERE username='$username' AND ZipCode='".$zipcode['ZipCode']."' ORDER BY ZipCode";
			$result_apartments = $pdo->query($sql_apartments); 
			
			
			foreach($result_apartments as $apartments){

			?>
			
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
			
			
			
			}
	 }

?>



																			

<div id="boxes">
  <div id="dialog" class="window">
    Click on <b>Zipcode</b> to find <b>Agents</b>
    <div id="popupfoot">  <a class="agree"style="color:red;" href="#">Got it!</a> </div>
  </div>
  <div id="mask"></div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
<script src="/COMP453_DatabaseProgramming/453_test/js/main_popup.js"></script> 
</body>



</html>