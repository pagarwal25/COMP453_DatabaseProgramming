<?php
include 'dbRequests.php';
$sql = "SELECT * FROM admin_update_history";
$result = executeQuery($sql);
$sql1 = "SELECT * FROM admin_update_history_property";
$result1 = executeQuery($sql1);
?>
<html>
<head>
<title>Admin History </title>
<style>
table, th, td
 {
   border: 1px solid black;
   border-collapse: collapse;
 }
 th, td
 {
   padding: 15px;
 }


</style>
</head>
<h1>Updated Apartments</h1>
<body>

    <table style="width:50%">
      <tr>
        <th>ID</th>
        <th>Apartment_ID</th>
        <th>Lease Period</th>
        <th>Price</th>
        <th>Updated_Date</th>
        <th>Action</th>
      </tr>

      <?php foreach ($result as $trigr):
      ?>
        <tr>
          <td> <?php echo $trigr['id']; ?> </td>
           <td> <?php echo $trigr['apt_id']; ?> </td>
           <td> <?php echo $trigr['lease']; ?> </td>
           <td> <?php echo $trigr['price']; ?> </td>
           <td> <?php echo $trigr['updated_date']; ?> </td>
           <td> <?php echo $trigr['action']; ?> </td>

         </form>
        </td>
        </tr>
      <?php endforeach;
      ?>

    </table>

<h2>Updated Properties</h2>
    <table style="width:50%">
      <tr>
        <th>ID</th>
        <th>PropertyID</th>
        <th>Property Name</th>
        <th>Address</th>
        <th>Phone No</th>
        <th>Rating</th>
        <th>Updated Date</th>
        <th>Action</th>
      </tr>

      <?php foreach ($result1 as $trigr1):
      ?>
        <tr>
          <td> <?php echo $trigr1['id']; ?> </td>
           <td> <?php echo $trigr1['property_id']; ?> </td>
           <td> <?php echo $trigr1['property_name']; ?> </td>
           <td> <?php echo $trigr1['address']; ?> </td>
           <td> <?php echo $trigr1['phone_no']; ?> </td>
           <td> <?php echo $trigr1['rating']; ?> </td>
           <td> <?php echo $trigr1['updated_date']; ?> </td>
           <td> <?php echo $trigr1['action']; ?> </td>

         </form>
        </td>
        </tr>
      <?php endforeach;
      ?>

    </table>


    </body>
