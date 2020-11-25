var socket = io.connect("ws://localhost:3000");

var right_answer;
var selected_answer;
var punkte;
var type;
function send_question(nummer) {
	var frage = $("#frage_" + nummer).text();

	var a = $("#a_" + nummer).text();
	var b = $("#b_" + nummer).text();
	var c = $("#c_" + nummer).text();
	var d = $("#d_" + nummer).text();

	var richtig = $("#richtig_" + nummer).text();
	type = $("#typ_" + nummer).text();

	right_answer = richtig;
	punkte = parseInt($("#punkte_" + nummer).text());

	console.log(frage);
	var json = {
		message_name: "new_question",

		frage: frage,
		antwort_a: a,
		antwort_b: b,
		antwort_c: c,
		antwort_d: d,
		type: type,
		richtige_antwort: richtig,
	};

	socket.emit("quiz", json);
}

function einloggen(antwort) {
	selected_answer = antwort;

	console.log("logge ein " + antwort);
	var json = {
		message_name: "select_answer",
		selected: antwort,
	};

	socket.emit("quiz", json);
}

function aufloesen() {
	console.log("Löse auf");

	if (type == "multiple") {
		var active_team = $("#active_team").val();
		if (right_answer == selected_answer) {
			var json = {
				message_name: "right_answer",
				selected: right_answer,
			};

			var p_old = parseInt($("#punkte_" + active_team).val());
			var p_new = p_old + punkte;

			$("#punkte_" + active_team).val(p_new);
		} else {
			var json = {
				message_name: "wrong_answer",
				selected: selected_answer,
			};

			if (active_team == "elf") {
				$("#active_team option[value='dwarf']").attr("selected", true);
			} else {
				$("#active_team option[value='elf']").attr("selected", true);
			}
		}

		socket.emit("quiz", json);
	} else {
	}
}

function calc_abstand() {
	console.log(type);
	if (type == "guess") {
		var elfenguess = parseInt($("#guess_elf").val());
		var zwergeguess = parseInt($("#guess_dwarf").val());

		var richtig_int = parseInt(right_answer);

		var elfenabstand = Math.abs(richtig_int - elfenguess);
		var zwergenabstand = Math.abs(richtig_int - zwergeguess);

		$("#elfenabstand").html(elfenabstand);
		$("#zwergenabstand").html(zwergenabstand);

		if (elfenabstand < zwergenabstand) {
			$("#winner").html("elf");
		} else if (elfenabstand > zwergenabstand) {
			$("#winner").html("dwarf");
		} else {
			$("#winner").html("both");
		}
	}
}

function guess_aufloesen() {
	var elfenguess = parseInt($("#guess_elf").val());
	var zwergeguess = parseInt($("#guess_dwarf").val());

	var richtig_int = parseInt(right_answer);

	var elfenabstand = Math.abs(richtig_int - elfenguess);
	var zwergenabstand = Math.abs(richtig_int - zwergeguess);

	if (elfenabstand < zwergenabstand) {
		var json = {
			message_name: "guess_show",
			winner: "elf",
			loser: "dwarf",
			correct: richtig_int,
			howmany: 1,
		};

		var p_old = parseInt($("#punkte_elf").val());
		var p_new = p_old + punkte;
		$("#punkte_elf").val(p_new);
	} else if (elfenabstand > zwergenabstand) {
		var json = {
			message_name: "guess_show",
			loser: "elf",
			winner: "dwarf",
			correct: richtig_int,
			howmany: 1,
		};

		var p_old = parseInt($("#punkte_dwarf").val());
		var p_new = p_old + punkte;
		$("#punkte_dwarf").val(p_new);
	} else {
		var json = {
			message_name: "guess_show",
			loser: "elf",
			winner: "dwarf",
			correct: richtig_int,
			howmany: 2,
		};
		var p_old = parseInt($("#punkte_elf").val());
		var p_new = p_old + punkte;
		$("#punkte_elf").val(p_new);

		var p_old = parseInt($("#punkte_dwarf").val());
		var p_new = p_old + punkte;
		$("#punkte_dwarf").val(p_new);
	}

	socket.emit("quiz", json);
}

function guess_transmit(team) {
	var elfenguess = parseInt($("#guess_elf").val());
	var zwergenguess = parseInt($("#guess_dwarf").val());

	if (team == "elf") {
		var guess = elfenguess;
	} else {
		var guess = zwergenguess;
	}
	var json = {
		message_name: "guess_transmit",
		team: team,
		value: guess,
	};

	socket.emit("quiz", json);
}

function punkte_aktualisieren() {
	var elfen = $("#punkte_elf").val();
	var zwerge = $("#punkte_dwarf").val();
	console.log("aktualisiere Punkte");
	var json = {
		message_name: "update_points",
		elfen: elfen,
		zwerge: zwerge,
	};

	socket.emit("quiz", json);
}

function update_active_team() {
	var active_team = $("#active_team").val();
	var json = {
		message_name: "update_team",
		team: active_team,
	};

	socket.emit("quiz", json);
}
