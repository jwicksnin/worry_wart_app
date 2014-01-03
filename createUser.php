<?php
session_start();
$db = new PDO("mysql:dbname=worry", "username", "pword");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
	$username = $_POST["username"];
	$password = $_POST["password"];
	//echo $username;

	$stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
	$newUser = $stmt->execute(array(':username'=>$username,':password'=>$password));
	$stmt4 = $db->prepare("SELECT id FROM users WHERE (username = :username AND password = :password)");
	$stmt4->execute(array(':username'=>$username, ':password'=>$password));
	$user = $stmt4->fetch();
	if ($user) {
	$_SESSION["id"] = $user["id"];

	$id = $_SESSION["id"];
}
	$stmt2 = $db->prepare("CREATE TABLE $username (worry_id INT NOT NULL AUTO_INCREMENT,worries VARCHAR(30) NOT NULL, PRIMARY KEY (worry_id))");
	$newTable = $stmt2->execute();
	$stmt3 = $db->prepare("INSERT INTO results (user_id, over_it, current, came_true)
	VALUES ($id,0,0,0)");
	$newColumn = $stmt3->execute();

	if ($newUser && $newTable && $newColumn) {
		
		?>
		<section id="SignIn">
			<h3>Congrats On Your New Account!</h3>
			<h3>Please Sign In</h3>
			<form id="loginform" action="worries.php" method="post">
				<div><input name="username" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
				<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
				<div><input type="submit" value="Log in" /></div>
			</form>
		</section> <?php
	} else {
		echo "Error: Please try again."; ?>
		<section id="CreateUser">
			<h3>Create a New Account</h3>
			<form id="loginform" action="createUser.php" method="post">
				<div><input name="username" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
				<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
				<div><input type="submit" value="Sign Up" /></div>
			</form>
		</section> <?php
	}
	?>
