<?php
include 'dbRequests.php';

if (isset($_GET['delete']))
{
  $prop_id = $_POST['prop_id'];
  $sql = "DELETE FROM property WHERE PropertyID = '$prop_id'"; // is coming from input type name="id"
  $delete_property = executeQuery($sql);

}
$sql = "select * from property";

$result = executeQuery($sql);

?>

<html>
<head>
<title>List of Properties to delete</title>
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
      height:auto;
      width: 140px;

}
</style>
</head>
<body>

    <table style="width:50%">
      <tr>
        <th>PropertyName</th>
        <th>Address</th>
        <th>ZipCode</th>
        <th>PhoneNo</th>

      </tr>
      <?php foreach ($result as $property):
      ?>

        <tr>

        <td style= "width:150px"> <?php echo $property['PropertyName']; ?> </td>
          <td> <?php echo $property['Address']; ?> </td>
           <td> <?php echo $property['ZipCode']; ?> </td>
           <td> <?php echo $property['PhoneNo']; ?> </td>

           <td>
           <form action="?delete" method="post">
            <input type="hidden" name="prop_id" value="<?php echo $property['PropertyID']; ?>">
           <input class="inputStyleSubmit" input type="submit" value="Delete">
          </form>
        </td>
        </tr>
      <?php endforeach;
      ?>

    </table>
    </body>
