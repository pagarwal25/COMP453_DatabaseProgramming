<?php 

$zipcode = $_GET['zipcode'];



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
		
//selecting agents for the zipcode passed from history page
	$sql = "SELECT * FROM agentdetails WHERE AgentID IN (SELECt AgentID FROM agentarea WHERE ZipCode = '$zipcode')";
	$result_agents =$pdo->query($sql);

?>

<html>
	<head>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	
	<style>
		table{
			border-collapse: separate !important;
    border-spacing: 0;
		}
		td {
		padding: 15px;
		   }
		tr.border_bottom {
				  border-bottom:1pt solid black;
				  border-top:1pt solid black;
				  border-left:1pt solid black;
				  border-right:1pt solid black;
				  
				  background-color:gray;
				  color:white;
		}
		
		<!-- border radius not working -->
		.bordered {
				border: solid #ccc 1px;
				-moz-border-radius: 6px;
				-webkit-border-radius: 6px;
				border-radius: 5px 5px 0 0;
				-webkit-box-shadow: 0 1px 1px #ccc;
				-moz-box-shadow: 0 1px 1px #ccc;
				box-shadow: 0 1px 1px #ccc;
}
	</style>
	</head>
		<body style="font-family:TimesNewRoman;">
			<center>
				<h3> <b>Agents in zipcode <?php echo $zipcode;?>:</b></h3><br/>
				
					<?php foreach($result_agents as $agents){?>
						<table class="bordered">
						<tr class="border_bottom"><td><span class="glyphicon glyphicon-user"></span></td>
							<td>First Name:  <?php echo $agents['AgentFirstName'];?><br/><br/>Last Name:  <?php echo $agents['AgentLastName'];?><br/><br/>Ratings:  <?php echo $agents['AgentRating'];?><br/><br/>Contact No.:  <?php echo $agents['PhoneNo'];?></td>
						</tr>
						</table><br/>
					<?php }?>
				
			</center>
		</body>
</html>