<?php
require_once 'Controller/Controller.php';

session_start();

$c = new Controller();
try {
	$c->createEquipment($_POST['equipment_name'], $_POST['equipment_quantity']);
	$_SESSION["errorEquipmentName"] = "";
	$_SESSION["errorEquipmentQuantity"] = "";
} catch (Exception $e) {
	$_SESSION["errorEquipmentName"] = $e->getMessage();
	$_SESSION["errorEquipmentQuantity"] = $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=/Food Truck Management System/" />
	</head>
</html>