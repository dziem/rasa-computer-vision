<!DOCTYPE html>
<html>
    <head>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>The Chat Platfom</title>
	</head>
	
	<body>
		<!--Loading & Login Form-->
		<div id="loader">
			<div class="loader"></div>
			<form id="login-form">
				<i class="fa fa-times" id="close-button" aria-hidden="true"></i>
				<h3>Login</h3>
				<input type="text" name="username" placeholder="Username">
				<input type="password" name="password" placeholder="Password">
				<button id="submit">Log In</button>
			</form>
		</div>
		<!--End Loading & Login Form-->
		<!--Header-->
		<header class="row">
			<h2 class="col">The Bot</h2>
			<p class="col text-right">
				<span id="login">Login</span>
				<span id="logout">Logout</span>
			</p>
		</header>
		<!--End Header-->
		<!--Chat Body-->
		<div id="cb">
			<div class="container">
				
			</div>
		</div>
		<!--End Chat Body-->
		<!--Type Area-->
		<footer>
			<div class="row">
				<div class="col-image">
					<label class="custom-file-upload">
						<input type="file" id="image-upload" type="file" accept=".png, .jpg, .jpeg" capture="camera"/>
						<i class="fa fa-picture-o fa-2x"></i>
					</label>
				</div>
				<div class="col">
					<input type="text" id="message-box">
				</div>
				<div class="col-send">
					<p type="submit" id="submit-message">
						<i class="fa fa-2x fa-arrow-circle-right" aria-hidden="true"></i>
					</p>
				</div>
			</div>
		</footer>
		<!--End Type Area-->
		<!--Javascript-->
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/js.cookie.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>