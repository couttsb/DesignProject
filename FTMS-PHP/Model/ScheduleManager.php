<?php

/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.24.0-edef018 modeling language!*/

class ScheduleManager
{

	//------------------------
	// STATIC VARIABLES
	//------------------------

	private static $theInstance = null;

	//------------------------
	// MEMBER VARIABLES
	//------------------------

	//ScheduleManager Associations
	private $equipment;
	private $schedules;
	private $staffs;

	//------------------------
	// CONSTRUCTOR
	//------------------------

	private function __construct()
	{
		$this->equipment = array();
		$this->schedules = array();
		$this->staffs = array();
	}

	public static function getInstance()
	{
		if(self::$theInstance == null)
		{
			self::$theInstance = new ScheduleManager();
		}
		return self::$theInstance;
	}

	//------------------------
	// INTERFACE
	//------------------------

	public function getEquipment_index($index)
	{
		$aEquipment = $this->equipment[$index];
		return $aEquipment;
	}

	public function getEquipment()
	{
		$newEquipment = $this->equipment;
		return $newEquipment;
	}

	public function numberOfEquipment()
	{
		$number = count($this->equipment);
		return $number;
	}

	public function hasEquipment()
	{
		$has = $this->numberOfEquipment() > 0;
		return $has;
	}

	public function indexOfEquipment($aEquipment)
	{
		$wasFound = false;
		$index = 0;
		foreach($this->equipment as $equipment)
		{
			if ($equipment->equals($aEquipment))
			{
				$wasFound = true;
				break;
			}
			$index += 1;
		}
		$index = $wasFound ? $index : -1;
		return $index;
	}

	public function getSchedule_index($index)
	{
		$aSchedule = $this->schedules[$index];
		return $aSchedule;
	}

	public function getSchedules()
	{
		$newSchedules = $this->schedules;
		return $newSchedules;
	}

	public function numberOfSchedules()
	{
		$number = count($this->schedules);
		return $number;
	}

	public function hasSchedules()
	{
		$has = $this->numberOfSchedules() > 0;
		return $has;
	}

	public function indexOfSchedule($aSchedule)
	{
		$wasFound = false;
		$index = 0;
		foreach($this->schedules as $schedule)
		{
			if ($schedule->equals($aSchedule))
			{
				$wasFound = true;
				break;
			}
			$index += 1;
		}
		$index = $wasFound ? $index : -1;
		return $index;
	}

	public function getStaff_index($index)
	{
		$aStaff = $this->staffs[$index];
		return $aStaff;
	}

	public function getStaffs()
	{
		$newStaffs = $this->staffs;
		return $newStaffs;
	}

	public function numberOfStaffs()
	{
		$number = count($this->staffs);
		return $number;
	}

	public function hasStaffs()
	{
		$has = $this->numberOfStaffs() > 0;
		return $has;
	}

	public function indexOfStaff($aStaff)
	{
		$wasFound = false;
		$index = 0;
		foreach($this->staffs as $staff)
		{
			if ($staff->equals($aStaff))
			{
				$wasFound = true;
				break;
			}
			$index += 1;
		}
		$index = $wasFound ? $index : -1;
		return $index;
	}

	public static function minimumNumberOfEquipment()
	{
		return 0;
	}

	public function addEquipment($aEquipment)
	{
		$wasAdded = false;
		if ($this->indexOfEquipment($aEquipment) !== -1) { return false; }
		$this->equipment[] = $aEquipment;
		$wasAdded = true;
		return $wasAdded;
	}

	public function removeEquipment($aEquipment)
	{
		$wasRemoved = false;
		if ($this->indexOfEquipment($aEquipment) != -1)
		{
			unset($this->equipment[$this->indexOfEquipment($aEquipment)]);
			$this->equipment = array_values($this->equipment);
			$wasRemoved = true;
		}
		return $wasRemoved;
	}

	public function addEquipmentAt($aEquipment, $index)
	{
		$wasAdded = false;
		if($this->addEquipment($aEquipment))
		{
			if($index < 0 ) { $index = 0; }
			if($index > $this->numberOfEquipment()) { $index = $this->numberOfEquipment() - 1; }
			array_splice($this->equipment, $this->indexOfEquipment($aEquipment), 1);
			array_splice($this->equipment, $index, 0, array($aEquipment));
			$wasAdded = true;
		}
		return $wasAdded;
	}

