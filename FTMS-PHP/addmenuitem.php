<?php
require_once 'Controller/Controller.php';

session_start();

$c = new Controller();
try {
	$c->createMenuItem($_POST['menuitem_name'], $_POST['menuitem_popularity'], $_POST['menuitem_price']);
	$_SESSION["errorMenuItemName"] = "";
	$_SESSION["errorMenuItemPopularity"] = "";
	$_SESSION["errorMenuItemPrice"] = "";
} catch (Exception $e) {
	$_SESSION["errorMenuItemName"] = $e->getMessage();
	$_SESSION["errorMenuItemPopularity"] = $e->getMessage();
	$_SESSION["errorMenuItemPrice"] = $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=/Food Truck Management System/" />
	</head>
</html>