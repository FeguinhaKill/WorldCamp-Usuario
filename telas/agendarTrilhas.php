<?php
session_start();
include '../header.php';
include '../db.class.php';
$db = new db();

$db->checkLogin();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Trilhas - WorldCamp</title>
</head>
<body>
    
</body>
</html>


<?php
include '../footer.php';
?>