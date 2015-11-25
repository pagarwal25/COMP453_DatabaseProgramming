<?php
include 'dbRequests.php';
$sql = "select apartment.ApartmentID, apartment.LeasePeriod, apartment.Price, property.PropertyName, propertytype.TypeName
									FROM apartment, property, propertytype
									WHERE apartment.TypeID=propertytype.TypeID and 
									property.PropertyID=apartment.PropertyID";

//   Alternate
//
// "select apartment.ApartmentID, apartment.LeasePeriod, apartment.Price, property.PropertyName, propertytype.TypeName
// FROM apartment INNER JOIN property
// ON apartment.PropertyID=property.PropertyID
// INNER JOIN propertytype
// on apartment.TypeID=propertytype.TypeID"

$result = executeQuery($sql);

if (isset($_GET['delete']))
{
  $aptID = $_POST['apt_id'];
  $sql = "DELETE FROM apartment WHERE ApartmentID = '$aptID'"; // is coming from input type name="id"
  $delete_apartment = executeQuery($sql);
  //$s->bindValue(':apt_id', $_POST['apt_id']);
}
?>

<html>
<head>
<title>List of Apartments to delete</title>
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
        <th>ApartmentID</th>
        <th>PropertyName</th>
        <th>Price</th>
        <th>Lease Period</th>
        <th>Type</th>
      </tr>
      <?php foreach ($result as $apartment):
      ?>

        <tr>
        <td> <?php echo $apartment['ApartmentID']; ?> </td>
        <td style= "width:150px"> <?php echo $apartment['PropertyName']; ?> </td>
          <td> <?php echo $apartment['Price']; ?> </td>
           <td> <?php echo $apartment['LeasePeriod']; ?> </td>
           <td> <?php echo $apartment['TypeName']; ?> </td>

           <td>
           <form action="?delete" method="post">
            <input type="hidden" name="apt_id" value="<?php echo $apartment['ApartmentID']; ?>">
           <input class="inputStyleSubmit" input type="submit" value="Delete">
          </form>
        </td>
        </tr>
      <?php endforeach;
      ?>

    </table>
    </body>
