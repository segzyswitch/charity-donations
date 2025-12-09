<?php
require '../functions/Controller.php';
$Controller = new Controller;
$conn = $Controller->conn;

if (isset($_GET['get_donations'])) {
	$sql = 'SELECT * FROM popups ORDER BY rand()';
	$query = $conn->prepare($sql);
	try {
		$query->execute();
		$row = $query->fetch();
		// print_r($row);
		// return false;
		if ($row == null) {
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

// make donation

// Add donation
if (isset($_POST['make_donation'])) {
	$amount = filter_var($_POST["amount"], FILTER_SANITIZE_STRING);
	$payment_method = filter_var($_POST["payment_method"], FILTER_SANITIZE_EMAIL);
	$email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);

	$files = $_FILES['images'];
	$uploadDir = "../assets/images/resources/";

	try {
		// Start transaction
		$conn->beginTransaction();
		// 1️⃣ Insert into donations
		$stmt = $conn->prepare("
			INSERT INTO donations (amount, email, payment_method)
			VALUES (:amount, :email, :payment_method)
		");
		$stmt->execute([
			':amount' => $amount,
			':email' => $email,
			':payment_method' => $payment_method
		]);
		// 2️⃣ Last inserted donation ID
		$donationId = $conn->lastInsertId();
		// 3️⃣ Handle multiple file uploads
		foreach ($files['tmp_name'] as $key => $tmp_name) {
			// Check for upload errors
			if ($files['error'][$key] !== 0) {
				// throw new Exception("Upload error for file: " . $files['name'][$key]);
				print_r($files['name'][$key]);
				continue; // Skip this file and continue with the next
			}

			$originalName = $files['name'][$key];
			// Unique name
			$newName = time() . "_" . rand(1000, 9999) . "_" . $originalName;
			// Move uploaded image
			if (!move_uploaded_file($tmp_name, $uploadDir . $newName)) {
				throw new Exception("Failed to upload file: " . $originalName);
			}
			// 4️⃣ Insert file record
			$stmtFile = $conn->prepare("
				INSERT INTO donation_files (donation_id, filename, file_path)
				VALUES (:donation_id, :filename, :file_path)
			");

			$stmtFile->execute([
				':donation_id' => $donationId,
				':filename' => $newName,
				':file_path' => $uploadDir . $newName
			]);
		}

		// Commit transaction
		$conn->commit();

		// return [
		// 	"status" => true,
		// 	"message" => "Donation and files saved successfully",
		// 	"donation_id" => $donationId
		// ];
		echo "Donation successful, thank you for reaching out to the needy, we will update you via email!";

	} catch (Exception $e) {

		// Rollback on error
		$conn->rollBack();

		// return [
		// 	"status" => false,
		// 	"message" => $e->getMessage()
		// ];

		echo $e->getMessage();
	}
}
?>