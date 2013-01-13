<?php

class Person {
	private $id;
	private $name;
	private $email;

	public function __construct($id, $name, $email) {
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
	}

	public function getName() {
		return $this->name;
	}

	public function getEmail() {
		return $this->email;
	}
}

?>