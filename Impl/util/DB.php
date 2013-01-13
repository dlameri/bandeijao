<?php

abstract class AbstractRepository {
	private $resource;
	private $result;

	abstract protected function transform($row);

	public function __construct() {
		$services_json = json_decode(getenv("VCAP_SERVICES"),true);
		$mysql_config = $services_json["mysql-5.1"][0]["credentials"];
		$username = $mysql_config["username"];
		$password = $mysql_config["password"];
		$hostname = $mysql_config["hostname"];
		$port = $mysql_config["port"];
		$db = $mysql_config["name"];
		$this->resource = mysql_connect("$hostname:$port", $username, $password);
		mysql_select_db($db, $this->resource);
	}

	public function query($query) {
		$this->result = mysql_query($query, $this->resource);
	}

	public function getRow() {
		return mysql_fetch_assoc($this->result);
	}

	public function all() {
		$ObjArray = array();
		$this->findAll();
		
		while ($row = $this->getRow()) {
			$ObjArray[] = $this->transform($row);
		}

		return $ObjArray;
	}
}

?>