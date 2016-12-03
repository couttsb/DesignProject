<?php
require_once 'C:\xampp\htdocs\FTMS-PHP\Controller\Controller.php';
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

class ControllerTest extends PHPUnit_Framework_TestCase {
	protected $c;
	protected $pm;
	protected $sm;
	protected $mm;

	
	protected function setUp() {
		$this->c = new Controller();
		
		$this->pm = new PersistenceScheduleManagerFTMS();
		$this->sm = $this->pm->loadDataFromStore();
		$this->sm->delete();
		$this->pm->writeDataToStore($this->sm);
		
		$this->pm2 = new PersistenceMenuFTMS();
		$this->mm = $this->pm2->loadDataFromStore();
		$this->mm->delete();
		$this->pm2->writeDataToStore($this->mm);
	}
	
	
	protected function tearDown() {
	}
	
	
	public function testCreateEquipment() {
		$this->assertEquals(0, count($this->sm->getEquipment()));
		
		$equipment = "Knife";
		$quantity = "1";
		
		try { 
			$this->c->createEquipment($equipment, $quantity);
		} catch (Exception $e) {
			$this->fail();
		}
		
		// Check file contents are proper 
		$this->sm = $this->pm->loadDataFromStore();
		$this->assertEquals(1, count($this->sm->getEquipment()));
		$this->assertEquals($equipment, $this->sm->getEquipment_index(0)->getName());
		$this->assertEquals(0, count($this->sm->getStaffs()));		
	}
	
	
	public function testCreateEquipmentNull() {
		$this->assertEquals(0, count($this->sm->getEquipment()));
		
		$equipment = null;
		$quantity = null;
		$error = "";
	
		try {
			$this->c->createEquipment($equipment, $quantity);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// Check the proper error messages are thrown
		$this->assertEquals("@1Equipment name cannot be empty! @2Equipment quantity cannot be empty!", $error);
		// Check file contents are proper
		$this->sm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->sm->getEquipment()));
		$this->assertEquals(0, count($this->sm->getStaffs()));
	}
	
	
	public function testCreateEquipmentEmpty() {
		$this->assertEquals(0, count($this->sm->getEquipment()));
	
		$equipment = "";
		$quantity = "";
		$error = "";
	
		try {
			$this->c->createEquipment($equipment, $quantity);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		// Check the proper error messages are thrown
		$this->assertEquals("@1Equipment name cannot be empty! @2Equipment quantity cannot be empty!", $error);
		// Check file contents are proper
		$this->sm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->sm->getEquipment()));
		$this->assertEquals(0, count($this->sm->getStaffs()));
	}
	
	
	public function testCreateEquipmentSpaces() {
		$this->assertEquals(0, count($this->sm->getEquipment()));
	
		$equipment = " ";
		$quantity = " ";
		$error = "";
	
		try {
			$this->c->createEquipment($equipment, $quantity);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// Check the proper error messages are thrown
		$this->assertEquals("@1Equipment name cannot be empty! @2Equipment quantity cannot be empty!", $error);
		// Check file contents are proper
		$this->sm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->sm->getEquipment()));
		$this->assertEquals(0, count($this->sm->getStaffs()));
	}
	
	
	public function testCreateStaff() {
		$this->assertEquals(0, count($this->sm->getStaffs()));
		
		$role = "Cook";
		$name = "George";
		
		try {
			$this->c->createStaff($role, $name);
		} catch (Exception $e){
			$this->fail();
		}
		
		// Check file contents are proper
		$this->sm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->sm->getEquipment()));
		$this->assertEquals(1, count($this->sm->getStaffs()));
		$this->assertEquals($role, $this->sm->getStaff_index(0)->getRole());
		$this->assertEquals($name, $this->sm->getStaff_index(0)->getName());
	}
	
	
	public function testCreateStaffNull() {
		$this->assertEquals(0, count($this->sm->getStaffs()));
	
		$role = null;
		$name = null;
		$error = "";
	
		try {
			$this->c->createStaff($role, $name);
		} catch (Exception $e){
			$error = $e->getMessage();
		}
		// Check the proper error messages are thrown
		$this->assertEquals("@1Staff role cannot be empty! @2Staff name cannot be empty!", $error);
		// Check file contents are proper
		$this->sm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->sm->getEquipment()));
		$this->assertEquals(0, count($this->sm->getStaffs()));
	}
	
	
	public function testCreateStaffEmpty() {
		$this->assertEquals(0, count($this->sm->getStaffs()));
	
		$role = "";
		$name = "";
		$error = "";
	
		try {
			$this->c->createStaff($role, $name);
		} catch (Exception $e){
			$error = $e->getMessage();
		}
		// Check the proper error messages are thrown
		$this->assertEquals("@1Staff role cannot be empty! @2Staff name cannot be empty!", $error);
		// Check file contents are proper
		$this->sm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->sm->getEquipment()));
		$this->assertEquals(0, count($this->sm->getStaffs()));
	}
	
	
	public function testCreateStaffSpaces() {
		$this->assertEquals(0, count($this->sm->getStaffs()));
	 
		$role = " ";
		$name = " ";
		$error = "";
	
		try {
			$this->c->createStaff($role, $name);
		} catch (Exception $e){
			$error = $e->getMessage();
		}
		// Check the proper error messages are thrown
		$this->assertEquals("@1Staff role cannot be empty! @2Staff name cannot be empty!", $error);
		// Check file contents are proper
		$this->sm = $this->pm->loadDataFromStore();
		$this->assertEquals(0, count($this->sm->getEquipment()));
		$this->assertEquals(0, count($this->sm->getStaffs()));
	}
	
	
	public function testCreateSupply() {
		$this->assertEquals(0, count($this->mm->getSupplies()));
		
		$name = "Cheese";
		$quantity = "12";
		
		try {
			$this->c->createSupply($name, $quantity);
		} catch (Exception $e) {
			$this->fail();
		}
		
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getSupplies()));
		$this->assertEquals($name, $this->mm->getSupply_index(0)->getName());
		$this->assertEquals($quantity, $this->mm->getSupply_index(0)->getQuantity());
		$this->assertEquals(0, count($this->mm->getMenuItems()));
		$this->assertEquals(0, count($this->mm->getOrders()));
	}
	
	
	public function testCreateSupplyNull() {
		$this->assertEquals(0, count($this->mm->getSupplies()));
		
		$name = null;
		$quantity = null;
		
		try {
			$this->c->createSupply($name, $quantity);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		
		// Check the proper error messages are thrown
		$this->assertEquals("@1Supply name cannot be empty! @2Supply quantity cannot be empty!", $error);
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(0, count($this->mm->getSupplies()));
		$this->assertEquals(0, count($this->mm->getMenuItems()));
		$this->assertEquals(0, count($this->mm->getOrders()));
	}
	
	
	public function testCreateSupplyEmpty() {
		$this->assertEquals(0, count($this->mm->getSupplies()));
	
		$name = "";
		$quantity = "";
	
		try {
			$this->c->createSupply($name, $quantity);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// Check the proper error messages are thrown
		$this->assertEquals("@1Supply name cannot be empty! @2Supply quantity cannot be empty!", $error);
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(0, count($this->mm->getSupplies()));
		$this->assertEquals(0, count($this->mm->getMenuItems()));
		$this->assertEquals(0, count($this->mm->getOrders()));
	}
	
	
	public function testCreateSupplySpaces() {
		$this->assertEquals(0, count($this->mm->getSupplies()));
	
		$name = " ";
		$quantity = " ";
	
		try {
			$this->c->createSupply($name, $quantity);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// Check the proper error messages are thrown
		$this->assertEquals("@1Supply name cannot be empty! @2Supply quantity cannot be empty!", $error);
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(0, count($this->mm->getSupplies()));
		$this->assertEquals(0, count($this->mm->getMenuItems()));
		$this->assertEquals(0, count($this->mm->getOrders()));
	}
	
	
	public function testCreateItem() {
		$this->assertEquals(0, count($this->mm->getSupplies()));
		
		$name = "Poutine";
		$popularity = "99";
		$price = "5.99";
		
		try {
			$this->c->createItem($name, $popularity, $price);
		} catch (Exception $e) {
			$this->fail();
		}
		
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getMenuItems()));
		$this->assertEquals($name, $this->mm->getMenuItem_index(0)->getName());
		$this->assertEquals($popularity, $this->mm->getMenuItem_index(0)->getPopularity());
		$this->assertEquals($price, $this->mm->getMenuItem_index(0)->getPrice());
		$this->assertEquals(0, count($this->mm->getSupplies()));
		$this->assertEquals(0, count($this->mm->getOrders()));
	}
		
	
	public function testCreateItemNull() {
		$this->assertEquals(0, count($this->mm->getSupplies()));
	
		$name = null;
		$popularity = null;
		$price = null;
	
		try {
			$this->c->createItem($name, $popularity, $price);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		
		// Check the proper error messages are thrown 
		$this->assertEquals("@1Menu item name cannot be empty! @2Menu item price cannot be empty!", $error);
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(0, count($this->mm->getMenuItems()));
		$this->assertEquals(0, count($this->mm->getSupplies()));
		$this->assertEquals(0, count($this->mm->getOrders()));
	}
	
	
	public function testCreateItemEmpty() {
		$this->assertEquals(0, count($this->mm->getSupplies()));
	
		$name = "";
		$popularity = "";
		$price = "";
	
		try {
			$this->c->createItem($name, $popularity, $price);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// Check the proper error messages are thrown
		$this->assertEquals("@1Menu item name cannot be empty! @2Menu item price cannot be empty!", $error);
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(0, count($this->mm->getMenuItems()));
		$this->assertEquals(0, count($this->mm->getSupplies()));
		$this->assertEquals(0, count($this->mm->getOrders()));
	}
	
	
	public function testCreateItemSpaces() {
		$this->assertEquals(0, count($this->mm->getSupplies()));
	
		$name = " ";
		$popularity = " ";
		$price = " ";
	
		try {
			$this->c->createItem($name, $popularity, $price);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	
		// Check the proper error messages are thrown
		$this->assertEquals("@1Menu item name cannot be empty! @2Menu item price cannot be empty!", $error);
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(0, count($this->mm->getMenuItems()));
		$this->assertEquals(0, count($this->mm->getSupplies()));
		$this->assertEquals(0, count($this->mm->getOrders()));
	}
	
	
	public function testOrder() {
		$this->assertEquals(0, count($this->mm->getMenuItems()));
		$this->assertEquals(0, count($this->mm->getSupplies()));
		$this->assertEquals(0, count($this->sm->getStaffs()));
		$this->assertEquals(0, count($this->mm->getOrders()));
		
		$item = "Poutine";
		
		$name = "Poutine";
		$popularity = "99";
		$price = "5.99";
		
		try {
			$this->c->createItem($name, $popularity, $price);
		} catch (Exception $e) {
			$this->fail();
		}
		
		$name2 = "Fries";
		$quantity2 = "52";
		
		$name3 = "Cheese Curds";
		$quantity3 = "30";
		
		$name4 = "Gravy";
		$quantity4 = "5";
		
		try {
			$this->c->createSupply($name2, $quantity2);
			$this->c->createSupply($name3, $quantity3);
			$this->c->createSupply($name4, $quantity4);
		} catch (Exception $e) {
			$this->fail();
		}
		
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getMenuItems()));
		$this->assertEquals(3, count($this->mm->getSupplies()));
		
		try {
			$this->c->createOrder($item);
		} catch (Exception $e) {
			$this->fail();
		}
		
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getMenuItems()));
		$this->assertEquals($item, $this->mm->getMenuItem_index(0)->getName());
		$this->assertEquals($popularity, $this->mm->getMenuItem_index(0)->getPopularity());
		$this->assertEquals($price, $this->mm->getMenuItem_index(0)->getPrice());
		$this->assertEquals(3, count($this->mm->getSupplies()));
		$this->assertEquals($name, $this->mm->getSupply_index(0)->getName());
		$this->assertEquals($quantity, $this->mm->getSupply_index(0)->getQuantity());
		$this->assertEquals($name2, $this->mm->getSupply_index(1)->getName());
		$this->assertEquals($quantity2, $this->mm->getSupply_index(1)->getQuantity());
		$this->assertEquals($name3, $this->mm->getSupply_index(2)->getName());
		$this->assertEquals($quantity3, $this->mm->getSupply_index(2)->getQuantity());
		$this->assertEquals(1, count($this->mm->getOrders()));
		$this->assertEquals($this->mm->getMenuItem_index(0), $this->mm->getOrder_index(0)->getMenuItems());
		$this->assertEquals($this->mm->getSupply_index(0), $this->mm->getOrder_index(0)->getSupplies());
		$this->assertEquals($this->mm->getSupply_index(1), $this->mm->getOrder_index(1)->getSupplies());
		$this->assertEquals($this->mm->getSupply_index(2), $this->mm->getOrder_index(2)->getSupplies());
	}
	
	
	public function testOrderNull() {
		$this->assertEquals(0, count($this->mm->getMenuItems()));
		$this->assertEquals(0, count($this->mm->getSupplies()));
		$this->assertEquals(0, count($this->sm->getStaffs()));
		$this->assertEquals(0, count($this->mm->getOrders()));
		
		$item = null;
		
		try {
			$this->c->createOrder($item);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		
		$this->assertEquals("@1Order item cannot be empty! ", $error);
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(0, count($this->mm->getMenuItems()));
    	$this->assertEquals(0, count($this->mm->getSupplies()));
    	$this->assertEquals(0, count($this->sm->getStaffs()));
    	$this->assertEquals(0, count($this->mm->getOrders()));
	}
	
	
	public function testOrderItemDoesNotExist() {
		$this->assertEquals(0, count($this->mm->getMenuItems()));
		$this->assertEquals(0, count($this->mm->getSupplies()));
		$this->assertEquals(0, count($this->sm->getStaffs()));
		$this->assertEquals(0, count($this->mm->getOrders()));
		
		$item = "Pizza";
		
		try {
			$this->c->createOrder($item);
		} catch (Exception $e) {
			$this->fail();
		}
		
		$this->mm = $this->mm->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getMenuItems()));
		$item = $this->mm->getMenuItem_index(0);
		$this->mm->delete();
		$this->pm2->writeDataToStore($this->mm);
		
		try {
			$this->c->createOrder($item);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		
		// Check the proper error messages are thrown 
		$this->assertEquals("@1Order item cannot be empty! ");
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(0, count($this->mm->getMenuItems()));
		$this->assertEquals(0, count($this->mm->getSupplies()));
		$this->assertEquals(0, count($this->sm->getStaffs()));
		$this->assertEquals(0, count($this->mm->getOrders()));
	}
	
	
	public function testOrderInsufficientSupplies() {
		$this->assertEquals(0, count($this->mm->getMenuItems()));
		
		$item = "Poutine";
		$popularity = null;
		$price = "12.99";
		
		try {
			$this->c->createItem($name, $popularity, $price);
		} catch (Exception $e) {
			$this->fail();
		}
		
		$name = "Fries";
		$quantity = "0";
		
		try {
			$this->c->createSupply($name, $quantity);
		} catch (Exception $e) {
			$this->fail();
		}
		
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getMenuItems()));
		$this->assertEquals(1, count($this->mm->getSupplies()));
		
		try {
			$this->c->order($item);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		
		// Check that the proper errors are thrown 
		$this->assertEquals("@2Order item cannot be made due to lack of supplies!", $error);
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getMenuItems()));
		$this->assertEquals($item, $this->mm->getMenuItem_index(0)->getName());
		$this->assertEquals($popularity, $this->mm->getMenuItem_index(0)->getPopularity());
		$this->assertEquals($price, $this->mm->getMenuItem_index(0)->getPrice());
		$this->assertEquals(1, count($this->mm->getSupplies()));
		$this->assertEquals($name, $this->mm->getSupply_index(0)->getName());
		$this->assertEquals($quantity, $this->mm->getSupply_index(0)->getQuantity());
		$this->assertEquals(1, count($this->mm->getOrders()));
		$this->assertEquals($this->mm->getMenuItem_index(0), $this->mm->getOrder_index(0)->getMenuItems());
		$this->assertEquals($this->mm->getSupply_index(0), $this->mm->getOrder_index(0)->getSupplies());
	}
}
?>