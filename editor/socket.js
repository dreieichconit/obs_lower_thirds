var socket = io.connect(websocket_server_hostname);
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
		secret:
			"a34640058dd929308dfbc717cea8155fc0ce063da7bd917a12187d745c18f31f",
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
