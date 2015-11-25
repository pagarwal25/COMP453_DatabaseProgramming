<?php

if(isset($_POST['telephone'])){
	

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$PostCode = $_POST['zip'];

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

try
  {
    $sql = 'INSERT INTO userdetails SET
        UserName = :username,
        Password = :password,
        email = :email,
        telephone=:telephone,
		PostCode=:zipcode';
    $s = $pdo->prepare($sql);
    $s->bindValue(':username', $username);
    $s->bindValue(':password', $password);
    $s->bindValue(':email', $email);
	$s->bindValue(':telephone', $telephone);
	$s->bindValue(':zipcode', $PostCode);
    
    $s->execute();
  }
  catch (PDOException $e)
  {
    
  }
}
else
{
	$username= $_GET['username'];
}

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

try{
	$sql_PropertyType= 'SELECT TypeName FROM propertytype';
	$result = $pdo->query($sql_PropertyType);
}

catch(PDOException $e){
	$error = 'error selecting Property Type'. $e->getMessage();
		include 'error.html.php';
		exit();
}

while ($row = $result->fetch()){
	$TypeName[] = $row['TypeName'];
}


?>
<!DOCTYPE html>
<html>
<head>
	
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
        <li class="dropdown headerItem">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="edit.html.php?username=<?php echo $username;?>">Edit Details</a></li>
            <li><a href="history.html.php?username=<?php echo $username;?>">Interests</a></li>
            <li><a href="index.html">Logout</a></li> 
          </ul>
        </li>
		 <li class="active headerItem"><a href="#">Welcome <?php echo $username;?>!</a></li>
       
      </ul>
    </div>
  </div>







</nav>
<div class="bodycontent">
<div id="ileftdiv">
	<form method="post" id="input_form" name="inputform" class="inputForm" target="rightFrame">
	<div>
     
	 
        <input type="hidden" name="username" id="username" value="<?php echo $username;?>">
    </div>
	
	
	
	<!--<div data-role="rangeslider">
        <label for="price-min">Price:</label>
        <input type="range" name="price-min" id="price-min" value="200" min="0" max="1000">
        <label for="price-max">Price:</label>
        <input type="range" name="price-max" id="price-max" value="800" min="0" max="1000">
     </div>  -->
	 
	 
	 <!-- Property Type like 1 BED 1 BATH -->
	 <div>
      <label for="Property_type">Property Type:</label></br>
        <select class="inputStyle_left" name="Property_type" style="width:200px">
		<option value="select">--Select--</option>
		<?php foreach($TypeName as $TypeName_d): ?>
		
		<option value="<?php echo $TypeName_d;?>"><?php echo $TypeName_d;?></option>
		<?php endforeach; ?>
		</select>
     </div>
	 
	 
	 <!-- Minimun and Maximun Price of Apartment -->
	 <div>
	  <label for="price-min">Price Min.:</label>
	  <br/>
	  <input type="range" min="500" max="7000" steps="10" value="500"  onChange="sliderChangeMin(this.value)"/><br/><span id="sliderStatusMin">500</span>
	  <input type="hidden" id="minPrice" name="minPrice">
	  <br/>
	  	  
	 </div>
	 
	 <div>
	  <label for="price-max">Price Max.:</label>
	  <br/>
	  <input type="range" min="500" max="7000" steps="10" value="500"  onChange="sliderChangeMax(this.value)"/><br/><span id="sliderStatusMax">500</span>
	  <input type="hidden" id="maxPrice" name="maxPrice">
	 <br/>
	  	  
	 </div>
	 
	 
	 <!-- search neighbourhood -->
	 <div>
     <button class="inputStyleSubmit_left" type="submit" value="Search" id="search" formaction="rightNeighbourhood.html.php">Search Neighbourhood</button>
	 </div>
	 <br/>
	 <!-- Zipcode looking for -->
	<div>
     <label for="zipcode">ZipCode:</label></br>
	 
        <input class="inputStyle_left" type="text" name="zipcode" id="zipcode">
    </div>
	
	
	<!-- seach apartments -->
	<div>
     <button class="inputStyleSubmit_left" type="submit" value="Search" id="search" formaction="rightResult.html.php">Search Apartments</button>
	 </div>
	 
	 
	 
    </form>
</div>

<div id="iRightDiv">
	<iframe id="iRightFrame" src="right.html.php" scrolling="Yes" frameBorder="1" name="rightFrame" />
</div>


</div>




</div>

</body>
<html>