<?php
require '../functions/Controller.php';
$Controller = new Controller;
$conn = $Controller->conn;

if (isset($_GET['get_donations'])) {
	$sql = 'SELECT * FROM donations ORDER BY rand()';
	$query = $conn->prepare($sql);
	try {
		$query->execute();
		$row = $query->fetch();
		// print_r($row);
		// return false;
		if ( $row == null ) {
			exit;
		}
		?>
			<div class="w-100 d-flex">
				<div class="my-auto"><i style="font-size:1.5em;" class="bi bi-heart-fill"></i></div>
			  <div class="pl-2 text-white text-right my-auto">
			  	<p class="m-0 text-white"><?php echo $row['text']; ?></p>
			  </div>
			</div>
		<?php
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}
?>