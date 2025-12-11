<?php
session_start();
class Controller
{
	private $db_server = 'localhost';

	// private $db_username = 'velloxaw_default';
	// private $db_name = 'velloxaw_charity';
	// private $db_password = 'Primestar1$';

	private $db_username = 'root';
	private $db_password = '';
	private $db_name = 'povert';
	public $conn;

	public function __construct() {
		try {
		  $this->conn = @new PDO("mysql:host=$this->db_server;dbname=$this->db_name", $this->db_username, $this->db_password);
		  // set the PDO error mode to exception
		  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  //echo "Connected successfully";
		} catch(PDOException $e) {
		  echo "Connection failed: " . $e->getMessage();
		  exit;
		}
	}

	// Home Causes
	public function home_causes() {
		$sql = 'SELECT * FROM causes ORDER BY rand() LIMIT 3';
		$query = $this->conn->prepare($sql);
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}
	// Get Causes
	public function causes() {
		$sql = 'SELECT * FROM causes ORDER BY rand()';
		$query = $this->conn->prepare($sql);
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}

	// Single Cause
	public function single_cause($cause_id) {
		$sql = "SELECT * FROM causes WHERE cause_id = '$cause_id'";
		$query = $this->conn->prepare($sql);
		$query->execute();
		$data = $query->fetch();
		return $data;
	}

	
	// Get Donations
	public function donations() {
		$sql = 'SELECT * FROM donations ORDER BY id DESC';
		$query = $this->conn->prepare($sql);
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}

	// Get Faqs
	public function faqs() {
		$sql = 'SELECT * FROM faqs ORDER BY rand()';
		$query = $this->conn->prepare($sql);
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}

	// Payment methods
	public function payment_info() {
		$sql = 'SELECT * FROM payment_info ORDER BY rand()';
		$query = $this->conn->prepare($sql);
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}

	// Payment methods
	public function popup_donations() {
		$sql = 'SELECT * FROM popups ORDER BY rand()';
		$query = $this->conn->prepare($sql);
		$query->execute();
		$data = $query->fetchAll();
		return $data;
	}
}
?>