	public function addOrMoveEquipmentAt($aEquipment, $index)
	{
		$wasAdded = false;
		if($this->indexOfEquipment($aEquipment) !== -1)
		{
			if($index < 0 ) { $index = 0; }
			if($index > $this->numberOfEquipment()) { $index = $this->numberOfEquipment() - 1; }
			array_splice($this->equipment, $this->indexOfEquipment($aEquipment), 1);
			array_splice($this->equipment, $index, 0, array($aEquipment));
			$wasAdded = true;
		}
		else
		{
			$wasAdded = $this->addEquipmentAt($aEquipment, $index);
		}
		return $wasAdded;
	}

	public static function minimumNumberOfSchedules()
	{
		return 0;
	}

	public function addSchedule($aSchedule)
	{
		$wasAdded = false;
		if ($this->indexOfSchedule($aSchedule) !== -1) { return false; }
		$this->schedules[] = $aSchedule;
		$wasAdded = true;
		return $wasAdded;
	}

	public function removeSchedule($aSchedule)
	{
		$wasRemoved = false;
		if ($this->indexOfSchedule($aSchedule) != -1)
		{
			unset($this->schedules[$this->indexOfSchedule($aSchedule)]);
			$this->schedules = array_values($this->schedules);
			$wasRemoved = true;
		}
		return $wasRemoved;
	}

	public function addScheduleAt($aSchedule, $index)
	{
		$wasAdded = false;
		if($this->addSchedule($aSchedule))
		{
			if($index < 0 ) { $index = 0; }
			if($index > $this->numberOfSchedules()) { $index = $this->numberOfSchedules() - 1; }
			array_splice($this->schedules, $this->indexOfSchedule($aSchedule), 1);
			array_splice($this->schedules, $index, 0, array($aSchedule));
			$wasAdded = true;
		}
		return $wasAdded;
	}

	public function addOrMoveScheduleAt($aSchedule, $index)
	{
		$wasAdded = false;
		if($this->indexOfSchedule($aSchedule) !== -1)
		{
			if($index < 0 ) { $index = 0; }
			if($index > $this->numberOfSchedules()) { $index = $this->numberOfSchedules() - 1; }
			array_splice($this->schedules, $this->indexOfSchedule($aSchedule), 1);
			array_splice($this->schedules, $index, 0, array($aSchedule));
			$wasAdded = true;
		}
		else
		{
			$wasAdded = $this->addScheduleAt($aSchedule, $index);
		}
		return $wasAdded;
	}

	public static function minimumNumberOfStaffs()
	{
		return 0;
	}

	public function addStaff($aStaff)
	{
		$wasAdded = false;
		if ($this->indexOfStaff($aStaff) !== -1) { return false; }
		$this->staffs[] = $aStaff;
		$wasAdded = true;
		return $wasAdded;
	}

	public function removeStaff($aStaff)
	{
		$wasRemoved = false;
		if ($this->indexOfStaff($aStaff) != -1)
		{
			unset($this->staffs[$this->indexOfStaff($aStaff)]);
			$this->staffs = array_values($this->staffs);
			$wasRemoved = true;
		}
		return $wasRemoved;
	}

	public function addStaffAt($aStaff, $index)
	{
		$wasAdded = false;
		if($this->addStaff($aStaff))
		{
			if($index < 0 ) { $index = 0; }
			if($index > $this->numberOfStaffs()) { $index = $this->numberOfStaffs() - 1; }
			array_splice($this->staffs, $this->indexOfStaff($aStaff), 1);
			array_splice($this->staffs, $index, 0, array($aStaff));
			$wasAdded = true;
		}
		return $wasAdded;
	}

	public function addOrMoveStaffAt($aStaff, $index)
	{
		$wasAdded = false;
		if($this->indexOfStaff($aStaff) !== -1)
		{
			if($index < 0 ) { $index = 0; }
			if($index > $this->numberOfStaffs()) { $index = $this->numberOfStaffs() - 1; }
			array_splice($this->staffs, $this->indexOfStaff($aStaff), 1);
			array_splice($this->staffs, $index, 0, array($aStaff));
			$wasAdded = true;
		}
		else
		{
			$wasAdded = $this->addStaffAt($aStaff, $index);
		}
		return $wasAdded;
	}

	public function equals($compareTo)
	{
		return $this == $compareTo;
	}

	public function delete()
	{
		$this->equipment = array();
		$this->schedules = array();
		$this->staffs = array();
	}

}
?>