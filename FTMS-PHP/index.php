<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Food Truck Management System</title>
		<style>
			.error {color: #FF0000;} 
		</style>
	</head>
	<body>		
		<?php 
		require_once "Model/Equipment.php";
		require_once "Model/Schedule.php";
		require_once "Model/Staff.php";
		require_once "Model/MenuItem.php";
		require_once "Model/Supply.php";
		require_once "Model/Order.php";
		require_once "Model/ScheduleManager.php";
		require_once "Model/Menu.php";
		require_once "Persistence/PersistenceFTMS.php";
		
		session_start();
		
		// Retreive the data from the model
		$pm = new PersistenceFTMS();
		$m = $pm->loadDataFromStore();
		
		

		?>
		
		<form action="addequipment.php" method="post">
			<p>Equipment Name? <input type="text" name="equipment_name" /><span class="error">
			<?php 
			if (isset($_SESSION['errorEquipmentName']) && !empty($_SESSION['errorEquipmentName'])) {
				echo " * " . $_SESSION["errorEquipmentName"]; 
			} if (isset($_SESSION['errorEquipmentQuantity']) && !empty($_SESSION['errorEquipmentQuantity'])) {
				echo " * " . $_SESSION["errorEquipmentQuantity"];
			}
			?>
			</span></p>
		<p>Equipment Quantity? <input type="number" name="equipment_quantity" min="0" /></p>
		<p><input type="submit" value="Add Equipment" /></p>
		</form>
		
		<form action="addsupply.php" method="post">
			<p>Supply Name? <input type="text" name="supply_name" /><span class="error">
			<?php 
			if (isset($_SESSION['errorSupplyName']) && !empty($_SESSION['errorSupplyName'])) {
				echo " * " . $_SESSION["errorSupplyName"]; 
			} if (isset($_SESSION['errorSupplyQuantity']) && !empty($_SESSION['errorSupplyQuantity'])) {
				echo " * " . $_SESSION["errorSupplyQuantity"];
			}
			?>
			</span></p>
		<p>Supply Quantity? <input type="number" name="supply_quantity" min="0" /></p>
		<p><input type="submit" value="Add Supply" /></p>
		</form>
		
		<form action="addmenuitem.php" method="post">
			<p>Menu Item Name? <input type="text" name="menuitem_name" /><span class="error">
			<?php 
			if (isset($_SESSION['errorMenuItemName']) && !empty($_SESSION['errorMenuItemName'])) {
				echo " * " . $_SESSION["errorMenuItemName"]; 
			} if (isset($_SESSION['errorMenuItemPrice']) && !empty($_SESSION['errorMenuItemPrice'])) {
				echo " * " . $_SESSION["errorMenuItemPrice"];
			}
			?>
			</span></p>
		<p>Menu Item Price? <input type="number" name="menuitem_price" min="0" step="any" /></p>
		<p><input type="submit" value="Add Menu Item" /></p>
		</form>
	</body>
</html>