<?php

if(isset($_POST['telephone'])){
	

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$PostCode = $_POST['zip'];

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
	
	</script>
	
	<!--  <meta name="viewport" content="width=device-width, initial-scale=1">  -->
	<!-- <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"> -->
	<!-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>  -->
	<!-- <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>  -->
	
	
	
</head>
<body a link="black" vlink="white">
<div id="everything">
<nav class= "navbar nav-default  nav-fixed-top">
<div id="navlist">
<p> Cozy Homes'</p>
</div>
<div id="content">
	<ul id="navlist">
			<!-- <li><a href="">Bla</a></li>
            <li><a href="">More bla</a></li>
            <li><a href="">Super bla</a></li>
            <li><a href="">Bhooo</a></li>
            <li><a href="">Bhaaoo</a></li>
            <li><a href="">Bhootttttt</a></li> -->
			<li><a href="">Welcome <?php echo $username;?>!</a></li>
	</ul>
 </div>
</nav>
<div class="bodycontent">
<div id="ileftdiv">
	<form action="rightResult.html.php"  method="post" id="input_form" name="inputform" class="inputForm" target="rightFrame">
	<div>
     
	 
        <input type="hidden" name="username" id="username" value="<?php echo $username;?>">
    </div>
	
	<div>
     <label for="zipcode">ZipCode:</label></br>
	 
        <input type="text" name="zipcode" id="zipcode">
    </div>
	
	
	<!--<div data-role="rangeslider">
        <label for="price-min">Price:</label>
        <input type="range" name="price-min" id="price-min" value="200" min="0" max="1000">
        <label for="price-max">Price:</label>
        <input type="range" name="price-max" id="price-max" value="800" min="0" max="1000">
     </div>  -->
	 
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
     <input type="submit" value="Search" onclick="javascript:ajax_post();">
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