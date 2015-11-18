<?php
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

if(isset($_POST['submit'])) { //if we hit submit button, store the entered val in some variables
	$propID = $_POST["PropertyID"];
	$apartmentID = $_POST["aptID_new"];
	$price = $_POST["price_newprop"];
      	$lease = $_POST["lease_newprop"];
      	$type=$_POST["Property_type"];
      try {
	echo $propID,$apartmentID,$price,$lease,$type ;

	$sql = "INSERT INTO apartment VALUES('$apartmentID','$propID',$price,'$lease','$type')";
        $pdo->exec($sql);
        echo "values entered";
      }
      catch(PDOException $e) {
        echo "Unable to insert data";
      }
}
else {
  echo "invalid data";
}

try {
	$sql_PropertyID= 'SELECT PropertyID FROM property';
  	$result = $pdo->query($sql_PropertyID);

	$sql_PropertyType= 'SELECT TypeID, TypeName FROM propertytype';// for type name..
  	$resultType = $pdo->query($sql_PropertyType);
}


catch(PDOException $e){
	$error = 'error selecting Property ID'. $e->getMessage();
		include 'error.html.php';
		exit();
}

while ($row = $result->fetch()){
	$propertyID[] = $row['PropertyID'];
}
while ($row = $resultType->fetch()){
	$propertyType[$row["TypeID"]] = $row["TypeName"];//key cha name type id madhe jail and resuly display hoil
}

?>

<html>
<body>
<form action="add_property.php" method="POST">
<h3>Select Property ID from the dropdown</h3>
<div>
  	<label for="PropertyID">Property ID:</label>
        <select name="PropertyID" style="width:200px">
    		<option value="select">--Select--</option>
    		<?php foreach($propertyID as $pID): ?>
    		<option value="<?php echo $pID;?>"><?php echo $pID;?></option>
    		<?php endforeach; ?>
  	</select><br/><br/>
    	Apartment ID:<input type="text" name="aptID_new">
    	Price:<input type="text" name="price_newprop">
    	Lease Period:<input type="text" name="lease_newprop">

	<label for="Property_type">Property Type:</label></br>
  	<select name="Property_type" style="width:200px">
  		<option value="select">--Select--</option>
		<?php foreach($propertyType as $x => $x_value): ?> //x is key cha name and x_value is its value.. that is x is AAAB and X_value is type name that is description of the type.i.e type name.(x is type id and x.value is type name)
  		<option value="<?php echo $x;?>"><?php echo $x_value;?></option>
  		<?php endforeach; ?>
  	</select>
  	<input type="submit" value="submit" name="submit">
</div>
</form>
</body>
</html>