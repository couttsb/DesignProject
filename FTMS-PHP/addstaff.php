<?php
require_once 'Controller/Controller.php';

session_start();

$_SESSION["errorStaffRole"] = "";
$_SESSION["errorStaffName"] = "";
$c = new Controller();

try {
	$staff_role = NULL;
	if (isset($_POST['staff_role'])) {
		$staff_role = Inputvalidator::validate_input($_POST['staff_role']);
	}
	$staff_name = NULL;
	if (isset($_POST['staff_name'])) {
		$staff_name = $_POST['staff_name'];
	}
	$c->createStaff($staff_role, $staff_name);

} catch (Exception $e) {
	$errors = explode("@", $e->getMessage());
	foreach ($errors as $error) {
		if (substr($error, 0, 1) == "1") {
			$_SESSION["errorStaffRole"] = substr($error, 1);
		} if (substr($error, 0, 1) == "2") {
			$_SESSION["errorStaffName"] = substr($error, 1);
		}
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0; url=/FTMS-PHP/" />
	</head>
</html>