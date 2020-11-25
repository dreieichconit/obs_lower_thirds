var socket = io.connect(websocket_server_hostname);

let questionID = "#questions";
let commentID = "#comments";

let fadetime = 500;
let redTime = 2000;
let shifttime = 200;
let timeouttime = fadetime + 1.2 * shifttime;

let background = "#aaaaaa";

class Question {
	constructor(title, question, id) {
		this.title = title;
		this.question = question;
		this.id = id;

		this.html =
			"<div id='" +
			this.id +
			"' class='textelement dropshadow'> \
					<div class='texttitle'> " +
			this.title +
			" </div> \
					<div class='texttext'> " +
			this.question +
			"</div> \
					</div>";
	}

	add() {
		$(questionID).append(this.html);
	}
}

class Comment {
	constructor(text, id) {
		this.question = text;
		this.id = id;

		this.html =
			"<div id='" +
			this.id +
			"' class='textelement dropshadow'> \
					<div class='texttext'> " +
			this.question +
			"</div> \
					</div>";
	}

	add() {
		$(commentID).append(this.html);
		$(`${"#" + this.id}`).css("background-color", "#ff4444");
		$(`${"#" + this.id}`).css("animation-duration", "1s");
		$(`${"#" + this.id}`)
			.delay(redTime)
			.animate(
				{
					backgroundColor: "#dddddd",
				},
				2000
			);
	}
}

let questions = [];

function addQ(title, question, id) {
	let q = new Question(title, question, id);
	q.add();
}

function addC(text, id) {
	let c = new Comment(text, id);
	c.add();
}

// process for removing a div, shifting other divs up and then deleting a div and moving the other divs back down:

function removeC(id) {
	// fade out the div in question, after that is done, call removeC2 as a follow up function to handle the shifting and deleting
	$(`${"#" + id}`).animate(
		{
			opacity: 0,
		},
		fadetime,
		processC(id)
	);
}

function removeQ(id) {
	// fade out the div in question, after that is done, call removeC2 as a follow up function to handle the shifting and deleting
	$(`${"#" + id}`).animate(
		{
			opacity: 0,
		},
		fadetime,
		processQ(id)
	);
}

function processC(id) {
	shiftC(id);
	setTimeout(function () {
		$(`${"#" + id}`).remove();
	}, timeouttime);
	setTimeout(resetShiftC, timeouttime);
}

function processQ(id) {
	shiftQ(id);
	setTimeout(function () {
		$(`${"#" + id}`).remove();
	}, timeouttime);
	setTimeout(resetShiftQ, timeouttime);
}

// function that shifts all the elements up
function shiftC(id) {
	let children = $(commentID).children();

	let flag = false;

	let height = 0;

	//iterate over all the children of the comments section and fade them up by the height of the deleted element if the id number is passed
	for (let k = 0; k < children.length; k++) {
		let ch = children[k];

		if (flag) {
			$(`${"#" + ch.id}`)
				.delay(fadetime)
				.animate(
					{
						top: height,
					},
					shifttime
				);
		}

		if (ch.id === id) {
			flag = true;
			height = -$(`${"#" + ch.id}`).outerHeight(true);
		}
	}

	return true;
}

// function that shifts all the elements up
function shiftQ(id) {
	let children = $(questionID).children();

	let flag = false;

	let height = 0;

	//iterate over all the children of the comments section and fade them up by the height of the deleted element if the id number is passed
	for (let k = 0; k < children.length; k++) {
		let ch = children[k];

		if (flag) {
			$(`${"#" + ch.id}`)
				.delay(fadetime)
				.animate(
					{
						top: height,
					},
					shifttime
				);
		}

		if (ch.id === id) {
			flag = true;
			height = -$(`${"#" + ch.id}`).outerHeight(true);
		}
	}

	return true;
}

// function that resets the shift of all things
function resetShiftC() {
	let children = $(commentID).children();

	for (let k = 0; k < children.length; k++) {
		let ch = children[k];

		$(`${"#" + ch.id}`).css("top", 0);
	}
}

// function that resets the shift of all things
function resetShiftQ() {
	let children = $(questionID).children();

	for (let k = 0; k < children.length; k++) {
		let ch = children[k];

		$(`${"#" + ch.id}`).css("top", 0);
	}
}
