<?php require("scripts/php/session.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<link type="text/css" href="style.css" rel="stylesheet" />
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
	</head>
	<body>
		<div class='box'>
			<form action="pages/php/login.php" method="post">
				Entrez votre mot de passe: <br>
				<input type="text" id="mdp" name="mdp" size="10" minlength="2"><br><br>
				<button>Submit</button>
			</form>
		</div>
	</body>
</html>