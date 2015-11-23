<?php


$priceMin =$_POST['minPrice'];
$priceMax =$_POST['maxPrice'];
$type =$_POST['Property_type'];
$username =$_POST['username'];

//echo $priceMin.$priceMax.$type.$username =$_POST['username'];

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
//query for finding neighbourhoods
$sql= "SELECT DISTINCT(ZipCode) as zipcode from property WHERE EXISTS (SELECT * FROM apartment, propertytype WHERE
																									 property.PropertyID = apartment.PropertyID AND
																									 propertytype.TypeID = apartment.TypeID AND
																									 propertytype.TypeName='$type' AND
																									 apartment.Price BETWEEN '$priceMin' AND '$priceMax') ORDER BY ZipCode";
$result = $pdo->query($sql);

?>
<html>


	<head>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
	<!-- jquery to submit form on selecting a radio button -->
				<script>
				$('input[type=radio]').click(function() {
					$("zipform").submit();
				});

				</script>
	</head>
<body>
	<div class="zip_bodycontent">
		<h2>Select zipcode to find the overview:</h2><br/>
		<div id="zip_left">
			<form action="zip_analysis.html.php" method="post" id="zipform" name="zipform" class="inputForm" target="zip_right_Frame">
				
				<table>
				<?php foreach($result as $zipcode){ ?>
					<tr>
						<td><input type="radio" name="zipcode" value="<?php echo $zipcode['zipcode'];?>" onclick="this.form.submit()"><?php echo $zipcode['zipcode'];?></td>
					</tr>
				<?php } ?>
				</table>
			</form>
		</div>


		<div id="zip_right">
			<iframe id="zip_right_Frame" src="" scrolling="No" frameBorder="1" name="zip_right_Frame" />
		</div>

	</div>
</body>
</html>