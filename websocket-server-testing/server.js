var express = require("express");
var app = express();
var server = app.listen(3001);

app.use(express.static("public"));

console.log("running now");

var socket = require("socket.io");

var io = socket(server);

io.sockets.on("connection", newConnection);

function newConnection(socket) {
	var ts = new Date();
	var h = ts.getHours();
	var m = ts.getMinutes();
	var s = ts.getSeconds();
	var zeit = h + ":" + m + ":" + s;

	console.log(zeit + "- new connection-id: " + socket.id);

	socket.on("msg", msg_transmit);

	/*



*/

	function msg_transmit(data) {
		socket.broadcast.emit("msg", data);
		console.log("Message-Received: ");
		console.log(data);
	}
}

//Power-Combo: 628 Yeah!
