<?php
include 'dbRequests.php';
if (isset($_POST['update']))
{
	$index=$_POST['index'];
	$propertyID=$_POST['propertyID'.$index];
	//echo $apartmentid;
	$propertyName=$_POST['propertyName'.$index];
	//echo $price;
	$address=$_POST['address'.$index];
  $phoneNo=$_POST['phoneNo'.$index];
  $rating=$_POST['rating'.$index];
	//echo $lease;
	$sql = "UPDATE property SET PropertyName='$propertyName',Address='$address', PhoneNo= '$phoneNo', Rating ='$rating'
  WHERE PropertyID='$propertyID'";
	$update_property = executeQuery($sql);
}
$sql = "select * from property";
$result = executeQuery($sql);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Modify Property</title>
<h3> Modify Property</h3>
<style>
 <style>
       body{font-family:Verdana; background-color:Black;}
		  table{
              background-color: #f5f5f5;
              border: 1px solid black;
          	   border-radius: 8px;
          	  box-shadow:inset 0 0 7px #D4D4D4;

          }
          h3
          {
            text-align: center;
          }

		   td {
          padding: 15px;
          }
		   .inputStyle
       {
          border-radius: 7px;
      	box-shadow:inset 0 0 7px #D4D4D4;
      	height: 40px;
      	font-size: 0.8em;
      	border: 1px solid #D4D4D4;
      	width:200px ;
      }

      input:focus {outline:none;}

      .inputStyleSubmit
      {
          padding: 16px 16px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 10px;
          margin: 4px 2px;
          -webkit-transition-duration: 0.4s; /* Safari */
          transition-duration: 0.4s;
          cursor: pointer;
            background-color: #008CBA;
            color: white;
            width: 150px;

      }
        </style>
</style>
</head>

<body style="font-family:Constantia;">


<!--<form action ="?update" method ="POST"> -->

    <table>
      <tr>
        <td>PropertyID</td>
        <td>PropertyName</td>
        <td>Address </td>
				<td>PhoneNo</td>
        <td>Rating </td>

      </tr>
      <?php $index=0;?>
    <?php foreach ($result as $propertydetails): ?>
      <form action ="?update" method ="POST">
    <tr>
        	 <td>
        		   <label for="propertyid">PropertyID : </label>
        	 </td>
    				<td>
    					  <input class="inputStyle" type="text" readOnly="readOnly" id="propertyID" name=<?php echo "propertyID".$index?>  value="<?php echo $propertydetails['PropertyID'];?>"/>
    				</td>

						<td>
         		   <label for="Property Name">PropertyName : </label>
         	 </td>
     				<td>
     					  <input class="inputStyle" type="text" readOnly="readOnly" id="propertyName" name=<?php echo "propertyName".$index?>  value="<?php echo $propertydetails['PropertyName'];?>"/>
     				</td>



        	 <td>
        		    <label for="address">Address: </label>
        	 </td>
    				<td>
    					  <input class="inputStyle" type="text" id="address" name=<?php echo "address".$index?>  value="<?php echo $propertydetails['Address'];?>"/>
    				</td>




            <td><label for="phoneNo">PhoneNo : </label></td>
           <td>
               <input class="inputStyle" type="text" id="phoneNo" name=<?php echo "phoneNo".$index?>  value="<?php echo $propertydetails['PhoneNo'];?>"/>
           </td>


           <td><label for="rating">Rating : </label></td>
          <td>
              <input class="inputStyle" type="text" id="rating" name=<?php echo "rating".$index?>  value="<?php echo $propertydetails['Rating'];?>"/>
          </td>




    				<td align="left">
              <input type="hidden" name= "index" value ="<?php echo $index?>">
    					<input class="inputStyleSubmit" type="submit" value="Update" name="update" />
    	      </td>
    </tr>
				</form>

        <?php $index++;?>
				<?php endforeach; ?>
				</table>



<!--</form>-->

  </body>
</html>
