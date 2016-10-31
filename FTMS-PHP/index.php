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
		require_once "Persistence/PersistenceScheduleManagerFTMS.php";
		require_once "Persistence/PersistenceMenuFTMS.php";
		
		session_start();
		
		// Retreive the data from the model
		$pm = new PersistenceScheduleManagerFTMS();
		$sm = $pm->loadDataFromStore();
		$pm2 = new PersistenceMenuFTMS();
		$mm = $pm2->loadDataFromStore();
		
		// This code places an order of desired menu items if possible with current supplies
		echo "<form action='order.php' method='post'>";
		echo "<p>Order? <select name='orderspinner'>";
		foreach ($mm->getMenuItems() as $MenuItem) {
			echo "<option>" . $MenuItem->getName() . "</option>";
		}
		echo "</select><span class='error'>";
		if (isset($_SESSION['errorOrder']) && !empty($_SESSION['errorOrder'])) {
			echo " * " . $_SESSION["errorOrder"];
		} if (isset($_SESSION['errorInsufficientSupplies']) && !empty($_SESSION['errorInsufficientSupplies'])) {
			echo " * " . $_SESSION["errorInsufficientSupplies"];
		}
		echo "</span></p>";
		echo "<p><input type='submit' value='Order' /></p>";
		echo "</form>";
		
		// This code creates supplies necessary for a previously added menu item
		echo "<form action='addsupplytomenuitem.php' method='post'>";
		echo "<p>Menu Item? <select name='menuitemspinner'>";
		foreach ($mm->getMenuItems() as $MenuItem) {
			echo "<option>" . $MenuItem->getName() . "</option>";
		}
		echo "</select><span class='error'>";
		if (isset($_SESSION['errorMenuItemBlank']) && !empty($_SESSION['errorMenuItemBlank'])) {
			echo " * " . $_SESSION["errorMenuItemBlank"];
		} echo "</span></p>";
		echo "<p>Supplies? <select name='supplyspinner'>";
		foreach ($mm->getSupplies() as $Supply) {
			echo "<option>" . $Supply->getName() . "</option>";
		}
		echo "</select><span class='error'>";		
		if (isset($_SESSION['errorSuppliesBlank']) && !empty($_SESSION['errorSuppliesBlank'])) {
			echo " * " . $_SESSION["errorSuppliesBlank"];
		} echo "</span></p>";
		echo "<p><input type='submit' value='Add Supplies to Menu Item' /></p>";
		echo "</form>";
		?>
		
		
		<form action="addstaff.php" method="post">
			<p>Staff Name? <input type="text" name="staff_name" /><span class="error">
			<?php echo "</select><span class='error'>";
						if (isset($_SESSION['errorStaffName']) && !empty($_SESSION['errorStaffName'])) {
							echo " * " . $_SESSION["errorStaffName"]; 
						} echo "</span></p>";?></span></p> 
						
			<p>Staff Role?</p>
			<p><input type="radio" name="staff_role" value="Cook"> Cook<br>
			<input type="radio" name="staff_role" value="Cashier"> Cashier<span class ="error">
				<?php echo "</select><span class='error'>";
						if (isset($_SESSION['errorStaffRole']) && !empty($_SESSION['errorStaffRole'])) {
							echo " * " . $_SESSION["errorStaffRole"];
						} echo "</span></p>";?></span></p>
				
			<p><input type="submit" value="Add Staff" /></p>
		</form>
		
		
		<form action="addequipment.php" method="post">
			<p>Equipment Name? <input type="text" name="equipment_name" /><span class="error">
			<?php echo "</select><span class='error'>";
						if (isset($_SESSION['errorEquipmentName']) && !empty($_SESSION['errorEquipmentName'])) {
							echo " * " . $_SESSION["errorEquipmentName"]; 
						} echo "</span></p>";?></span></p> 
						
			<p>Equipment Quantity? <input type="number" name="equipment_quantity" min="0" /><span class ="error">
				<?php echo "</select><span class='error'>";
						if (isset($_SESSION['errorEquipmentQuantity']) && !empty($_SESSION['errorEquipmentQuantity'])) {
							echo " * " . $_SESSION["errorEquipmentQuantity"];
						} echo "</span></p>";?></span></p>
				
			<p><input type="submit" value="Add Equipment" /></p>
		</form>
		
		
		<form action="addsupply.php" method="post">
			<p>Supply Name? <input type="text" name="supply_name" /><span class="error">
				<?php echo "</select><span class='error'>";
					if (isset($_SESSION['errorSupplyName']) && !empty($_SESSION['errorSupplyName'])) {
						echo " * " . $_SESSION["errorSupplyName"]; 
					} echo "</span></p>";?></span></p>
			<p>Supply Quantity? <input type="number" name="supply_quantity" min="0" /><span class="error">
				<?php echo "</select><span class='error'>";
					if (isset($_SESSION['errorSupplyQuantity']) && !empty($_SESSION['errorSupplyQuantity'])) {
						echo " * " . $_SESSION["errorSupplyQuantity"];
					} echo "</span></p>";?></span></p>
			<p><input type="submit" value="Add Supply" /></p>
		</form>
		
		
		<form action="addmenuitem.php" method="post">
			<p>Menu Item Name? <input type="text" name="item_name" /><span class="error">
			<?php echo "</select><span class='error'>";
				if (isset($_SESSION['errorItemName']) && !empty($_SESSION['errorItemName'])) {
					echo " * " . $_SESSION["errorItemName"]; 
				} echo "</span></p>";?></span></p>
			<p>Menu Item Popularity (if known)? <input type="number" name="item_popularity" min="0" /></p>
			<p>Menu Item Price? <input type="number" name="item_price" min="0" step="0.01" /><span class="error">
			<?php echo "</select><span class='error'>";
				if (isset($_SESSION['errorItemPrice']) && !empty($_SESSION['errorItemPrice'])) {
					echo " * " . $_SESSION["errorItemPrice"]; 
				} echo "</span></p>";?></span></p>
			<p><input type="submit" value="Add Menu Item" /></p>
		</form>
	</body>
</html>