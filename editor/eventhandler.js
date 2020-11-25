let bindeID = "#binden";
let programID = "#program";
let questionID = "#Fragenliste";
let commentID = "#kommentarliste";

let fadetime = 500;
let timeouttime = 600;

class Binde {
	constructor(char, title, subtitle, id) {
		this.char = char;
		this.title = title;
		this.subtitle = subtitle;
		this.id = id;

		this.html =
			"<div onClick='send_binde(" +
			this.id +
			")' id='" +
			this.id +
			"' class='textelement half2 dropshadow'> \
					<div class='binde'> \
						<div class='icon split'> \
						<img class='bbico' src='../graphics/img/" +
			this.char +
			".png'/>\
						</div> \
						<div class='bindetitle split'>" +
			this.title +
			" </div> \
					<div class='bindetext'> " +
			this.subtitle +
			"</div> \
					</div>";
	}

	add() {
		$(bindeID).append(this.html);
	}
}

class Question {
	constructor(user, question, status, actions, id, timestamp, team) {
		this.user = user;
		this.question = question;
		this.status = status;
		this.actions = actions;
		this.id = id;
		this.timestamp = timestamp;
		this.team = team;
		this.html =
			"<div class='textelement'>" +
			"<div class='frage wrap' id='f_" +
			this.id +
			"'><div class='question split' id='u_" +
			this.id +
			"'>" +
			this.user +
			"</div><div class='question split' id='team_" +
			this.id +
			"'>" +
			this.team +
			"</div><div style='display: none' id='t_" +
			this.id +
			"'>" +
			this.timestamp +
			"</div><div class='question split'>" +
			formatTime(this.timestamp) +
			"</div><div class='question split' id='q_" +
			this.id +
			"'>" +
			this.question +
			"</div><div class='question split questionstatus'><div>" +
			this.status +
			"</div></div><div class='question questionstatus'>" +
			this.actions +
			"</div></div></div>";
	}

	add() {
		$(questionID).append(this.html);
	}
}

class Comment {
	constructor(text, id) {
		this.text = text;
		this.id = id;

		this.html =
			"<div class='textelement frage dropshadow' id='" +
			this.id +
			"' >" +
			"<div class='commenttext'> " +
			this.text +
			"</div><div class='delete'><a href='#' onClick=removeC(" +
			this.id +
			")>Remove</a></div></div>";
	}

	add() {
		$(commentID).append(this.html);
	}
}

function addB(char, title, subtitle, id) {
	let b = new Binde(char, title, subtitle, id);
	b.add();
}

function addP(title, subtitle, id) {
	let p = new Program(title, subtitle, id);
	p.add();
}

function removeB(id) {
	$(`${"#" + this.id}`).animate(
		{
			opacity: 0,
		},
		fadetime
	);
	setTimeout(function () {
		$(`${"#" + id}`).remove();
	}, timeouttime);
}

function removeC(id) {
	$(`${"#" + this.id}`).animate(
		{
			opacity: 0,
		},
		fadetime
	);
	setTimeout(function () {
		$(`${"#" + id}`).remove();
	}, timeouttime);

	var json = {
		message_name: "remove_comment",
		streamid: stream_id,
		id: id,
	};
	socket.emit("msg", json);
}

function clearB() {
	//ToDo
}

function removeP(id) {
	$(`${"#" + this.id}`).animate(
		{
			opacity: 0,
		},
		fadetime
	);
	setTimeout(function () {
		$(`${"#" + id}`).remove();
	}, timeouttime);
}

function addQ(user, question, status, actions, id, timestamp, team) {
	let q = new Question(user, question, status, actions, id, timestamp, team);
	q.add();
}

function addC(text, id) {
	let c = new Comment(text, id);
	c.add();
}

function removeQ(id) {
	$(`${"#f_" + this.id}`).animate(
		{
			opacity: 0,
		},
		fadetime
	);
	setTimeout(function () {
		$(`${"#f_" + id}`).remove();
	}, timeouttime);

	var json = {
		message_name: "remove_question",
		streamid: stream_id,

		id: id,
	};

	socket.emit("msg", json);
}

function clearQ() {
	$("#Fragenliste").html("");
}
