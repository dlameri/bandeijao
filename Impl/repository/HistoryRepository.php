<?php

require_once (dirname(__FILE__) . '/../util/DB.php');
require_once (dirname(__FILE__) . '/../domain/History.php');

class HistoryRepository extends AbstractRepository {
	protected function findAll() {
		parent::query('SELECT * FROM historico');
	}	

	protected function transform($row) {
		return new History($row['id_historico'],$row['id_restaurante'], $row['data']);
	}

	private function insert($RestaurantId) {
		parent::query("INSERT INTO historico (id_restaurante, data) values ($RestaurantId, DATE(NOW()))");
	}

	public function makeItHistory($restaurant) {
		$this->insert($restaurant->getId());
	}
}

?>