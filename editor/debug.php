<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="initial-scale=1.0" />
		<title>Testing for animation</title>
		
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
			integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
			crossorigin="anonymous"
		/>
		<style>
			@font-face {
				font-family: charlemagne;
				src: url(./fonts/charlemagne.otf);
			}
		</style>
	</head>

	<body>

	<h1>Stream-ID</h1>
	<input type="text" name="streamid" id="streamid" value="1">
	<br><hr>
			<h1>Bauchbinde</h1>
			Line 1: <input type="text" name="line1" id="line1" value="Hallo Welt"><br>
			Line 2: <input type="text" name="line2" id="line2" value="ich bin ein Test"><br>
			Character:<select name="char" id="char">
					<option value="elf">Elfe</option>
					<option value="dwarf">Zwerg</option>
					<option value="dragon">Drache</option>
			</select>
			<br>
			Duration: <input type="number" name="dur" id="dur" value="4000">
			<br>
			Type:
			<select name="type" id="type">
				<option value="frage">Frage</option>
				<option value="name" selected>Name</option>
			</select>
<br>
	<button onClick="emit()">Klick mich</button>
		
	<br><hr>

<h1>Frage</h1>
	Fragesteller: <input type="text" name="wer" id="wer" value="Max Mustermann"><br>
	Frage: <input type="text" name="was" id="was" value="Musterfrage"><br>
	ID: <input type="text" name="id" id="id" value="1255"><br>
			
<br>
	<button onClick="emit_1()">Frage hinzufügen</button>
	<button onClick="emit_2()">Frage löschen</button>
		

<br><hr>

<h1>Notiz</h1>
	Notiz: <input type="text" name="note" id="note" value="Popel an der Nase"><br>
	ID: <input type="text" name="id2" id="id2" value="125"><br>
			
<br>
	<button onClick="emit_3()">Notiz hinzufügen</button>
	<button onClick="emit_4()">Notiz löschen</button>
		
	<br><hr>

<h1>Countdown</h1>
	Zielzeit: <input type="text" name="zeit" id="zeit" value=""><br>
			
<br>
	<button onClick="emit_initc()">Countdown setzen & starten</button>
	<button onClick="emit_startc()">Countdown starten</button>
	<button onClick="emit_stopc()">Countdown pausieren</button>
		




	<h1>Tweettest</h1>
	<input type="text" name="tweet" id="tweet" value="" maxlength="280"><br>
			
<br>
	<button onClick="tweeeet()">Zwitschern</button>


	<h1>Announce (Twitter und Discord)</h1>
	Msg: <input type="text" name="ann_msg" id="ann_msg" value="" maxlength="280"><br>
	Server-ID: <input type="text" name="serverid" id="serverid" value="727506739787989045" maxlength="280"><br>
			
<br>
	<button onClick="ann()">Zwitschern</button>


		
		

		<script
			src="https://code.jquery.com/jquery-3.5.1.js"
			integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			crossorigin="anonymous"
		></script>

		<script
			src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
			integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
			crossorigin="anonymous"
		></script>
		<script src="../websocket-server.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.5/socket.io.min.js"></script>
		<script src="secret.js"></script>
		<script src="socket.js"></script>
		
			

			
			/*
	console.log(data);
	var line1 = data.line1;
	var line2 = data.line2;
	var char = data.char;
	var dur = data.dur;
	var type = data.type;

	fadeIn(line1, line2, char, dur, type);
			*/
		</script>
	</body>
</html>
