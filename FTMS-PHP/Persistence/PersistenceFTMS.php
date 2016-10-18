<?php
class PersistenceFTMS {
	private $filename;
	function __construct($filename = 'data.txt') {
		$this->filename = $filename;
	}

	function loadDataFromStore() {
		if (file_exists($this->filename)) {
			$str = file_get_contents($this->filename);
			$m = unserialize($str);
		} else {
			$sm = ScheduleManager::getInstance();
			$mm = Menu::getInstance();
			$m = $sm && $mm;
		}
		return $m;
	}

	function writeDataToStore($m) {
		$str = serialize($m);
		file_put_contents($this->filename, $str);
	}
}
?>