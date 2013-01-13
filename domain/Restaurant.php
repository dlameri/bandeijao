<?php

define("MAX_PRIORITY", 5);

class Restaurant {
	private $id;
	private $name;
	private $address;
	private $priority;
	private $covered;

	public function __construct($id, $name, $address, $priority, $covered) {
		$this->id = $id;
		$this->name = $name;
		$this->address = $address;
		$this->priority = $priority;
		$this->covered = $covered;
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getAddress() {
		return $this->address;
	}

	public function getNumberOfRepeats() {
		return (MAX_PRIORITY - $this->priority) + 1;
	}

	public function isCovered() {
		return $this->covered;
	}
}

?>