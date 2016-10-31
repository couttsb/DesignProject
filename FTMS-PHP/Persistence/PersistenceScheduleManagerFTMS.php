<?php
class PersistenceScheduleManagerFTMS {
	private $filename;
	function __construct($filename = 'dataschedulemanager.txt') {
		$this->filename = $filename;
	}

	function loadDataFromStore() {
		if (file_exists($this->filename)) {
			$str = file_get_contents($this->filename);
			$sm = unserialize($str);
		} else {
			$sm = ScheduleManager::getInstance();
		}
		return $sm;
	}

	function writeDataToStore($sm) {
		$str = serialize($sm);
		file_put_contents($this->filename, $str);
	}
}
?>