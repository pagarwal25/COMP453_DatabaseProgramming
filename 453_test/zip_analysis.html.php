<?php 

$zipcode = $_POST['zipcode'];

echo $zipcode;

//connection string
try {
	$pdo = new PDO('mysql:host=localhost;dbname=cozy_homes', 'pagarwal', 'pa251188');
 	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e) {
  	$error = 'Unable to connect to the database server.';
  	include 'error.html.php';
  	exit();
}

//query to analyse zipcode
$sql = "SELECT * FROM zipcodeindex WHERE ZipCode='$zipcode'";
$result = $pdo->query($sql);
?>
<html>
<body>

<?php foreach ($result as $zipindex){ 

$population= number_format($zipindex['population']);?>
	The 2014 Chicago (zip <?php echo $zipcode;?>), Illinois, population is <?php echo $population;?>.<br/><br/>
    It's violent crime, on a scale from 1 (low crime) to 100, is <?php echo $zipindex['VoilentCrime'];?>.Violent crime is composed of four offenses: murder and
 nonnegligent manslaughter, forcible rape, robbery, and aggravated assault. The US average is 41.4.<br/><br/>
  The property crime, on a scale from 1 (low) to 100, is <?php echo $zipindex['PropertyCrime'];?>. Property crime includes the offenses of burglary, larceny-theft, motor vehicle theft, and arson. The object of the theft-type offenses is the taking of money or property,
  but there is no force or threat of force against the victims. The US average is 43.5.<br/><br/>
  <?php echo $zipcode;?> Chicago, IL has Livability index of <?php echo $zipindex['LivabilityIndex'];?>, and has the walkability score of <?php echo $zipindex['WalkScore'];?>. 
	Hence, <?php echo $zipindex['walkScoreRank'];?>.
  
<?php } ?>

</body>
</html>