<?php




 include 'dbRequests.php';
 if(isset($_POST['submit']))
 {
 	//if we hit submit button, store the entered val in some variables
 	$agentid = $_POST["AgentID"];
 	$apartmentid = $_POST["ApartmentID"];
 	$addedon = $_POST["AddedOn"];
  $status = $_POST["Status"];

 	$sql = "INSERT INTO listing(AgentID, ApartmentID, AddedOn, Status) VALUES($agentid,'$apartmentid','$addedon','$status')";
  $insert_listing = executeQuery($sql);
 }
 $sql_AgentName = "select agentdetails.AgentID,agentdetails.AgentLastName,agentdetails.AgentFirstName from agentdetails";

 $result = executeQuery($sql_AgentName);

 while ($row = $result->fetch())
 {
 	$agentidlist[$row["AgentID"]] = $row['AgentFirstName'].' '.$row['AgentLastName'];
 }

 $sql = "select ApartmentID from apartment";

 $result = executeQuery($sql);

 while ($row = $result->fetch())
 {
  //echo $row['ApartmentID'];
 	$apartmentidlist[] = $row['ApartmentID'];
 }

 ?>
 <html>
 <head>
 <link rel="stylesheet" type="text/css" href="css/style_madhura.css">
 </head>
 <body>
 <form action="new_listing.php" method="POST">
 <h3 >Form to add new listing</h3>
 <div class="center">
 	<table>
    <tr>
      <td>
        <label for="AgentID">Add Agent:</label>
        <td>
          <select name="AgentID" style="width:200px">
          <option value="select">--Select--</option>
          <?php foreach($agentidlist as $aID => $aName): ?>
          <option value="<?php echo $aID;?>"><?php echo $aName;?></option>
          <?php endforeach; ?>
          </select>
        </td>
      </td>
    </tr>
    <br/>

    <tr>
      <td>
        <label for="ApartmentID">Select Apartment:</label>
        <td>
          <select name="ApartmentID" style="width:200px">
          <option value="select">--Select--</option>
          <?php foreach($apartmentidlist as $apartmentid): ?>
          <option value="<?php echo $apartmentid;?>"><?php echo $apartmentid;?></option>
          <?php endforeach; ?>
          </select>
        </td>
      </td>
    </tr>
    <br/>


    <!--</td></tr>-->
    <tr><td>Added On:<td><input type="date" name="AddedOn"></td></td></tr>
    <tr><td>Status:<td><input type="text" name="Status" value="Active"></td></td></tr>


    </td></tr>
    <tr><td>  <input class="inputStyleSubmit" input type="submit" value="Submit" name="submit"></td></tr>
    </div>
 </table>
 </form>
 </body>
 </html>
