//Socket connection in Graphics System
socket.on("quiz", msg_recieved);

var richtige_antwort;
var gewaehlte_antwort;

function msg_recieved(data) {
	if (data.message_name == "new_question") {
		console.log(data);
		//For Testing only nice animations will follow inside eventhandler_quiz.js

		startRound(data.type);
		$("#frage").html(data.frage);
		$("#antwort_a").html(data.antwort_a);
		$("#antwort_b").html(data.antwort_b);
		$("#antwort_c").html(data.antwort_c);
		$("#antwort_d").html(data.antwort_d);

		richtige_antwort = data.richtige_antwort;
	}

	if (data.message_name == "select_answer") {
		console.log(data);
		lock(data.selected.toLowerCase());
	}

	if (data.message_name == "wrong_answer") {
		console.log(data);
		showWrong(data.selected.toLowerCase());
	}

	if (data.message_name == "right_answer") {
		console.log(data);
		showRight(data.selected.toLowerCase());
	}

	if (data.message_name == "update_points") {
		$("#points_elfs").html(data.elfen);
		$("#points_dwarfs").html(data.zwerge);
	}

	if (data.message_name == "guess_show") {
		showCorrectGuess(data.winner, data.loser, data.correct, data.howmany);
	}

	if (data.message_name == "update_team") {
		setTeam(data.team);
	}

	if (data.message_name == "guess_transmit") {
		lockM(data.team, data.value);
	}
}
