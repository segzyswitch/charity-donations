<?php
require '../functions/Controller.php';
$Controller = new Controller;
$conn = $Controller->conn;


if ( isset($_POST["admin_login"]) ) {
	$auth_username = filter_var($_POST["auth_username"], FILTER_SANITIZE_STRING);
	$auth_pwd = filter_var($_POST["auth_pwd"], FILTER_SANITIZE_STRING);

	$authorize = $conn->prepare("SELECT * FROM admin_user");
	try {
		$authorize->execute();
		$ck_auth = $authorize->fetch();

		if ( $auth_username !== $ck_auth['username'] ) {
			?>
	    	<div class="alert alert-danger">
	    		<p><i class="fa fa-exclamation-circle"></i> Error! Incorrect username, check and try again.</p>
	    	</div>
		  <?php
		}elseif ( !password_verify($auth_pwd, $ck_auth['password']) ) {
			?>
	    	<div class="alert alert-danger">
	    		<p><i class="fa fa-exclamation-circle"></i> Error! Incorrect password, check and try again.</p>
	    	</div>
		  <?php
		}else {
			$_SESSION['charityDonationsAdmin'] = md5($auth_username);
			?>
	    	<div class="alert alert-success">
	    		<p><i class="fa fa-hourglass fa-spin"></i> Success, You will be redirected shortly.</p>
	    	</div>
		  <?php
		  // header("Location: post-job.php");
		}
	}catch( PDOException $e ) {
		echo $e->getMessage();
	}
}

