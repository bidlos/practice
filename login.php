<?php
session_start();
require_once 'function/function.php';

$arr = [
	'login' => $_POST['login'],
	'pass' => $_POST['pass'],
];

print_r($LoginClass->login($arr));
header('location: index.php', "Refresh:0");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

</body>
</html>