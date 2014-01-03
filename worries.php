<?php
session_start();
#start session and assign variables
if (!isset($_SESSION["username"])) {
	echo "is not set";
	$username = $_POST["username"];
	$password = $_POST["password"];
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;
} else {
	echo "is already set";
	$username = $_SESSION["username"];
	$password = $_SESSION["password"];
}
 
# connect to the database
$db = new PDO("mysql:dbname=worry", "root", "root");
if ($db) {
echo "horray2!";
}
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
#for testing purposes
if ($db) {
echo "horray!";
}
#find user's information in the database
$stmt = $db->prepare("SELECT username,password,id FROM users WHERE (username = :username AND password = :password)");
$stmt->execute(array(':username'=>$username, ':password'=>$password));
$user = $stmt->fetch();
if ($user) {
	$_SESSION["id"] = $user["id"];
	$id = $_SESSION["id"];
	//echo "this is the id: " . $_SESSION["id"];
	
	include ("common.php");
	headerInfo(); ?>
	<section id="center">
		<article>
			<ol>
				<li>Record all your worries here (Hint: Start with your "What if...")</li>
				<li>Worry Wart contemplates your worries for you all night and all day, so you can work and sleep easily.</li>
				<li>Access your worries whenever you need to</li>
				<li>Tell Worry Wart which worries have come true, and which you are officially "over".</li>
				<li>Record new worries as needed and delete old ones.</li>
				<!-- <li>Graph your worries over time: which came true, which are current, and which never happened anyway.</li> -->
			</ol>	
		</article>
		<section id="List">
			<h2>Welcome for, <?= $username ?></h2>
			<h3>Current Worries</h3>
			<?php $stmt = $db->prepare("SELECT worries, worry_id FROM $username");
			$stmt->execute(); 
			$stmt2 = $db->prepare("SELECT came_true,over_it FROM results WHERE user_id = $id");
			$stmt2->execute();
			$user2 = $stmt2->fetchObject();
			if ($user2) {
				echo "it works";
				echo $user2->came_true;
			}
			?>
			<ul id="worrylist">
				<?php 
				while ($row = $stmt->fetchObject()) { ?>
				<li>
					<pre><?php echo htmlspecialchars($row->worries); ?></pre>
					<form action="submit.php" method="post">
						<input type="hidden" name="user" value="<?= $username?>" />
						<input type="hidden" name="action" value="delete" />
						<input type="hidden" name="index" value="<?= $row->worry_id ?>" />
						<!-- <input type="radio" name="result" value="current" checked="checked"/> Current Worry<br> -->
						<input type="radio" name="result" value="over_it" checked="checked"/> Never happened<br>
						<input type="radio" name="result" value="came_true" /> Came True <br>
						<input type="submit" value="Remove" />
					</form>
				</li>
				<?php } ?>
				<li>
					<form action="submit.php" method="post">
						<input type="hidden" name="user" value="<?= $username ?>" />
						<input type="hidden" name="action" value="add" />
						<input name="item" type="text" size="25" autofocus="autofocus" />
						<input type="submit" value="Add" />
					</form>
				</li>
			</ul>
		</section>
		<article>
			<p> <?= $user2->came_true ?> worries have come true for you.</p>
			<p> <?= $user2->over_it ?> worries never happened.</p>
		</article>
	</section>
		<footer id="footer">
			<article id="insidefooter"></article>
		</footer>
	</body>
</html>
<?php } else {
		echo "Sorry!!! that username and password don't match.  Please create an account or try signing in again.";
		header("Location: index.php");
        die();
	} ?>
