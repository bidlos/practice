<?php
session_start();
require_once 'function/function.php';

$arr = [
	'title' => $_POST['title'],
	'desc' => $_POST['desc'],
	'date' => $_POST['date'],
];

if (isset($_POST['submit'])) {
	$connectDatabaase->insert_ticket($arr);
}

if (isset($_POST['delete'])) {
	$connectDatabaase->delete_ticket($_POST['delete']);
}
if (isset($_POST['important'])) {
	$connectDatabaase->change_ticket_status($_POST['status-ticket'], $_POST['important']);
}
header('location: index.php', "Refresh:0");
?>