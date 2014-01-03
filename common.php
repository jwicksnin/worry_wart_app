<?php 
function headerInfo() { ?>
<!DOCTYPE html>
<html>
	<head> 
		<meta name="discription" content="Worry Wart - We Worry So You Don't Have To!">
		<meta name="keywords" content="anxiety, worry, worried, fret, insomina, relax, sleep">
		<meta name="author" content="Jessica Wicksnin">
		<meta charset="UTF-8">
		<title>Worry Wart</title> 
		<link href="worrywart.css" type="text/css" rel="stylesheet" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
	</head> 

	<body> 
		<header id="header">
			<a href="/"><img src="logo.png"></a>
			<?php if (isset($_SESSION["username"])) { ?>
			<a href="logout.php">Log Out</a>
			<?php } else { ?>
			<a href="#SignIn">Sign In</a>
			<a href="createUser.php">Create Account</a>
			<?php } ?>
			<h1>Welcome to Worry Wart</h1>
			<h3>We Worry So You Don't Have To</h3>
		</header>
<?php } ?>
