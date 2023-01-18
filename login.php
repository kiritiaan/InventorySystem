<?php

session_start();
if (isset($_SESSION['userId'])) {
	header('location:dashboard.php');
}

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "aar9speed";
$store_url = "";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if ($connect->connect_error) {
	die("Connection Failed : " . $connect->connect_error);
} else {
	// echo "Successfully connected";
}


$errors = array();


if ($_POST) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	$username = str_replace(' ', '', $username);

	if (empty($username) || empty($password)) {
		if ($username == "" || $password == "") {
			$errors[] = "All field is required, please try again!";
		}
	} else {
		$sql = "SELECT * FROM staff WHERE STAFF_USER = '$username'";
		$result = $connect->query($sql);

		if ($result->num_rows == 1) {

			// exists
			$mainSql = "SELECT * FROM staff WHERE STAFF_USER = '$username' AND staff_pass = '$password'";
			$mainResult = $connect->query($mainSql);

			if ($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['STAFF_USER'];

				// set session
				$_SESSION['userId'] = $username;
				$_SESSION['getId'] = $value['STAFF_ID'];



				header('location:dashboard.php');
			} else {
				$errors[] = "Incorrect username/password combination!, please try again!";
			} // /else
		} else {
			$errors[] = "Username does not exists!";
		} // /else
	} // /else not empty username // password

} // /if $_POST


?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/login.css">
	<?php include_once "./site/title.php" ?>
	<script src="./scripts/sweetalert.min.js"></script>
</head>

<body>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<div class="Box">

			<img src="Img/Logo.png" srcset="" width="400px">

			<input type="text" placeholder="USERNAME" name="username" autocomplete="off">
			<input type="password" placeholder="PASSWORD" name="password" autocomplete="off">
			<div class="messages">
				<?php if ($errors) : ?>

					<?php foreach ($errors as $key => $value) : ?>

						<script>
							swal({


								title: "INVALID CREDINTIALS",
								text: "<?php echo $value ?>",
								button: "Okay",
							});
						</script>

					<?php endforeach; ?>

				<?php endif; ?>

			</div>
			<button type="submit">LOGIN</button>
		</div>
	</form>

</body>

</html>