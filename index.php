<?php 
session_start();
session_destroy();
//use for header/footer here
include ("common.php");
headerInfo();
?>
	<section id="center">
		<article class="info">
			<ol>
				<li>Record all your worries here (Hint: Start with your "What if...")</li>
				<li>Worry Wart contemplates your worries for you all night and all day, so you can work and sleep easily.</li>
				<li>Access your worries whenever you need to</li>
				<li>Tell Worry Wart which worries have come true, and which you are officially "over".</li>
				<li>Record new worries as needed and delete old ones.</li>
				<!-- <li>Graph your worries over time: which came true, which are current, and which never happened anyway.</li> -->
			</ol>	
		</article>
		<section class="forms">
			<section id="SignIn">
				<h3>Sign In</h3>
				<form class="loginform" action="worries.php" method="post">
					<div><input name="username" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
					<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
					<div><input type="submit" value="Log in" /></div>
				</form>
			</section>
			<section id="CreateUser">
				<h3>Create a New Account</h3>
				<form class="loginform" action="createUser.php" method="post">
					<div><input name="username" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
					<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
					<div><input type="submit" value="Sign Up" /></div>
				</form>
			</section>
		</section>
	</section>
		<footer id="footer">
			<article id="insidefooter"></article>
		</footer>
	</body>
</html>
