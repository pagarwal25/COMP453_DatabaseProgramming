<?php
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

if(isset($_POST['submit']))
{
  echo "entered isset submit";
      $propID = $_POST["PropertyID"];
      $apartmentID = $_POST["aptID_new"];
      $price = $_POST["price_newprop"];
      $lease = $_POST["lease_newprop"];
      $type=$_POST["Property_type"];

      try
      {
        echo "entered sql part";

        $sql = "INSERT INTO apartment VALUES('$apartmentID','$propID','$price','$lease','$type')";
        $pdo->query($sql);
      }
      catch(PDOException $e)
      {

        echo "Unable to insert data";
      }
}
else{
  echo "invalid data";
}

try{
	$sql_PropertyID= 'SELECT PropertyID FROM property';
	$result = $pdo->query($sql_PropertyID);
  $sql_PropertyType= 'SELECT TypeName FROM propertytype';
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
	$TypeName[] = $row['TypeName'];
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
  <?php foreach($TypeName as $TypeName_d): ?>

  <option value="<?php echo $TypeName_d;?>"><?php echo $TypeName_d;?></option>
  <?php endforeach; ?>
  </select>
  <input type="submit" value="submit" name="submit">
</div>
</form>
</body>
</html>
