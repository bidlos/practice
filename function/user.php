<?php
require_once __DIR__ . '/db.php';

class LoginClass extends Database {
	function login($data) {
		$ret = $this->db->query("SELECT * FROM user WHERE user_name = '" . $data['login'] . "' AND user_pass = '" . $data['pass'] . "'");
		$row = $ret->fetchArray();
		$_SESSION = [
			'login' => $row['2'],
			'pass' => $row['3'],
		];
		return $_SESSION;
	}
}

$LoginClass = new LoginClass();