<?php
include 'dbRequests.php';
session_start();
if(isset($_SESSION['email']))
{
  $email = $_SESSION['email'];
}
else
{
  $email = $_POST['email'];
  $password = $_POST['password'];
  try
  {
    $sql="select UserName,PwdHash from admindetails where UserName='$email' ";// fetching Username and compare it with testbox adminid.
    $result = executeQuery($sql);

    if($result->rowcount()== 0)
    {
      echo "AdminId or password incorrect!";
      $database_adminid=" ";
      $database_password=" ";
    }
    else
    {
      foreach($result as $row)//fetching adminid and password from DB as it's a more than 1 column, let's put foreach
      {
        $database_adminid= $row['UserName'];
        $database_password= $row['PwdHash'];
      }
    }

    if($database_adminid==$email && $database_password==$password)
    {
      echo "login successfull!!!";
      $_SESSION['email'] = $email;
    }
    else
    {
    echo "Login Unsuccessful!! Try again!!";
    }
  }
  catch (Exception $e)
  {
    echo $e;
    $error = 'Database error ';
    include 'error.html.php';
    exit();
  }
  # code...
}

$sql = 'SELECT TypeName FROM propertytype';
$result = executeQuery($sql);

while ($row = $result->fetch())
{
	$TypeName[] = $row['TypeName'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript">
	function sliderChangeMin(val)
	{
		document.getElementById('sliderStatusMin').innerHTML = val;
		var minPrice= document.getElementById('minPrice');
		minPrice.value = val;

	}
	function sliderChangeMax(val)
	{
		document.getElementById('sliderStatusMax').innerHTML = val;
		var maxPrice= document.getElementById('maxPrice');
		maxPrice.value = val;
	}
	
	function jsAddApartment()
	{document.getElementById('iRightFrame').src='add_apartment.php';}

	</script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">



</head>
<body a link="black" vlink="black" style="font-family:Constantia;">
<div id="everything">






<nav class= "navbar nav-default  nav-fixed-top">

<div class="container-fluid">
   
    <div id="content">
      <ul id="navlist">
			<p style="font-family:Constantia;">Cozy Homes'</p>
		 <li class="active headerItem"><a href="#">Welcome <?php echo $email;?>!</a></li>
       
      </ul>
    </div>
  </div>

</nav>




<div class="bodycontent">
<div id="ileftdiv">
	<form action="rightResult.html.php"  method="post" id="input_form" name="inputform" class="inputForm" target="rightFrame">
	<div>


        <input type="hidden" name="username" id="username" value="<?php echo $email;?>">
    </div>
<center>Search Apartments</center>
	<div>
     <label for="zipcode">ZipCode:</label></br>

        <input type="text" name="zipcode" id="zipcode">
    </div>




	 <div>
	  <label for="price-min">Price Min.:</label>
	  <br/>
	  <input type="range" min="500" max="7000" steps="10" value="500"  onChange="sliderChangeMin(this.value)"/><span id="sliderStatusMin">500</span>
	  <input type="hidden" id="minPrice" name="minPrice">
	  <br/>

	 </div>

	 <div>
	  <label for="price-max">Price Max.:</label>
	  <br/>
	  <input type="range" min="500" max="7000" steps="10" value="500"  onChange="sliderChangeMax(this.value)"/><span id="sliderStatusMax">500</span>
	  <input type="hidden" id="maxPrice" name="maxPrice">
	 <br/>

	 </div>


	<div>
      <label for="Property_type">Property Type:</label></br>
        <select name="Property_type" style="width:200px">
		<option value="select">--Select--</option>
		<?php foreach($TypeName as $TypeName_d): ?>

		<option value="<?php echo $TypeName_d;?>"><?php echo $TypeName_d;?></option>
		<?php endforeach; ?>
		</select>
     </div>
	 <div>
     <input type="submit" value="submit">
	 </div>
	<ul> Control Apartments</ul>
   <div>
     <button type="button"  onClick="jsAddApartment()" >Add New Apartment</button><br>
     <input type="button" onClick="location.href='modify_apartment.php'" value="Modify apartment"><br>
     <input type="button" onClick="location.href='delete_apartment.php'" value="Delete apartment"><br><br>
    
	<center>Control Properties</center>
	
	<input type="button" onClick="location.href='add_property.php'" value="Add New Property"><br>
     <input type="button" onClick="location.href='modify_property.php'" value="Modify Property"><br>
     <input type="button" onClick="location.href='delete_property.php'" value="Delete Property"><br><br>
     <input type="button" onClick="location.href='new_listing.php'" value="New Listing"><br><br>

     <input type="button" onClick="location.href='admin_update_trigger.php'" value="History"><br>

   </div>
    </form>
</div>
<div id="iRightDiv">
	<iframe id="iRightFrame" src="right_admin.html.php" scrolling="Yes" frameBorder="1" name="rightFrame" />
</div>
</div>
</div>
</body>
<html>
