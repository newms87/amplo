<?php

class Db
{
	private
		$mysqli,
		$error,
		$last_id,
		$hostname,
		$username,
		$password,
		$database;

	public function __construct($hostname, $username, $password, $database)
	{
		$this->hostname = $hostname;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;

		$this->mysqli = new mysqli($hostname, $username, $password, $database);

		if ($this->mysqli->connect_error) {
			die('<br /><br /><strong>Unable to establish connection to MySQL Database. </strong> ERROR: (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
		}
	}

	public function getError()
	{
		return $this->error;
	}

	public function query($sql)
	{
		$result = $this->mysqli->query($sql);

		if ($result) {
			if (is_object($result)) {
				$data = array();

				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}

				$query           = new stdclass();
				$query->num_rows = $result->num_rows;
				$query->row      = isset($data[0]) ? $data[0] : array();
				$query->rows     = $data;

				$result->free();

				return $query;
			} else {
				$this->last_id = $this->mysqli->insert_id;

				return true;
			}
		} else {
			$this->error = "<strong>MySQLi Error (" . $this->mysqli->errno . "):</strong> " . $this->mysqli->error . "<br /><br />$sql";

			return false;
		}
	}

	public function queryRow($sql)
	{
		$result = $this->query($sql);

		if ($result) {
			return $result->row;
		}

		return false;
	}

	public function queryRows($sql)
	{
		$result = $this->query($sql);

		if ($result) {
			return $result->rows;
		}

		return false;
	}

	public function insert($table, $data)
	{
		$values = '';

		var_dump($data);

		foreach ($data as $key => $value) {
			$values .= ($values ? ', ' : '') . $this->escape($key) . " = '" . $this->escape($value) . "'";
		}

		$table = $this->escape($table);

		$sql = "INSERT INTO `$table` SET $values";

		echo $sql . '<BR>';

		if ($this->query($sql)) {
			echo "success" . $this->getLastId();
			return $this->getLastId();
		}

		return false;
	}

	public function multiQuery($sql)
	{
		$this->mysqli->multi_query($sql);

		while ($this->mysqli->more_results() && $this->mysqli->next_result()) {
		}

		if ($this->mysqli->errno) {
			$this->error = "<strong>MySQLi Error (" . $this->mysqli->errno . "):</strong> " . $this->mysqli->error . "<br /><br />$sql";

			return false;
		}

		return true;
	}

	public function escape($value)
	{
		return $this->mysqli->real_escape_string($value);
	}

	public function getLastId()
	{
		return $this->last_id;
	}
}
