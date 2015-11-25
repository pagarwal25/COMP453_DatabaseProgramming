
<?php
include 'dbRequests.php';

$sql = "SELECT TotalUsers from usercount";
$Users_Count = executeQuery($sql);
$usercount = $Users_Count->fetch();

while ($row = $Users_Count->fetch())
 {
 	$usercount[] = $row['TotalUsers'];
 }

?>
<html>
<body>
<center>
This Application is currently used by <font size="6"><?php echo $usercount['TotalUsers']; ?></font> users.
</center>

</body>
</html>