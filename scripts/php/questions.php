<?php require("quest.php") ?>
<!DOCTYPE html>
<html>
	<head>
		<link type="text/css" href="style.css" rel="stylesheet" />
		<script src="script.js" ></script>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<p id="timer">TIME:∞</p>
		<div class='question' id="result">
			<div id="score"></div>
		</div>
		<div id="container" class="question active">
			<form>
				<div id="quest">
				</div>
				<button>Submit</button>
			</form>
		</div>
	</body>
</html>
