<?php

class Database {
	function __construct() {
		$this->db = $db = new SQLite3("ticket.db");
	}

	function connect() {
		return True;
	}

	function get_values($data) {
		$ret = $this->db->query("DESCRIBE ticket");
		foreach ($row = $ret->fetchArray() as $value) {
			echo $value['Field'];
		}
	}

	function update_values($data) {
		return True;
	}

	function delete_values($data) {
		return True;
	}

	function insert_ticket($data) {
		$query = "INSERT INTO ticket (task_title, task_description, task_date, task_send_status, user_tg_id, ticket_status)
		VALUES ('" . htmlspecialchars($data['title']) . "', '" . htmlspecialchars($data['desc']) . "', '" . htmlspecialchars($data['date']) . "', 1, 415746338, 'primary')";
		if (!($data['title']) && !($data['desc']) && !($data['date'])) {
			header('location: index.php');
		} else {
			$this->db->exec($query);
			header('location: index.php', "Refresh:0");
		}
	}
	function get_ticket() {
		$arr = [];
		$ret = $this->db->query("SELECT * FROM ticket ORDER BY id DESC");
		for ($i = 0; $i < $row = $ret->fetchArray(); $i++) {
			$arr[$i] = [
				'id' => $row['id'],
				'title' => $row['task_title'],
				'desc' => $row['task_description'],
				'date' => strtotime($row['task_date']),
				'status' => strtotime($row['task_send_status']),
				'ticket_status' => $row['ticket_status'],
			];
		}
		return $arr;
	}
	function expired_ticket() {
		$arr = [];
		$ret = $this->db->query("SELECT * FROM ticket ORDER BY task_date ASC LIMIT 3");
		for ($i = 0; $i < $row = $ret->fetchArray(); $i++) {

			$normaltime = strtotime(date("Y-m-d H:i")) + 10800;
			if ($normaltime < strtotime($row['task_date'])) {
				$arr[$i] = [
					'id' => $row['id'],
					'title' => $row['task_title'],
					'desc' => $row['task_description'],
					'date' => strtotime($row['task_date']),
					'status' => strtotime($row['task_send_status']),
					'ticket_status' => $row['ticket_status'],
				];
			}
		}
		return $arr;
	}

	function send_tg_ticket() {

		$ret = $this->db->query("SELECT * FROM ticket WHERE task_send_status = 1");
		for ($i = 0; $i < $row = $ret->fetchArray(); $i++) {

			if ($row['task_send_status'] == 1) {
				file_get_contents("https://api.telegram.org/bot[BOT_TOCKEN]&text=Название:\n" . $row['task_title'] . "\n Описание:\n" . $row['task_description']);
				$this->db->exec("UPDATE ticket SET task_send_status = 0 WHERE task_send_status = 1");
			}
		}
	}

	function delete_ticket($data) {
		$this->db->exec("DELETE FROM ticket WHERE id = $data");
	}

	function change_ticket_status($status, $data) {
		$this->db->exec("UPDATE ticket SET ticket_status = '" . $status . "' WHERE id = $data");
	}
}

$connectDatabaase = new Database();
