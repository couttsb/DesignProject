<?php

/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.24.0-edef018 modeling language!*/

class Menu
{

	//------------------------
	// STATIC VARIABLES
	//------------------------

	private static $theInstance = null;

	//------------------------
	// MEMBER VARIABLES
	//------------------------

	//Menu Associations
	private $item;
	private $supplies;
	private $orders;

	//------------------------
	// CONSTRUCTOR
	//------------------------

	private function __construct()
	{
		$this->item = array();
		$this->supplies = array();
		$this->orders = array();
	}

	public static function getInstance()
	{
		if(self::$theInstance == null)
		{
			self::$theInstance = new Menu();
		}
		return self::$theInstance;
	}

	//------------------------
	// INTERFACE
	//------------------------

	public function getItem_index($index)
	{
		$aItem = $this->item[$index];
		return $aItem;
	}

	public function getItem()
	{
		$newItem = $this->item;
		return $newItem;
	}

	public function numberOfItem()
	{
		$number = count($this->item);
		return $number;
	}

	public function hasItem()
	{
		$has = $this->numberOfItem() > 0;
		return $has;
	}

	public function indexOfItem($aItem)
	{
		$wasFound = false;
		$index = 0;
		foreach($this->item as $item)
		{
			if ($item->equals($aItem))
			{
				$wasFound = true;
				break;
			}
			$index += 1;
		}
		$index = $wasFound ? $index : -1;
		return $index;
	}

	public function getSupply_index($index)
	{
		$aSupply = $this->supplies[$index];
		return $aSupply;
	}

	public function getSupplies()
	{
		$newSupplies = $this->supplies;
		return $newSupplies;
	}

	public function numberOfSupplies()
	{
		$number = count($this->supplies);
		return $number;
	}

	public function hasSupplies()
	{
		$has = $this->numberOfSupplies() > 0;
		return $has;
	}

	public function indexOfSupply($aSupply)
	{
		$wasFound = false;
		$index = 0;
		foreach($this->supplies as $supply)
		{
			if ($supply->equals($aSupply))
			{
				$wasFound = true;
				break;
			}
			$index += 1;
		}
		$index = $wasFound ? $index : -1;
		return $index;
	}

	public function getOrder_index($index)
	{
		$aOrder = $this->orders[$index];
		return $aOrder;
	}

	public function getOrders()
	{
		$newOrders = $this->orders;
		return $newOrders;
	}

	public function numberOfOrders()
	{
		$number = count($this->orders);
		return $number;
	}

	public function hasOrders()
	{
		$has = $this->numberOfOrders() > 0;
		return $has;
	}

	public function indexOfOrder($aOrder)
	{
		$wasFound = false;
		$index = 0;
		foreach($this->orders as $order)
		{
			if ($order->equals($aOrder))
			{
				$wasFound = true;
				break;
			}
			$index += 1;
		}
		$index = $wasFound ? $index : -1;
		return $index;
	}

	public static function minimumNumberOfItem()
	{
		return 0;
	}

	public function addItem($aItem)
	{
		$wasAdded = false;
		if ($this->indexOfItem($aItem) !== -1) { return false; }
		$this->item[] = $aItem;
		$wasAdded = true;
		return $wasAdded;
	}

	public function removeItem($aItem)
	{
		$wasRemoved = false;
		if ($this->indexOfItem($aItem) != -1)
		{
			unset($this->item[$this->indexOfItem($aItem)]);
			$this->item = array_values($this->item);
			$wasRemoved = true;
		}
		return $wasRemoved;
	}

	public function addItemAt($aItem, $index)
	{
		$wasAdded = false;
		if($this->addItem($aItem))
		{
			if($index < 0 ) { $index = 0; }
			if($index > $this->numberOfItem()) { $index = $this->numberOfItem() - 1; }
			array_splice($this->item, $this->indexOfItem($aItem), 1);
			array_splice($this->item, $index, 0, array($aItem));
			$wasAdded = true;
		}
		return $wasAdded;
	}

