<?php

/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.24.0-edef018 modeling language!*/

class Staff
{

	//------------------------
	// MEMBER VARIABLES
	//------------------------

	//Staff Attributes
	private $role;
	private $availability;
	private $name;

	//------------------------
	// CONSTRUCTOR
	//------------------------

	public function __construct($aRole, $aName)
	{
		$this->role = $aRole;
		$this->availability = array();
		$this->name = $aName;
	}

	//------------------------
	// INTERFACE
	//------------------------

	public function setRole($aRole)
	{
		$wasSet = false;
		$this->role = $aRole;
		$wasSet = true;
		return $wasSet;
	}

	public function addAvailability($aAvailability)
	{
		$wasAdded = false;
		$this->availability[] = $aAvailability;
		$wasAdded = true;
		return $wasAdded;
	}

	public function removeAvailability($aAvailability)
	{
		$wasRemoved = false;
		unset($this->availability[$this->indexOfAvailability($aAvailability)]);
		$this->availability = array_values($this->availability);
		$wasRemoved = true;
		return $wasRemoved;
	}

	public function setName($aName)
	{
		$wasSet = false;
		$this->name = $aName;
		$wasSet = true;
		return $wasSet;
	}

	public function getRole()
	{
		return $this->role;
	}

	public function getAvailability_index($index)
	{
		$aAvailability = $this->availability[$index];
		return $aAvailability;
	}

	public function getAvailability()
	{
		$newAvailability = $this->availability;
		return $newAvailability;
	}

	public function numberOfAvailability()
	{
		$number = count($this->availability);
		return $number;
	}

	public function hasAvailability()
	{
		$has = availability.size() > 0;
		return $has;
	}

	public function indexOfAvailability($aAvailability)
	{
		$rawAnswer = array_search($aAvailability,$this->availability);
		$index = $rawAnswer == null && $rawAnswer !== 0 ? -1 : $rawAnswer;
		return $index;
	}

	public function getName()
	{
		return $this->name;
	}

	public function isAvailability()
	{
		return $this->availability;
	}

	public function equals($compareTo)
	{
		return $this == $compareTo;
	}

	public function delete()
	{}

}
?>