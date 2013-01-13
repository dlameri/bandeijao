<?php

class History {
	private $id;
	private $restaurant;
	private $data;

	public function __construct($id, $restaurant, $data) {
		$this->id = $id;
		$this->restaurant = $restaurant;
		$this->data = $data;		
	}

	public function getRestaurant() {
		return $this->restaurant;
	}

	public function getData() {
		return $this->data;
	}
}

?>