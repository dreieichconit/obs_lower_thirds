//Socket connection
socket.on("msg", msg_recieved);

console.log("Loaded Stream " + stream_id);
function msg_recieved(data) {
	console.log(data);
	if (data.streamid == stream_id) {
		if (data.message_name == "nownext") {
			$("#nowdata").html(data.now);
			$("#nextdata").html(data.next);
		}

		if (data.message_name == "set_time") {
			setZielzeit(data.h, data.m, data.s);
		}

		if (data.message_name == "init_countdown") {
			initializeCountdown();
		}

		if (data.message_name == "stop_countdown") {
			counting = false;
		}

		if (data.message_name == "start_countdown") {
			counting = true;
		}

		if (data.message_name == "add_question") {
			addQ(data.title, data.question, data.id);
		}

		if (data.message_name == "add_comment") {
			addC(data.txt, data.id);
		}

		if (data.message_name == "remove_comment") {
			removeC(data.id);
		}

		if (data.message_name == "remove_question") {
			removeQ(data.id);
			console.log("remove");
		}

		if (data.message_name == "clear_questions") {
			$("#questions").html("");
		}
	}
}
