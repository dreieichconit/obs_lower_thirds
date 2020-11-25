var socket = io.connect(websocket_server_hostname);

const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

var stream_id = urlParams.get("stream_id");

console.log("Loaded Stream: " + stream_id);

function onload_getProg() {
	console.log("Loading Current");
	$.get("load_current.php?stream_id=" + stream_id, {}, function (data) {
		$("#nowtitle").html(data.now.item_title_external);

		$("#nowdata").html(
			formatTime(data.now.item_start_planned) +
				" - " +
				formatTime(
					parseInt(data.now.item_duration_planned) +
						parseInt(data.now.item_start_planned)
				)
		);
		console.log(data.next);
		$("#nexttitle").html(data.next.item_title_external);

		$("#nextdata").html(
			formatTime(data.next.item_start_planned) +
				" - " +
				formatTime(
					parseInt(data.next.item_duration_planned) +
						parseInt(data.next.item_start_planned)
				)
		);

		loadBB(data.bb);
		//Transmitt Now & Next do display
		var json = {
			message_name: "nownext",
			streamid: stream_id,
			now: data.now.item_title_external,
			next: data.next.item_title_external,
		};
		socket.emit("msg", json);

		//Control timer

		zielzeit = timearray(
			parseInt(data.now.item_duration_planned) +
				parseInt(data.now.item_start_planned)
		);
		initializeCountdown();

		var json = {
			message_name: "set_time",
			streamid: stream_id,
			h: zielzeit.h,
			m: zielzeit.m,
			s: zielzeit.s,
		};
		socket.emit("msg", json);

		var json = {
			message_name: "init_countdown",
			streamid: stream_id,
		};
		socket.emit("msg", json);
	});
}

var current_item;
var next_item;

var b_ids = [];

function master_go() {
	console.log("Advancing...");
	$.get("set_next.php?stream_id=" + stream_id, {}, function (data) {
		$("#nowtitle").html(data.now.item_title_external);

		$("#nowdata").html(
			formatTime(data.now.item_start_planned) +
				" - " +
				formatTime(
					parseInt(data.now.item_duration_planned) +
						parseInt(data.now.item_start_planned)
				)
		);
		console.log(data.next);
		$("#nexttitle").html(data.next.item_title_external);

		$("#nextdata").html(
			formatTime(data.next.item_start_planned) +
				" - " +
				formatTime(
					parseInt(data.next.item_duration_planned) +
						parseInt(data.next.item_start_planned)
				)
		);

		loadBB(data.bb);
		//Transmitt Now & Next do display
		var json = {
			message_name: "nownext",
			streamid: stream_id,
			now: data.now.item_title_external,
			next: data.next.item_title_external,
		};
		socket.emit("msg", json);
		//Transmit Now & Next to Discord and Twitter

		var msg =
			"Just Testing now: " +
			"Now on #dcw_stream_" +
			stream_id +
			": " +
			data.now.item_title_external;
		var serverid = 0;

		var json = {
			secret: token,
			message: msg,
			serverid: serverid,
		};

		//socket.emit("announce", json);

		console.log("Sent announcement");

		//Control timer

		zielzeit = timearray(
			parseInt(data.now.item_duration_planned) +
				parseInt(data.now.item_start_planned)
		);
		initializeCountdown();

		var json = {
			message_name: "set_time",
			streamid: stream_id,
			h: zielzeit.h,
			m: zielzeit.m,
			s: zielzeit.s,
		};
		socket.emit("msg", json);

		var json = {
			message_name: "init_countdown",
			streamid: stream_id,
		};
		socket.emit("msg", json);
	});
}

function loadBB(data) {
	for (id of b_ids) {
		removeB(id);
	}

	for (line of data) {
		b_ids.push(line.lower_id);
		addB(
			line.lower_symbol,
			line.lower_line_1,
			line.lower_line_2,
			line.lower_id
		);
	}
}

function formatTime(time) {
	var date = new Date(time * 1000);
	var hours = date.getHours();
	var minutes = "0" + date.getMinutes();
	var seconds = "0" + date.getSeconds();
	var formattedTime =
		hours + ":" + minutes.substr(-2) + ":" + seconds.substr(-2);
	return formattedTime;
}

function timearray(time) {
	var date = new Date(time * 1000);
	var ret = [];
	ret["h"] = date.getHours();
	ret["m"] = date.getMinutes();
	ret["s"] = date.getSeconds();

	return ret;
}

