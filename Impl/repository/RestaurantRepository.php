<?php

require_once (dirname(__FILE__) . '/../util/DB.php');
require_once (dirname(__FILE__) . '/../domain/Restaurant.php');

class RestaurantRepository extends AbstractRepository {
	protected function findAll() {
		parent::query("SELECT * FROM restaurante r WHERE NOT EXISTS (SELECT * FROM historico h WHERE h.id_restaurante = r.id_restaurante AND WEEK(h.data) = WEEK(NOW()));");
	}

	protected function transform($row) {
		return new Restaurant($row['id_restaurante'],$row['nome'], $row['endereco'], $row['prioridade'], (bool) $row['coberto']);
	}

	private function findByName($name) {
		parent::query("SELECT * FROM restaurante where nome = '$name'");
	}

	private function findTodaysRestaurant() {
		parent::query("SELECT r.* FROM historico h LEFT JOIN restaurante r ON (r.id_restaurante = h.id_restaurante) WHERE h.data = DATE(NOW())");
	}

	public function byName($name) {
		$this->findByName($name);

		return $this->transform(parent::getRow());
	}

	public function todaysRestaurant() {
		$this->findTodaysRestaurant();

		$row = parent::getRow();

		if ($row != null) {
			return $this->transform($row);
		}

		return null;
	}
}

?>