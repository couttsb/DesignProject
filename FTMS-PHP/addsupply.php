<?php
require_once 'Controller/Controller.php';

session_start();

$c = new Controller();
try {
	$c->createSupply($_POST['supply_name'], $_POST['supply_quantity']);
	$_SESSION["errorSupplyName"] = "";
	$_SESSION["errorSupplyQuantity"] = "";
} catch (Exception $e) {
	$_SESSION["errorSupplyName"] = $e->getMessage();
	$_SESSION["errorSupplyQuantity"] = $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=/Food Truck Management System/" />
	</head>
</html>