function q_onair(id) {
	var wer = $("#u_" + id).text();
	var was = $("#q_" + id).text();
	var wann = $("#t_" + id).text();
	var char = $("#team_" + id).text();
	var streamid = $("#streamid").val();

	var json = {
		message_name: "lower_trigger",
		streamid: stream_id,
		line1: wer,
		line2: was,
		char: char,
		dur: 8000,
		type: "frage",
	};

	socket.emit("msg", json);
}

function q_transmit(id) {
	var wer = $("#u_" + id).text();
	var was = $("#q_" + id).text();
	var wann = $("#t_" + id).text();
	var team = $("#team_" + id).text();

	var json = {
		message_name: "add_question",
		streamid: stream_id,
		title: wer + "Team: " + team + "(" + wann + ")",
		question: was,
		id: id,
	};

	socket.emit("msg", json);
}

function send_binde(id) {
	$.get("bauchbinde.php?binde_id=" + id, {}, function (dataa) {
		var dur = parseInt(dataa.lower_duration);
		var json = {
			message_name: "lower_trigger",
			streamid: stream_id,
			line1: dataa.lower_line_1,
			line2: dataa.lower_line_2,
			char: dataa.lower_symbol,
			dur: dur,
			type: "name",
		};

		socket.emit("msg", json);
	});
}

function addComment() {
	var id = Date.now();
	var kommentar = $("#commenttext").val();

	addC(kommentar, id);
	var json = {
		message_name: "add_comment",
		streamid: stream_id,
		txt: kommentar,
		id: id,
	};

	socket.emit("msg", json);
}

function get_questions() {
	$.get("questions.php", {}, function (dataa) {
		var json = {
			message_name: "clear_questions",
			streamid: stream_id,
		};
		socket.emit("msg", json);
		$("#Fragenliste").html("");
		console.log(dataa);
		for (line of dataa) {
			if (line.stream_id == stream_id) {
				var actions =
					"<a href='#' onClick='removeQ(" +
					line.id +
					")'>Remove / Reject </a>&nbsp;";
				var status =
					"<a href='#' onClick='q_onair(" +
					line.id +
					")' style='background-color: red; color:white'><b>ON AIR</b></a>";
				var team_str = "";

				if (line.team == "1") {
					team_str = "dwarf";
				} else if (line.team == "2") {
					team_str = "elf";
				} else {
					team_str = "neutral";
				}
				addQ(
					line.username,
					line.question,
					status,
					actions,
					line.id,
					line.created_at,
					team_str
				);
				var team_str_cap =
					team_str.charAt(0).toUpperCase() + team_str.slice(1);

				console.log(team_str_cap);
				var json = {
					message_name: "add_question",
					streamid: stream_id,
					title: line.username + " Team " + team_str_cap,
					question: line.question,
					id: line.id,
				};

				socket.emit("msg", json);

				console.log(line.username);
			}
		}
	});
}

