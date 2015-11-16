<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>List of Departments</title>
<style>
table,th,td
{
border:1px solid black;
padding:5px;
}
</style>
</head>
<body>

    <h3>List of all the options:</h3>
   
    <table >
    <?php foreach($result as $Apartment): ?>
      <tr>
      <td> <?php echo $Apartment['ApartmentID']; ?> </td>
       <td style= "width:150px"> <?php echo $Apartment['PropertyID']; ?> </td>
        <td> <?php echo $Apartment['Price']; ?> </td>
         <td> <?php echo $Apartment['LeasePeriod']; ?> </td>
		 <td> <?php echo $Apartment['TypeID']; ?> </td>
         <!-- <td>  
         <form action="?deleteDept" method="post">
          <input type="hidden" name="id" value="<?php echo $department['dnumber']; ?>">
         <input type="submit" value="delete">
        </form>
      </td>  -->
      </tr>
    <?php endforeach; ?>
    </table>
   
  </body>
</html>