// Add donation
if ( isset($_POST['add_donation']) ) {
	$title = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
	$amount = filter_var($_POST["amount"], FILTER_SANITIZE_EMAIL);
	$amount_raised = filter_var($_POST["amount_raised"], FILTER_SANITIZE_STRING);
	$donors = filter_var($_POST["donors"], FILTER_SANITIZE_STRING);
	$details = filter_var($_POST["details"], FILTER_SANITIZE_STRING);
	$cause_date = filter_var($_POST["cause_date"], FILTER_SANITIZE_STRING);

	$cause_id = strtoupper( substr(str_shuffle(md5($title)), 8, 6).rand(1000, 9999) );

	if ($amount_raised > $amount) {
		?>
			<div class="alert alert-danger">
				<p><i class="bi bi-exclamation-circle"></i> Amount cannot be less than amount raised.</p>
			</div>
		<?php
		return false;
	}

	$banner_name = $_FILES['banner']['name'];
	$banner_tmp_file = $_FILES["banner"]["tmp_name"];
	$target_dir = "../assets/images/resources/";
	$banner_target_file = $target_dir . $banner_name;

	if ( move_uploaded_file($banner_tmp_file, $banner_target_file) ) {
		$sql = "INSERT INTO causes(cause_id, title, banner, amount, amount_raised, donors, details)
		VALUES('$cause_id', '$title', '$banner_name', '$amount', '$amount_raised', '$donors', '$details')";
		$query = $conn->prepare($sql);
		try {
			$query->execute();
		  ?>
			<div class="alert alert-success">
				<p><i class="bi bi-check"></i> Upload successful!</p>
			</div>
		  <?php
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}else {
		?>
			<div class="alert alert-danger">
				<p><i class="bi bi-exclamation-circle"></i> Sorry. File upload error, try again.</p>
			</div>
		<?php
	}
}
// Update donation
if ( isset($_POST["update_donation"]) ) {
	$cause_id = $_POST["update_donation"];

	$title = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
	$amount = filter_var($_POST["amount"], FILTER_SANITIZE_EMAIL);
	$amount_raised = filter_var($_POST["amount_raised"], FILTER_SANITIZE_STRING);
	$donors = filter_var($_POST["donors"], FILTER_SANITIZE_STRING);
	$details = filter_var($_POST["details"], FILTER_SANITIZE_STRING);
	$cause_date = filter_var($_POST["cause_date"], FILTER_SANITIZE_STRING);

	$banner_name = $_FILES['banner']['name'];
	$banner_tmp_file = $_FILES["banner"]["tmp_name"];
	$target_dir = "../assets/images/resources/";
	$banner_target_file = $target_dir . $banner_name;

	if ($amount_raised > $amount) {
		?>
			<div class="alert alert-danger">
				<p><i class="bi bi-exclamation-circle"></i> Amount cannot be less than amount raised.</p>
			</div>
		<?php
		return false;
	}

	if ( $banner_name ) {
		if ( move_uploaded_file($banner_tmp_file, $banner_target_file) ) {
			$sql = "UPDATE causes SET title='$title',
				banner='$banner_name', amount='$amount',
				amount_raised='$amount_raised',
				donors='$donors', details='$details'
			WHERE cause_id='$cause_id'";
		}else {
			?>
				<div class="alert alert-danger">
					<p><i class="bi bi-exclamation-circle"></i> Sorry. File upload error, try again.</p>
				</div>
			<?php
			return false;
		}
	}else {
		$sql = "UPDATE causes SET title='$title', amount='$amount', amount_raised='$amount_raised', donors='$donors', details='$details' WHERE cause_id='$cause_id'";
	}

	$query = $conn->prepare($sql);
	try {
		$query->execute();
	  ?>
		<div class="alert alert-success">
			<p><i class="bi bi-check"></i> Update successful!</p>
		</div>
	  <?php
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}
// Delete donation
if ( isset($_GET["delete_cause"]) ) {
	$cause_id = $_GET["delete_cause"];
	$check = $conn->prepare("SELECT * FROM causes WHERE cause_id = '$cause_id'");
	$check->execute();
	$row = $check->fetch();

	$banner_file = "../assets/images/resources/".$row['banner'];

	unlink($banner_file);

	$sql = "DELETE FROM causes WHERE cause_id = '$cause_id'";
	try {
		$query = $conn->prepare($sql);
		$query->execute();
		echo 'Selection deleted';
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}


// Paymets
if ( isset($_POST['add_payment']) ) {
	$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$tag = filter_var($_POST["tag"], FILTER_SANITIZE_STRING);

	$banner_name = $_FILES['banner']['name'];
	$banner_tmp_file = $_FILES["banner"]["tmp_name"];
	$target_dir = "../assets/images/";
	$banner_target_file = $target_dir . $banner_name;

	if ( move_uploaded_file($banner_tmp_file, $banner_target_file) ) {
		$sql = "INSERT INTO payment_info(name, icon, tag)
		VALUES('$name', '$banner_name', '$tag')";
		$query = $conn->prepare($sql);
		try {
			$query->execute();
		  ?>
			<div class="alert alert-success">
				<p><i class="bi bi-check"></i> Added successful!</p>
			</div>
		  <?php
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}else {
		?>
			<div class="alert alert-danger">
				<p><i class="bi bi-exclamation-circle"></i> Sorry. File upload error, try again.</p>
			</div>
		<?php
	}
}
// Delete
if ( isset($_GET["delete_payment"]) ) {
	$cause_id = $_GET["delete_payment"];
	$check = $conn->prepare("SELECT * FROM payment_info WHERE id = '$cause_id'");
	$check->execute();
	$row = $check->fetch();

	$banner_file = "../assets/images/".$row['icon'];

	unlink($banner_file);

	$sql = "DELETE FROM payment_info WHERE id = '$cause_id'";
	try {
		$query = $conn->prepare($sql);
		$query->execute();
		echo 'Selection deleted';
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}
// Update
if ( isset($_POST["edit_payment"]) ) {
	$pay_id = $_POST["edit_payment"];

	$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$tag = filter_var($_POST["tag"], FILTER_SANITIZE_STRING);

	$banner_name = $_FILES['banner']['name'];
	$banner_tmp_file = $_FILES["banner"]["tmp_name"];
	$target_dir = "../assets/images/";
	$banner_target_file = $target_dir . $banner_name;

	if ( $banner_name ) {
		if ( move_uploaded_file($banner_tmp_file, $banner_target_file) ) {
			$sql = "UPDATE payment_info SET name='$name', icon='$banner_name', tag='$tag'
			WHERE id='$pay_id'";
		}else {
			?>
				<div class="alert alert-danger">
					<p><i class="bi bi-exclamation-circle"></i> Sorry. File upload error, try again.</p>
				</div>
			<?php
			return false;
		}
	}else {
		$sql = "UPDATE payment_info SET name='$name', tag='$tag' WHERE id='$pay_id'";
	}

	$query = $conn->prepare($sql);
	try {
		$query->execute();
	  ?>
		<div class="alert alert-success">
			<p><i class="bi bi-check"></i> Update successful!</p>
		</div>
	  <?php
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}


// Popup donations
if ( isset($_POST['add_popup']) ) {
	$text = filter_var($_POST["text"], FILTER_SANITIZE_STRING);

	$sql = "INSERT INTO popups(`text`) VALUES('$text')";
	$query = $conn->prepare($sql);
	try {
		$query->execute();
	  ?>
		<div class="alert alert-success">
			<p><i class="bi bi-check"></i> Added successful!</p>
		</div>
	  <?php
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}
// Delete
if ( isset($_GET["delete_popup"]) ) {
	$cause_id = $_GET["delete_popup"];

	$sql = "DELETE FROM popups WHERE id = '$cause_id'";
	try {
		$query = $conn->prepare($sql);
		$query->execute();
		echo 'Selection deleted';
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}
// Update
if ( isset($_POST["edit_popup"]) ) {
	$pay_id = $_POST["edit_popup"];

	$text = filter_var($_POST["text"], FILTER_SANITIZE_STRING);

	$sql = "UPDATE popups SET `text`='$text'";

	$query = $conn->prepare($sql);
	try {
		$query->execute();
	  ?>
		<div class="alert alert-success">
			<p><i class="bi bi-check"></i> Update successful!</p>
		</div>
	  <?php
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}


if (isset($_GET['get_proof'])) {
	$donation_id = filter_var($_GET["get_proof"], FILTER_SANITIZE_STRING);
	try {
		$sql = "SELECT * FROM donation_files WHERE donation_id = :donation_id";
		$query = $conn->prepare($sql);
		$query->execute([':donation_id' => $donation_id]);
		$files = $query->fetchAll();

		if (!$files) {
			echo "<p>No proof of payment found.</p>";
			exit;
		}
		foreach ($files as $file) {
			$filePath = $file['file_path'];
			echo "<div class='mb-3'><img src='{$filePath}' alt='Proof Image' class='img-fluid' /></div>";
		}
	} catch (PDOException $e) {
		echo "Error fetching proof of payment: " . $e->getMessage();
	}
}
?>