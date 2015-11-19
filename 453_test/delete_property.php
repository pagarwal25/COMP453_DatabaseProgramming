<?php
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
  $sql = 'SELECT * FROM apartment';
  $result = $pdo->query($sql);

}
catch (PDOException $e)
{
  $error = 'Error fetching property: ' . $e->getMessage();
  include 'error.html.php';
  exit();
}



if (isset($_GET['delete']))
{
	
	$aptID = $_POST['apt_id'];
	
  try
  {
    $sql = "DELETE FROM apartment WHERE ApartmentID = '$aptID'";// is is coming from input type name="id"
    $s = $pdo->prepare($sql);
    //$s->bindValue(':apt_id', $_POST['apt_id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error deleting Apartment: ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }


}

?>

<html>
<head>
<title>List of Apartments to delete</title>
<style>
table,th,td
{
border:1px solid black;
padding:5px;
}
</style>
</head>
<body>

    <table >
      <?php foreach ($result as $apartment):
      ?>
        <tr>
        <td> <?php echo $apartment['ApartmentID']; ?> </td>
        <td style= "width:150px"> <?php echo $apartment['PropertyID']; ?> </td>
          <td> <?php echo $apartment['Price']; ?> </td>
           <td> <?php echo $apartment['LeasePeriod']; ?> </td>
           <td> <?php echo $apartment['TypeID']; ?> </td>

           <td>
           <form action="?delete" method="post">
            <input type="hidden" name="apt_id" value="<?php echo $apartment['ApartmentID']; ?>">
           <input type="submit" value="delete">
          </form>
        </td>
        </tr>
      <?php endforeach;
      ?>

    </table>
    </body>
  </html>