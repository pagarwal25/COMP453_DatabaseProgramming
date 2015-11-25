<?php

function connectToDB()
{
  try
  {
    $pdo = new PDO('mysql:host=localhost;dbname=cozy_homes', 'pagarwal', 'pa251188');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
    return $pdo;
  }
  catch (PDOException $e)
  {
  $error = 'Unable to connect to the database server.';
  include 'error.html.php';
  exit();
  }
}
function executeQuery($sql)
{
  $pdo = connectToDB();
  try
  {
    $result = $pdo->query($sql);
    return $result;
  }
  catch (PDOException $e)
  {
    echo $e->getMessage();
    //$error = 'Unable to update to the database server.';
    //include 'error.html.php';
    exit();
  }
}
?>
