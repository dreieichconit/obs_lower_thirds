var socket = io.connect(websocket_server_hostname);

function fadeIn(title, subtitle, character, duration, type) {
	$("#titleshadow").text(title);
	$("#title").text(title);
	$("#subtitleshadow").text(subtitle);
	$("#subtitle").text(subtitle);

	if (character === "elf") {
		$("#dwarf").css("opacity", 0);
		$("#neutral").css("opacity", 0);
		$("#elf").css("opacity", 100);
		$("#subtitle").css("color", "orange");
	} else if (character === "dwarf") {
		$("#elf").css("opacity", 0);
		$("#neutral").css("opacity", 0);
		$("#dwarf").css("opacity", 100);
		$("#subtitle").css("color", "lightblue");
	} else if (character === "neutral") {
		$("#elf").css("opacity", 0);
		$("#dwarf").css("opacity", 0);
		$("#neutral").css("opacity", 100);
		$("#subtitle").css("color", "teal");
	} else {
		$("#elf").css("opacity", 0);
		$("#dwarf").css("opacity", 0);
		$("#neutral").css("opacity", 100);
		$("#subtitle").css("color", "teal");
	}

	if (type === "frage") {
		$("#title").css("font-size", 25);
		$("#titleshadow").css("font-size", 25);
	} else if (type === "name") {
		$("#title").css("font-size", 50);
		$("#titleshadow").css("font-size", 50);
	}

	let slidetime = 1000; // time for the slide in animation in miliseconds
	let fadetime = 500; // time for the fade animation in miliseconds
	let smalldelay = 100; // time between slide in and
	let currentDelay = 0;

	// first slide in the background
	slide("#background", "in", slidetime, currentDelay);
	slide("#character", "in", slidetime, currentDelay);

	currentDelay += slidetime + smalldelay;

	// then show the text after the slide is complete
	fade("#fade", 100, fadetime, currentDelay);

	currentDelay += fadetime;
	currentDelay += duration;

	// then fade the text back out
	fade("#fade", 0, fadetime, currentDelay);

	currentDelay += slidetime + fadetime;

	// then fade the text back out
	slide("#background", "out", slidetime, currentDelay);
	slide("#character", "out", slidetime, currentDelay);

	currentDelay += slidetime;

	setTimeout(socket.emit("complete", "fertig"), currentDelay);
	console.log("fertig");
}

function fade(id, opacity, duration, delay) {
	$(`${id}`)
		.delay(delay)
		.animate(
			{
				opacity: `${opacity}`,
			},
			duration
		);
}

function slide(id, direction, duration, delay) {
	if (direction == "in") {
		target = 0;
	} else {
		target = 1000;
	}
	$(`${id}`)
		.delay(delay)
		.animate(
			{
				top: `${target}px`,
			},
			duration
		);
}
