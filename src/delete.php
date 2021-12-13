<?php

$connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error($connection));

$deleteID = $_GET['id'];
$table = $_GET['table'];

$fetching_employeeID = mysqli_query($connection, "DELETE FROM `$table` WHERE `id` = '$deleteID'");
header("Location: $table.php");

?>