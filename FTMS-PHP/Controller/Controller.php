<?php
require_once 'C:\xampp\htdocs\FTMS-PHP\Controller\InputValidator.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Persistence\PersistenceScheduleManagerFTMS.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Persistence\PersistenceMenuFTMS.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Model\Equipment.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Model\Menu.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Model\MenuItem.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Model\Order.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Model\Schedule.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Model\ScheduleManager.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Model\Staff.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Model\Supply.php';

class Controller {
	private $filename;
	public function __construct($filename = 'data.txt') {
		$this->filename = $filename;
	}
	
	
	public function createEquipment($aName, $aQuantity) {
		// 1. Validate input
		$equipment = new Equipment($aName, $aQuantity);
		
		// 2. Load all of the data 
		$pm = new PersistenceScheduleManagerFTMS();
		$sm = $pm->loadDataFromStore();
		
		$myname = NULL;
		if (strcmp($equipment->getName(), $aName) == 0) {
			$myname = InputValidator::validate_input($aName);
		}
		$myquantity = NULL;
		if (strcmp($equipment->getQuantity(), $aQuantity) == 0) {
			$myquantity = $aQuantity;
		}
		
		// 3. Add the new equipment
		if ($myname != null && $myquantity != null) {
			$myequipment = new Equipment($myname, $myquantity);
			$sm->addEquipment($myequipment);
			
			// 4. Write all of the data
			$pm->writeDataToStore($sm);
		} else {
			$error = "";
			 if ($myname == null || strlen($myname) == 0) {
				$error .= "@1Equipment name cannot be empty! ";
			} if ($myquantity == null || trim($myquantity) == "") {
				$error .= "@2Equipment quantity cannot be empty!";
			} throw new Exception(trim($error));
		}
	}
	
	
	public function createSupply($aName, $aQuantity) {
		// 1. Validate input
		$supply = new Supply($aName, $aQuantity);
	
		// 2. Load all of the data
		$pm2 = new PersistenceMenuFTMS();
		$mm = $pm2->loadDataFromStore();
	
		$myname = NULL;
		if (strcmp($supply->getName(), $aName) == 0) {
			$myname = InputValidator::validate_input($aName);
		}
		$myquantity = NULL;
		if (strcmp($supply->getQuantity(), $aQuantity) == 0) {
			$myquantity = $aQuantity;
		}
	
		// 3. Add the new supply
		if ($myname != null && $myquantity != null) {
			$mysupply = new Supply($myname, $myquantity);
			$mm->addSupply($mysupply);
				
			// 4. Write all of the data
			$pm2->writeDataToStore($mm);
		} else {
			$error = "";
			if ($myname == null || strlen($myname) == 0) {
				$error .= "@1Supply name cannot be empty! ";
			} if ($myquantity == null || trim($myquantity) == "") {
				$error .= "@2Supply quantity cannot be empty!";
			} throw new Exception(trim($error));
		}
	}
	
	
	public function createItem($aName, $aPopularity, $aPrice) {
		// 1. Validate input
		$item = new MenuItem($aName, $aPopularity, $aPrice);
	
		// 2. Load all of the data
		$pm2 = new PersistenceMenuFTMS();
		$mm = $pm2->loadDataFromStore();
	
		$myname = NULL;
		if (strcmp($item->getName(), $aName) == 0) {
			$myname = InputValidator::validate_input($aName);
		}
		$mypopularity = NULL;
		if (strcmp($item->getPopularity(), $aPopularity) == 0) {
			$mypopularity = $aPopularity;
		} else {
			$mypopularity = 0;
		}
		$myprice = NULL;
		if (strcmp($item->getPrice(), $aPrice) == 0) {
			$myprice = $aPrice;
		}
	
		// 3. Add the new item
		if ($myname != null && $mypopularity != null && $myprice != null) {
			$myitem = new MenuItem($myname, $mypopularity, $myprice);
			$mm->addMenuItem($myitem);
	
			// 4. Write all of the data
			$pm2->writeDataToStore($mm);
		} else {
			$error = "";
			if ($myname == null || strlen($myname) == 0) {
				$error .= "@1Menu item name cannot be empty! ";
			} if ($myprice == null || trim($myprice) == "") {
				$error .= "@2Menu item price cannot be empty!";
			} throw new Exception(trim($error));
		}
	}
	
	
	public function createStaff($aRole, $aName) {
		// 1. Validate input
		$staff = new Staff($aRole, $aName);
	
		// 2. Load all of the data
		$pm = new PersistenceScheduleManagerFTMS();
		$sm = $pm->loadDataFromStore();
	
		$myrole = NULL;
		if (strcmp($staff->getRole(), $aRole) == 0) {
			$myrole = $aRole;
		}
		$myname = NULL;
		if (strcmp($staff->getName(), $aName) == 0) {
			$myname = $aName;
		}
	
		// 3. Add the new staff
//////////////////////////////////////////CHANGED if() statement!!! ///////////////////////////////////////
		if ($myrole != null && $myname != null && trim($myrole) != "" && trim($myname) != "") {
			$mystaff = new Staff($myrole, $myname);
			$sm->addStaff($mystaff);
	
			// 4. Write all of the data
			$pm->writeDataToStore($sm);
		} else {
			$error = "";
/////////////////////////changed from trim($myname) == 0 to strlen($myname) == "" //////////////////////////
			if ($myrole == null || trim($myrole) == "") {
				$error .= "@1Staff role cannot be empty! ";
			} if ($myname == null || trim($myname) == "") {
				$error .= "@2Staff name cannot be empty!";
			} throw new Exception(trim($error));
		}
	}
	
	
	public function createSuppliesToMenuItem ($aItem, $aSupplies) {
		// 1. Load all of the data
		$pm2 = new PersistenceMenuFTMS();
		$mm = $pm2->loadDataFromStore();
	
		// 2. Find the menu item name and supplies
		$myitem = NULL;
		foreach ($mm->getMenuItems() as $MenuItem) {
			if (strcmp($MenuItem->getName(), $aItem) == 0) {
				$myitem = $MenuItem;
				break;
			}
		}
		$mysupplies = NULL;
		foreach ($mm->getSupplies() as $Supplies) {
			if (strcmp($Supplies->getName(), $aSupplies) == 0) {
				$mysupplies = $Supplies;
				break;
			}
		}
	
		// 3. Add the supplies to the corresponding menu item
		$error = "";
		if ($myitem != NULL && $mysupplies != NULL) {
			foreach ($mm->getMenuItems() as $MenuItem) {
				$MenuItem->addsupply($mysupplies);
			}
		}
	}
	
	
	public function createOrder ($aName) {
		// 1. Load all of the data
		$pm2 = new PersistenceMenuFTMS();
		$mm = $pm2->loadDataFromStore();
	
		// 2. Find the menu item names, popularities, and supplies
		$myitem = NULL;
		foreach ($mm->getMenuItems() as $menuitem) {
			$myitem = $menuitem;
		}
		if ($myitem != null) {
			foreach ( $myitem->getPopularity () as $popularity ) {
				$mypopularity = $popularity + 1;
				$myitem->setPopularity ( $mypopularity );
			}
			foreach ( $myitem->getSupplies () as $supplies ) {
				$mysupplies = $supplies;
				$mymenu->removeSupply ( $supplies );
			}
		}
	
		// 3. Order the desired menu item
		$error = "";
		if ($myitem != NULL && $mypopularity != NULL && $mysupplies != NULL) {
			$myorder = new Order($myitem);
			$mm->addOrder($myorder);
			$pm2->writeDataToStore($mm);
		} else {
			if ($myitem == null || strlen($myitem) == 0) {
				throw new Exception("@1Order item cannot be empty! ");
			}
			if ($mysupplies == 0) {
				throw new Exception("@2Order item cannot be made due to lack of supplies!");
			}
		}
	}
}
?>