/*


function emit() {
	var line1 = $("#line1").val();
	var line2 = $("#line2").val();
	var char = $("#char").val();
	var dur = parseInt($("#dur").val());
	var type = $("#type").val();
	var streamid = $("#streamid").val();
	var json = {
		message_name: "lower_trigger",
		streamid: streamid,
		line1: line1,
		line2: line2,
		char: char,
		dur: dur,
		type: type,
	};

	socket.emit("msg", json);
}

function emit_1() {
	var wer = $("#wer").val();
	var was = $("#was").val();
	var id = $("#id").val();
	var streamid = $("#streamid").val();

	var json = {
		message_name: "add_question",
		streamid: streamid,
		title: wer,
		question: was,
		id: id,
	};

	socket.emit("msg", json);
}

function emit_2() {
	var wer = $("#wer").val();
	var was = $("#was").val();
	var id = $("#id").val();
	var streamid = $("#streamid").val();

	var json = {
		message_name: "remove_question",
		streamid: streamid,
		id: id,
	};

	socket.emit("msg", json);
}

function emit_3() {
	var note = $("#note").val();
	var id = $("#id2").val();
	var streamid = $("#streamid").val();

	var json = {
		message_name: "add_comment",
		streamid: streamid,
		txt: note,
		id: id,
	};

	socket.emit("msg", json);
}

function emit_4() {
	var wer = $("#note").val();
	var id = $("#id2").val();
	var streamid = $("#streamid").val();

	var json = {
		message_name: "remove_comment",
		streamid: streamid,

		id: id,
	};

	socket.emit("msg", json);
}

function emit_initc() {
	var zeit = $("#zeit").val();

	var spl = zeit.split(":");
	var h = parseInt(spl[0]);
	var m = parseInt(spl[1]);
	var s = parseInt(spl[2]);
	var streamid = $("#streamid").val();

	var json = {
		message_name: "set_time",
		streamid: streamid,
		h: h,
		m: m,
		s: s,
	};

	socket.emit("msg", json);

	var json = {
		message_name: "init_countdown",
		streamid: streamid,
	};

	socket.emit("msg", json);
}

function emit_startc() {
	var streamid = $("#streamid").val();

	var json = {
		message_name: "start_countdown",
		streamid: streamid,
	};

	socket.emit("msg", json);
}

function emit_stopc() {
	var streamid = $("#streamid").val();

	var json = {
		message_name: "stop_countdown",
		streamid: streamid,
	};

	socket.emit("msg", json);
}

function tweeeet() {
	var tweetmessage = $("#tweet").val();

	var json = {
		secret: secret,
		message: tweetmessage,
	};

	socket.emit("tweet", json);

	console.log("Sent tweet");
}

function ann() {
	var msg = $("#ann_msg").val();
	var serverid = $("#serverid").val();

	var json = {
		secret: secret,
		message: msg,
		serverid: serverid,
	};

	socket.emit("announce", json);

	console.log("Sent announcement");
}



// function loadProgramm() {
// 	clearProg();
// 	var item_id;
// 	$.get("active_item.php?stream_id=" + stream_id, {}, function (data) {
// 		line1 = data[0];
// 		console.log(data);
// 		$("#nowtitle").html(line1.item_title_external);

// 		var startzeit = line1.item_start_planned;

// 		var duration = line1.item_duration_planned;
// 		var date = new Date(startzeit * 1000);
// 		var hours = date.getHours();
// 		// Minutes part from the timestamp
// 		var minutes = "0" + date.getMinutes();
// 		// Seconds part from the timestamp
// 		var seconds = "0" + date.getSeconds();

// 		// Will display time in 10:30:23 format
// 		var formattedStart =
// 			hours + ":" + minutes.substr(-2) + ":" + seconds.substr(-2);
// 		var endzeit = parseInt(startzeit) + parseInt(duration);

// 		var date = new Date(endzeit * 1000);
// 		var hours = date.getHours();
// 		// Minutes part from the timestamp
// 		var minutes = "0" + date.getMinutes();
// 		// Seconds part from the timestamp
// 		var seconds = "0" + date.getSeconds();

// 		// Will display time in 10:30:23 format
// 		var formattedEnd =
// 			hours + ":" + minutes.substr(-2) + ":" + seconds.substr(-2);

// 		var subtitle_line = formattedStart + "-" + formattedEnd;

// 		$("#nowdata").html(subtitle_line);

// 		item_id = line1.item_id;
// 		current_item = item_id;
// 	});

// 	$.get("next_items.php?stream_id=" + stream_id, {}, function (data) {
// 		var first = true;
// 		for (line of data) {
// 			if (first) {
// 				first = false;
// 				next_item = line.item_id;
// 			}
// 			var startzeit = line.item_start_planned;

// 			var duration = line.item_duration_planned;
// 			var date = new Date(startzeit * 1000);
// 			var hours = date.getHours();
// 			// Minutes part from the timestamp
// 			var minutes = "0" + date.getMinutes();
// 			// Seconds part from the timestamp
// 			var seconds = "0" + date.getSeconds();

// 			// Will display time in 10:30:23 format
// 			var formattedStart =
// 				hours + ":" + minutes.substr(-2) + ":" + seconds.substr(-2);
// 			var endzeit = parseInt(startzeit) + parseInt(duration);

// 			var date = new Date(endzeit * 1000);
// 			var hours = date.getHours();
// 			// Minutes part from the timestamp
// 			var minutes = "0" + date.getMinutes();
// 			// Seconds part from the timestamp
// 			var seconds = "0" + date.getSeconds();

// 			// Will display time in 10:30:23 format
// 			var formattedEnd =
// 				hours + ":" + minutes.substr(-2) + ":" + seconds.substr(-2);

// 			var subtitle_line = formattedStart + "-" + formattedEnd;

// 			addP(line.item_title_external, subtitle_line, line.item_id);
// 		}
// 	});

// 	$.get("bauchbinden_active.php?stream_id=" + stream_id, {}, function (
// 		dataa
// 	) {
// 		console.log(dataa);

// 		loadBB(dataa);
// 	});
// }





*/
