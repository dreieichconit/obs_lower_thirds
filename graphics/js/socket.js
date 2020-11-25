//Socket connection
socket.on("msg", msg_recieved);

const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

var stream_id = urlParams.get("stream_id");

console.log("Loaded Stream: " + stream_id);

function msg_recieved(data) {
	if (data.message_name == "lower_trigger") {
		if (data.streamid == stream_id) {
			console.log(data);
			var line1 = data.line1;
			var line2 = data.line2;
			var char = data.char;
			var dur = data.dur;
			var type = data.type;

			fadeIn(line1, line2, char, dur, type);
		}
	}
}
