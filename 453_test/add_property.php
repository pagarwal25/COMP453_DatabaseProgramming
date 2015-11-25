<?php
include 'dbRequests.php';
if(isset($_POST['submit']))
{
	//if we hit submit button, store the entered val in some variables
	$propertyID = $_POST["PropertyID"];
	$propertyName = $_POST["PropertyName"];
	$address = $_POST["Address"];
	$zipCode = $_POST["ZipCode"];
  $phoneNo = $_POST["PhoneNo"];
  $rating = $_POST["Rating"];
	$sql = "INSERT INTO property VALUES('$propertyID','$propertyName','$address','$zipCode','$phoneNo','$rating')";
	$insert_property = executeQuery($sql);
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style_madhura.css">
</head>
<body>
<form action="add_property.php" method="POST">
<h3 >Form to add Property</h3>
<div class="center">
	<table>
  	<tr><td>
					<label for="PropertyID">Add Property ID:</label>
		      <td><input type="text" name="PropertyID"></td>
        </td></tr>
				<br/><br/>

        <tr><td>
              <label for="Property Name">Add Property Name:</label>
              <td><input type="text" name="PropertyName"></td>
            </td></tr>
            <br/>

		</td></tr>
    	<tr><td>Enter Address:<td><input type="text" name="Address"></td></td></tr><br/>
    		<tr><td>Enter Zipcode:<td><input type="text" name="ZipCode"></td></td></tr>
    		<tr><td>Enter Phone No:<td><input type="text" name="PhoneNo"></td></td></tr>
        <tr><td>Enter Rating:<td><input type="text" name="Rating"></td></td></tr>


	</td></tr>
  	<tr><td>  <input class="inputStyleSubmit" input type="submit" value="Submit" name="submit"></td></tr>
</div>
</table>
</form>
</body>
</html>
