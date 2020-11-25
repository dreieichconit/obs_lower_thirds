var express = require("express");
var app = express();
var server = app.listen(3000);

var Twitter = require("twitter");
var config = require("./config.js");

var T = new Twitter(config);

/*
const username = "dreieichconworld";
const token = "";

// ES2015 syntax
import TwitchJs from "twitch-js";

// OR ES5 syntax
var TwitchJs = require("twitch-js");

const twitchJs = new TwitchJs({ username, token });
*/
const https = require("http");

app.use(express.static("public"));

const { secret, token } = require("./secret.json");

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

	socket.on("tweet", tweet_received);

	socket.on("announce", announcement);

	socket.on("quiz", quiz);

	/*



*/

	function msg_transmit(data) {
		socket.broadcast.emit("msg", data);
		console.log("Message-Received: ");
		console.log(data);
	}

	function quiz(data) {
		socket.broadcast.emit("quiz", data);
		console.log("Quiz-Received: ");
		console.log(data);
	}

	function tweet_received(data) {
		console.log("Tweet received");
		if (data.secret == secret) {
			console.log("secret ok");
			var message = data.message;
			T.post("statuses/update", { status: message }, function (
				err,
				data,
				respone
			) {
				console.log(data);
			});

			announce_on_discord(data);
		} else {
			console.log("secret not ok");
		}
	}

	function announcement(data) {
		var ts = new Date();
		var h = ts.getHours();
		var m = ts.getMinutes();
		var s = ts.getSeconds();
		var zeit = h + ":" + m + ":" + s;

		if (data.secret == secret) {
			console.log(zeit + " Announcement received: " + data.message);
			T.post("statuses/update", { status: data.message }, function (
				err,
				data,
				respone
			) {
				console.log(data);
			});

			announce_on_discord(data);
		} else {
			console.log(zeit + " Announcement received but token was wrong");
		}
	}

	function announce_on_discord(data) {
		var postdata = JSON.stringify({
			token: token,
			serverid: data.serverid,
			message: data.message,
		});

		var options = {
			hostname: "bots.demolite.de",
			port: "80",
			path: "/con/announce/",
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"Content-Length": postdata.length,
			},
		};

		var req = https.request(options, (res) => {
			console.log(`statusCode: ${res.statusCode}`);

			res.on("data", (d) => {
				process.stdout.write(d);
			});
		});

		req.on("error", (error) => {
			console.error(error);
		});

		req.write(postdata);
		req.end();
	}
}

//Power-Combo: 628 Yeah!
