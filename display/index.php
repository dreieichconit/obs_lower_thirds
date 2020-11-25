<?php
	if(isset($_GET['stream_id'])){
		echo"<script> var stream_id = " . $_GET['stream_id'] . ";</script>";
	}else{
		echo"<script> var stream_id = 1; </script>";
	}


?>

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="display.css" />
		<link
			href="https://fonts.googleapis.com/css2?family=Coda&display=swap"
			rel="stylesheet"
		/>
		<link
			href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
			rel="stylesheet"
		/>
		<title>Screen for Streamer</title>
	</head>
	<body>
		<div class="wrapper">
			<div class="top">
				<div class="programbox">
					<div class="program subbox half space dropshadow">
						<div id="nowtitle" class="programtitle">
							NOW PLAYING
						</div>
						<div id="nowdata" class="programdata">
							Bernhard Hennen & Robert Corvus - Phileasson Saga
						</div>
					</div>
					<div class="program subbox half">
						<div id="nexttitle" class="programtitle">NEXT UP</div>
						<div id="nextdata" class="programdata">
							Verleihung Nerds gegen Stephan
						</div>
					</div>
				</div>
				<div class="timerbox">
					<div class="timer subbox half space dropshadow">
						<div id="currenttime" class="time">00:00:00</div>
					</div>
					<div class="timer subbox half">
						<div id="elapsedtime" class="time timeokay">
							00:00:00
						</div>
					</div>
				</div>
			</div>
			<div class="bottom">
				<div class="questionbox">
					<div class="subbox small smalltitle">QUESTIONS</div>
					<div
						id="questions"
						class="text subbox max dropshadow"
					></div>
				</div>
				<div class="notesbox">
					<div class="subbox small smalltitle">NOTES</div>
					<div id="comments" class="text subbox max dropshadow"></div>
				</div>
			</div>
		</div>
		<script
			src="https://code.jquery.com/jquery-3.5.1.js"
			integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			crossorigin="anonymous"
		></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.5/socket.io.min.js"></script>
		<script
			src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"
			integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="
			crossorigin="anonymous"
		></script>
		<script src="../websocket-server.js"></script>
		<script src="eventhandler.js"></script>
		<script src="clock.js"></script>

		<script src="socket.js"></script>
	</body>
</html>