	public function addOrMoveItemAt($aItem, $index)
	{
		$wasAdded = false;
		if($this->indexOfItem($aItem) !== -1)
		{
			if($index < 0 ) { $index = 0; }
			if($index > $this->numberOfItem()) { $index = $this->numberOfItem() - 1; }
			array_splice($this->item, $this->indexOfItem($aItem), 1);
			array_splice($this->item, $index, 0, array($aItem));
			$wasAdded = true;
		}
		else
		{
			$wasAdded = $this->addItemAt($aItem, $index);
		}
		return $wasAdded;
	}

	public static function minimumNumberOfSupplies()
	{
		return 0;
	}

	public function addSupply($aSupply)
	{
		$wasAdded = false;
		if ($this->indexOfSupply($aSupply) !== -1) { return false; }
		$this->supplies[] = $aSupply;
		$wasAdded = true;
		return $wasAdded;
	}

	public function removeSupply($aSupply)
	{
		$wasRemoved = false;
		if ($this->indexOfSupply($aSupply) != -1)
		{
			unset($this->supplies[$this->indexOfSupply($aSupply)]);
			$this->supplies = array_values($this->supplies);
			$wasRemoved = true;
		}
		return $wasRemoved;
	}

	public function addSupplyAt($aSupply, $index)
	{
		$wasAdded = false;
		if($this->addSupply($aSupply))
		{
			if($index < 0 ) { $index = 0; }
			if($index > $this->numberOfSupplies()) { $index = $this->numberOfSupplies() - 1; }
			array_splice($this->supplies, $this->indexOfSupply($aSupply), 1);
			array_splice($this->supplies, $index, 0, array($aSupply));
			$wasAdded = true;
		}
		return $wasAdded;
	}

	public function addOrMoveSupplyAt($aSupply, $index)
	{
		$wasAdded = false;
		if($this->indexOfSupply($aSupply) !== -1)
		{
			if($index < 0 ) { $index = 0; }
			if($index > $this->numberOfSupplies()) { $index = $this->numberOfSupplies() - 1; }
			array_splice($this->supplies, $this->indexOfSupply($aSupply), 1);
			array_splice($this->supplies, $index, 0, array($aSupply));
			$wasAdded = true;
		}
		else
		{
			$wasAdded = $this->addSupplyAt($aSupply, $index);
		}
		return $wasAdded;
	}

	public static function minimumNumberOfOrders()
	{
		return 0;
	}

	public function addOrder($aOrder)
	{
		$wasAdded = false;
		if ($this->indexOfOrder($aOrder) !== -1) { return false; }
		$this->orders[] = $aOrder;
		$wasAdded = true;
		return $wasAdded;
	}

	public function removeOrder($aOrder)
	{
		$wasRemoved = false;
		if ($this->indexOfOrder($aOrder) != -1)
		{
			unset($this->orders[$this->indexOfOrder($aOrder)]);
			$this->orders = array_values($this->orders);
			$wasRemoved = true;
		}
		return $wasRemoved;
	}

	public function addOrderAt($aOrder, $index)
	{
		$wasAdded = false;
		if($this->addOrder($aOrder))
		{
			if($index < 0 ) { $index = 0; }
			if($index > $this->numberOfOrders()) { $index = $this->numberOfOrders() - 1; }
			array_splice($this->orders, $this->indexOfOrder($aOrder), 1);
			array_splice($this->orders, $index, 0, array($aOrder));
			$wasAdded = true;
		}
		return $wasAdded;
	}

	public function addOrMoveOrderAt($aOrder, $index)
	{
		$wasAdded = false;
		if($this->indexOfOrder($aOrder) !== -1)
		{
			if($index < 0 ) { $index = 0; }
			if($index > $this->numberOfOrders()) { $index = $this->numberOfOrders() - 1; }
			array_splice($this->orders, $this->indexOfOrder($aOrder), 1);
			array_splice($this->orders, $index, 0, array($aOrder));
			$wasAdded = true;
		}
		else
		{
			$wasAdded = $this->addOrderAt($aOrder, $index);
		}
		return $wasAdded;
	}

	public function equals($compareTo)
	{
		return $this == $compareTo;
	}

	public function delete()
	{
		$this->item = array();
		$this->supplies = array();
		$this->orders = array();
	}

}
?>
<p></p>