<?php
require_once 'C:\xampp\htdocs\FTMS-PHP\Persistence\PersistenceScheduleManagerFTMS.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Persistence\PersistenceMenuFTMS.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Model\ScheduleManager.php';
require_once 'C:\xampp\htdocs\FTMS-PHP\Model\Equipment.php';

class PersistenceFTMSTest extends PHPUnit_Framework_TestCase {
	protected $pm;
	protected $pm2;
	
	protected function setUp() {
		$this->pm = new PersistenceScheduleManagerFTMS();
		$this->pm2 = new PersistenceMenuFTMS();
	}
	
	protected function tearDown() {
	}
	
	public function testPersistenceMenu() {
		// 1. Create test data
		$sm = ScheduleManager::getInstance();
		$equipment = new Equipment("Fire");
		$sm->addEquipment($equipment);
	
		// 2. Write all of the data
		$this->pm->writeDataToStore($sm);
	
		// 3. Clear the data from memory
		$sm->delete();
	
		$this->assertEquals(0, count($sm->getEquipment()));
	
		// 4. Load it back in
		$sm = $this->pm->loadDataFromStore();
	
		// 5. Check that we got it back
		$this->assertEquals(1, count($sm->getEquipment()));
		$myEquipment = $sm->getEquipment_index(0);
		$this->assertEquals("Fire", $myEquipment->getName());
	}
	
	public function testPersistenceScheduleManager() {
		// 1. Create test data
		$mm = Menu::getInstance();
		$menuitem = new MenuItem("Food");
		$mm->addMenuItem($menuitem);
	
		// 2. Write all of the data
		$this->pm2->writeDataToStore($mm);
	
		// 3. Clear the data from memory
		$mm->delete();
	
		$this->assertEquals(0, count($mm->getMenuItems()));
	
		// 4. Load it back in
		$mm = $this->pm2->loadDataFromStore();
	
		// 5. Check that we got it back
		$this->assertEquals(1, count($mm->getMenuItems()));
		$myMenuItem = $mm->getMenuItem_index(0);
		$this->assertEquals("Food", $myMenuItem->getName());
	}
}
?>