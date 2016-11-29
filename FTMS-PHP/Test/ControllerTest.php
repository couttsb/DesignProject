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
		$this->assertEquals(0, count($this->sm->getStaff()));		
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
		$this->assertEquals(0, count($this->sm->getStaff()));
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
		$this->assertEquals(0, count($this->sm->getStaff()));
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
		$this->assertEquals(0, count($this->sm->getStaff()));
	}
	
	
	public function testCreateStaff() {
		$this->assertEquals(0, count($this->sm->getStaff()));
		
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
		$this->assertEquals(1, count($this->sm->getStaff()));
		$this->assertEquals($role, $this->sm->getStaff_index(0)->getRole());
		$this->assertEquals($name, $this->sm->getStaff_index(0)->getName());
	}
	
	
	public function testCreateStaffNull() {
		$this->assertEquals(0, count($this->sm->getStaff()));
	
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
		$this->assertEquals(0, count($this->sm->getStaff()));
	}
	
	
	public function testCreateStaffEmpty() {
		$this->assertEquals(0, count($this->sm->getStaff()));
	
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
		$this->assertEquals(0, count($this->sm->getStaff()));
	}
	
	
	public function testCreateStaffSpaces() {
		$this->assertEquals(0, count($this->sm->getStaff()));
	 
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
		$this->assertEquals(0, count($this->sm->getStaff()));
	}
	
	
	public function testCreateSupply() {
		$this->assertEquals(0, count($this->mm->getSupply()));
		
		$name = "Cheese";
		$quantity = "12";
		
		try {
			$this->c->createSupply($name, $quantity);
		} catch (Exception $e) {
			$this->fail();
		}
		
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getSupply()));
		$this->assertEquals($name, $this->mm->getSupply_index(0)->getName());
		$this->assertEquals($quantity, $this->mm->getSupply_index(0)->getQuantity());
		$this->assertEquals(0, count($this->mm->getItem()));
		$this->assertEquals(0, count($this->mm->getOrder()));
	}
	
	
	public function testCreateSupplyNull() {
		$this->assertEquals(0, count($this->mm->getSupply()));
		
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
		$this->assertEquals(1, count($this->mm->getSupply()));
		$this->assertEquals($name, $this->mm->getSupply_index(0)->getName());
		$this->assertEquals($quantity, $this->mm->getSupply_index(0)->getQuantity());
		$this->assertEquals(0, count($this->mm->getItem()));
		$this->assertEquals(0, count($this->mm->getOrder()));
	}
	
	
	public function testCreateSupplyEmpty() {
		$this->assertEquals(0, count($this->mm->getSupply()));
	
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
		$this->assertEquals(1, count($this->mm->getSupply()));
		$this->assertEquals($name, $this->mm->getSupply_index(0)->getName());
		$this->assertEquals($quantity, $this->mm->getSupply_index(0)->getQuantity());
		$this->assertEquals(0, count($this->mm->getItem()));
		$this->assertEquals(0, count($this->mm->getOrder()));
	}
	
	
	public function testCreateSupplySpaces() {
		$this->assertEquals(0, count($this->mm->getSupply()));
	
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
		$this->assertEquals(1, count($this->mm->getSupply()));
		$this->assertEquals($name, $this->mm->getSupply_index(0)->getName());
		$this->assertEquals($quantity, $this->mm->getSupply_index(0)->getQuantity());
		$this->assertEquals(0, count($this->mm->getItem()));
		$this->assertEquals(0, count($this->mm->getOrder()));
	}
	
	
	public function testCreateItem() {
		$this->assertEquals(0, count($this->mm->getSupply()));
		
		$name = "Poutine";
		$popularity = "99";
		$price = "5.99";
		
		try {
			$this->c->createItem($name, $popularity, $quantity);
		} catch (Exception $e) {
			$this->fail();
		}
		
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getItem()));
		$this->assertEquals($name, $this->mm->getItem_index(0)->getName());
		$this->assertEquals($popularity, $this->mm->getItem_index(0)->getPopularity());
		$this->assertEquals($price, $this->mm->getItem_index(0)->getPrice());
		$this->assertEquals(0, count($this->mm->getSupply()));
		$this->assertEquals(0, count($this->mm->getOrder()));
	}
	
	
	public function testCreateItemNull() {
		$this->assertEquals(0, count($this->mm->getSupply()));
	
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
		$this->assertEquals(1, count($this->mm->getItem()));
		$this->assertEquals($name, $this->mm->getItem_index(0)->getName());
		$this->assertEquals($popularity, $this->mm->getItem_index(0)->getPopularity());
		$this->assertEquals($price, $this->mm->getItem_index(0)->getPrice());
		$this->assertEquals(0, count($this->mm->getSupply()));
		$this->assertEquals(0, count($this->mm->getOrder()));
	}
	
	
	public function testCreateItemEmpty() {
		$this->assertEquals(0, count($this->mm->getSupply()));
	
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
		$this->assertEquals(1, count($this->mm->getItem()));
		$this->assertEquals($name, $this->mm->getItem_index(0)->getName());
		$this->assertEquals($popularity, $this->mm->getItem_index(0)->getPopularity());
		$this->assertEquals($price, $this->mm->getItem_index(0)->getPrice());
		$this->assertEquals(0, count($this->mm->getSupply()));
		$this->assertEquals(0, count($this->mm->getOrder()));
	}
	
	
	public function testCreateItemSpaces() {
		$this->assertEquals(0, count($this->mm->getSupply()));
	
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
		$this->assertEquals(1, count($this->mm->getItem()));
		$this->assertEquals($name, $this->mm->getItem_index(0)->getName());
		$this->assertEquals($popularity, $this->mm->getItem_index(0)->getPopularity());
		$this->assertEquals($price, $this->mm->getItem_index(0)->getPrice());
		$this->assertEquals(0, count($this->mm->getSupply()));
		$this->assertEquals(0, count($this->mm->getOrder()));
	}
	
	
	public function testCreateSuppliesToMenuItem() {
		$this->assertEquals(0, count($this->mm->getMenuItem()));
	
		$item = "Poutine";
		$popularity = null;
		$price = "12.99";
		try {
			$this->c->createItem($name, $popularity, $price);
		} catch (Exception $e) {
			$this->fail();
		}
	
		$name = "Fries";
		$quantity = "1";
		$name2 = "Cheese Curds";
		$quantity2 = "2";
		
		$supplies[0][0] = $name;
		$supplies[0][1] = $quantity;
		$supplies[1][0] = $name2;
		$supplies[1][1] = $quantity2;
		
		try {
			$this->c->createSupply($name, $quantity);
			$this->c->createSupply($name2, $quantity2);
		} catch (Exception $e) {
			$this->fail();
		}
		
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getItem()));
		$this->assertEquals(2, count($this->mm->getSupply()));
		
		try {
			$this->c->createSuppliesToMenuItem($item, $supplies);
		} catch (Exception $e) {
			$this->fail();
		}
	
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getItem()));
		$this->assertEquals($item, $this->mm->getItem_index(0)->getName());
		$this->assertEquals($popularity, $this->mm->getItem_index(0)->getPopularity());
		$this->assertEquals($price, $this->mm->getItem_index(0)->getPrice());
		$this->assertEquals($name, $this->mm->getSupply_index(0)->getName());
		$this->assertEquals($quantity, $this->mm->getSupply_index(0)->getQuantity());
		$this->assertEquals($name2, $this->mm->getSupply_index(1)->getName());
		$this->assertEquals($quantity2, $this->mm->getSupply_index(1)->getQuantity());
		$this->assertEquals($supplies, $this->mm->getItem_index(0)->getSupplies());
		$this->assertEquals(0, count($this->mm->getOrder()));
	}
	
	
	public function testCreateOrder() {
		$this->assertEquals(0, count($this->mm->getItem()));
		$this->assertEquals(0, count($this->mm->getSupply()));
		$this->assertEquals(0, count($this->mm->getStaff()));
		$this->assertEquals(0, count($this->mm->getOrder()));
		
		$item = "Poutine";
		$popularity = null;
		$price = "12.99";
		
		try { 
			$this->c->createItem($name, $popularity, $price);
		} catch (Exception $e) {
			$this->fail();
		}
		
		$name = "Fries";
		$quantity = "52";
		
		$name2 = "Cheese Curds";
		$quantity2 = "30";
		
		$name3 = "Gravy";
		$quantity3 = "5";
		
		try {
			$this->c->createSupply($name, $quantity);
			$this->c->createSupply($name2, $quantity2);
			$this->c->createSupply($name3, $quantity3);
		} catch (Exception $e) {
			$this->fail();
		}
		
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getItem()));
		$this->assertEquals(3, count($this->mm->getSupply()));
		
		try {
			$this->c->order($item);
		} catch (Exception $e) {
			$this->fail();
		}
		
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getItem()));
		$this->assertEquals($item, $this->mm->getItem_index(0)->getName());
		$this->assertEquals($popularity, $this->mm->getItem_index(0)->getPopularity());
		$this->assertEquals($price, $this->mm->getItem_index(0)->getPrice());
		$this->assertEquals(3, count($this->mm->getSupply()));
		$this->assertEquals($name, $this->mm->getSupply_index(0)->getName());
		$this->assertEquals($quantity, $this->mm->getSupply_index(0)->getQuantity());
		$this->assertEquals($name2, $this->mm->getSupply_index(1)->getName());
		$this->assertEquals($quantity2, $this->mm->getSupply_index(1)->getQuantity());
		$this->assertEquals($name3, $this->mm->getSupply_index(2)->getName());
		$this->assertEquals($quantity3, $this->mm->getSupply_index(2)->getQuantity());
		$this->assertEquals(1, count($this->mm->getOrder()));
		$this->assertEquals($this->mm->getItem_index(0), $this->mm->getOrder_index(0)->getItem());
		$this->assertEquals($this->mm->getSupply_index(0), $this->mm->getOrder_index(0)->getSupply());
		$this->assertEquals($this->mm->getSupply_index(1), $this->mm->getOrder_index(1)->getSupply());
		$this->assertEquals($this->mm->getSupply_index(2), $this->mm->getOrder_index(2)->getSupply());
	}
	
	
	public function testOrderNull() {
		$this->assertEquals(0, count($this->mm->getItem()));
		$this->assertEquals(0, count($this->mm->getSupply()));
		$this->assertEquals(0, count($this->mm->getStaff()));
		$this->assertEquals(0, count($this->mm->getOrder()));
		
		$item = null;
		
		try {
			$this->c->createOrder($item);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		
		$this->assertEquals("@1Order item cannot be empty!", $error);
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(0, count($this->mm->getItem()));
    	$this->assertEquals(0, count($this->mm->getSupply()));
    	$this->assertEquals(0, count($this->mm->getStaff()));
    	$this->assertEquals(0, count($this->mm->getOrder()));
	}
	
	
	public function testOrderItemDoesNotExist() {
		$this->assertEquals(0, count($this->mm->getItem()));
		$this->assertEquals(0, count($this->mm->getSupply()));
		$this->assertEquals(0, count($this->mm->getStaff()));
		$this->assertEquals(0, count($this->mm->getOrder()));
		
		$item = "Pizza";
		
		try {
			$this->c->createOrder($item);
		} catch (Exception $e) {
			$this->fail();
		}
		
		$this->mm = $this->mm->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getItem()));
		$item = $this->mm->getItem_index(0);
		$this->mm->delete();
		$this->pm2->writeDataToStore($this->mm);
		
		try {
			$this->c->createOrder($item);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		
		// Check the proper error messages are thrown 
		$this->assertEquals("@1Order item cannot be empty!");
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(0, count($this->mm->getItem()));
		$this->assertEquals(0, count($this->mm->getSupply()));
		$this->assertEquals(0, count($this->mm->getStaff()));
		$this->assertEquals(0, count($this->mm->getOrder()));
	}
	
	
	public function testOrderInsufficientSupplies() {
		$this->assertEquals(0, count($this->mm->getMenuItem()));
		
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
		$this->assertEquals(1, count($this->mm->getItem()));
		$this->assertEquals(1, count($this->mm->getSupply()));
		
		try {
			$this->c->order($item);
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		
		// Check that the proper errors are thrown 
		$this->assertEquals("@2Order item cannot be made due to lack of supplies!", $error);
		// Check file contents are proper
		$this->mm = $this->pm2->loadDataFromStore();
		$this->assertEquals(1, count($this->mm->getItem()));
		$this->assertEquals($item, $this->mm->getItem_index(0)->getName());
		$this->assertEquals($popularity, $this->mm->getItem_index(0)->getPopularity());
		$this->assertEquals($price, $this->mm->getItem_index(0)->getPrice());
		$this->assertEquals(1, count($this->mm->getSupply()));
		$this->assertEquals($name, $this->mm->getSupply_index(0)->getName());
		$this->assertEquals($quantity, $this->mm->getSupply_index(0)->getQuantity());
		$this->assertEquals(1, count($this->mm->getOrder()));
		$this->assertEquals($this->mm->getItem_index(0), $this->mm->getOrder_index(0)->getItem());
		$this->assertEquals($this->mm->getSupply_index(0), $this->mm->getOrder_index(0)->getSupply());
	}
}
?>