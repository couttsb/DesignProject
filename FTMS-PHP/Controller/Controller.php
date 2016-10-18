<?php
require_once 'C:\Users\Brent\ECSE321-DesignProject\FTMS-PHP\Controller\InputValidator.php';
require_once 'C:\Users\Brent\ECSE321-DesignProject\FTMS-PHP\Persistence\PersistenceFTMS.php';
require_once 'C:\Users\Brent\ECSE321-DesignProject\FTMS-PHP\Model\Equipment.php';
require_once 'C:\Users\Brent\ECSE321-DesignProject\FTMS-PHP\Model\Menu.php';
require_once 'C:\Users\Brent\ECSE321-DesignProject\FTMS-PHP\Model\MenuItem.php';
require_once 'C:\Users\Brent\ECSE321-DesignProject\FTMS-PHP\Model\Order.php';
require_once 'C:\Users\Brent\ECSE321-DesignProject\FTMS-PHP\Model\Schedule.php';
require_once 'C:\Users\Brent\ECSE321-DesignProject\FTMS-PHP\Model\ScheduleManager.php';
require_once 'C:\Users\Brent\ECSE321-DesignProject\FTMS-PHP\Model\Staff.php';
require_once 'C:\Users\Brent\ECSE321-DesignProject\FTMS-PHP\Model\Supply.php';

class Controller {
	private $filename;
	public function __construct($filename = 'data.txt') {
		chmod('data.txt', 0644);
		$this->filename = $filename;
	}
	
	public function createEquipment($equipment_name, $equipment_quantity) {
		// 1. Validate input
		$name = InputValidator::validate_input($equipment_name, $equipment_quantity);
		$error = "";
			if ($name == null || strlen($name) == 0) {
				$error .= "@1Equipment name cannot be empty! ";
			} if ($equipment_quantity == null || trim($equipment_quantity) == "") {
				$error .= "@2Equipment quantity cannot be empty! ";
			} if ($equipment_quantity % 1 != 0) {
				$error .= "@3Equipment quantity must be an integer! ";
			} if (trim($error) > 0) {
				throw new Exception(trim($error));
			} else {
				// 2. Load all of the data including equipment name and number. 
				$pm = new PersistenceFTMS();
				$m = $pm->loadDataFromStore();
				
				$aName = NULL;
				foreach ($m->getEquipment() as $equipment) {
					if (strcmp($equipment->getName(), $aName) == 0) {
						$aName = $equipment;
						break;
					}
				}
				
				$aQuantity = NULL;
				foreach ($m->getEquipment() as $equipment) {
					if (strcmp($equipment->getQuantity(), $aQuantity) == 0) {
						$aQuantity = $equipment;
						break;
					}
				}
				
				// 3. Add the new equipment
				$aEquipment = new Equipment($aName, $aQuantity);
				$m->addEquipment($aEquipment);
				
				// 4. Write all of the data
				$pm->writeDataToStore($m);
			}
	}
	
	public function createSupply ($supply_name, $supply_quantity) {
		// 1. Validate input
		$name = InputValidator::validate_input($supply_name, $supply_quantity);
		$error = "";
		if ($name == null || strlen($name) == 0) {
			$error .= "@1Supply name cannot be empty! ";
		} if ($supply_quantity == null || trim($supply_quantity) == "") {
			$error .= "@2Supply quantity cannot be empty! ";
		} if ($supply_quantity % 1 != 0) {
			$error .= "@3Supply quantity must be an integer! ";
		} if (trim($error) > 0) {
			throw new Exception(trim($error));
		} else {
			// 2. Load all of the data including equipment name and number.
			$pm = new PersistenceFTMS();
			$m = $pm->loadDataFromStore();
	
			$aName = NULL;
			foreach ($m->getSupplies() as $supply) {
				if (strcmp($supply->getName(), $aName) == 0) {
					$aName = $supply;
					break;
				}
			}
	
			$aQuantity = NULL;
			foreach ($m->getSupplies() as $supply) {
				if (strcmp($supply->getQuantity(), $aQuantity) == 0) {
					$aQuantity = $supply;
					break;
				}
			}
	
			// 3. Add the new supply
			$aSupply = new Supply($aName, $aQuantity);
			$m->addSupply($aSupply);
	
			// 4. Write all of the data
			$pm->writeDataToStore($m);
		}
	}
	
	public function createMenuItem ($menuitem_name, $menuitem_popularity, $menuitem_price) {
		// 1. Validate input
		$name = InputValidator::validate_input($menuitem_name, $menuitem_popularity, $menuitem_price);
		$error = "";
		if ($name == null || strlen($name) == 0) {
			$error .= "@1Menu item name cannot be empty! ";
		} if ($menuitem_price == null || trim($menuitem_price) == "" ) {
			$error .= "@2Menu item price cannot be empty! ";
		} if (trim($error) > 0) {
			throw new Exception(trim($error));
		} else {
			// 2. Load all of the data including equipment name and number.
			$pm = new PersistenceFTMS();
			$m = $pm->loadDataFromStore();
		
			$aName = NULL;
			foreach ($m->getItem() as $menuitem) {
				if (strcmp($menuitem->getName(), $aName) == 0) {
					$aName = $menuitem;
					break;
				}
			}
		
			$aPrice = NULL;
			foreach ($m->getItem() as $menuitem) {
				if (strcmp($menuitem->getPrice(), $aPrice) == 0) {
					$aPrice = $menuitem;
					break;
				}
			}
			
			$aPopularity = 0;
		
			// 3. Add the new menu item 
			$aMenuItem = new MenuItem($aName, $aPopularity, $aPrice);
			$m->addMenuItem($aMenuItem);
		
			// 4. Write all of the data
			$pm->writeDataToStore($m);
		}
	}
	
	public function createStaff($staff_name, $staff_role, $staff_availability) {
		// 1. Validate input
		$name = InputValidator::validate_input($staff_name);
		if ($name == null || strlen($name) == 0) {
			throw new Exception("Staff name cannot be empty!");
		} else {
			// 2. Load all of the data
			$pm = new PersistenceEventRegistration();
			$m = $pm->loadDataFromStore();
	
			// 3. Add the new participant
			$staff = new Staff($name);
			$m->addStaff($staff);
	
			// 4. Write all of the data
			$pm->writeDataToStore($m);
		}
	}
	
	public function createSchedule($schedule_name) {
		// 1. Validate input
		$name = InputValidator::validate_input($schedule_name);
		if ($name == null || strlen($name) == 0) {
			throw new Exception("Schedule name cannot be empty!");
		} else {
			// 2. Load all of the data
			$pm = new PersistenceFTMS();
			$m = $pm->loadDataFromStore();
	
			// 3. Add the new schedule
			$schedule = new Schedule($name);
			$m->addSchedule($schedule);
	
			// 4. Write all of the data
			$m->writeDatatoStore($m);
		}
	}
	
	public function createOrder ($order_name) {
		
	}
}
?>