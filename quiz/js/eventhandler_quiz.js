var socket = io.connect("ws://10.0.0.170:3000");

let answers = ["#a", "#b", "#c", "#d"];
let teams = ["#elf", "#dwarf"];
let multiple = ["#elfguess", "#dwarfguess"];

const audiopath = "./qudio/";

// Define the locations for the audio files and set specific players
var lockAudio = new Audio(audiopath + "Question_Login.mp3");
var gameLoop = new Audio(audiopath + "Round_Thinking.mp3");
gameLoop.addEventListener(
	"ended",
	function () {
		this.currentTime = 0;
		this.play();
	},
	false
);

var roundIntro = new Audio(audiopath + "Round_Start.mp3");
var wrongAnswer = new Audio(audiopath + "Round_Lose.mp3");
var rightAnswer = new Audio(audiopath + "Round_Win.mp3");

// delay until the answer should be shown in the interface
var answerDelay = 1500;

// function to graphically and audiologically lock in an answer
function lock(answer) {
	removeLocks();
	$(`${"#" + answer}`).removeClass("dropshadow-inactive");
	$(`${"#" + answer}`).removeClass("inactive");
	$(`${"#" + answer}`).addClass("dropshadow-active-dwarf");
	$(`${"#" + answer}`).addClass("active-dwarf");

	lockAudio.play();
}

//function to graphically and audiologically lock a team answer
function lockM(team, points) {
	if (team === "elf") {
		countUp(points, "#guess_elfs");
		lockAudio.play();
		$("#elfguess").removeClass("dropshadow-inactive");
		$("#elfguess").removeClass("inactive");
		$("#elfguess").addClass("dropshadow-active-dwarf");
		$("#elfguess").addClass("active-dwarf");
	} else if (team === "dwarf") {
		countUp(points, "#guess_dwarfs");
		lockAudio.play();
		$("#dwarfguess").removeClass("dropshadow-inactive");
		$("#dwarfguess").removeClass("inactive");
		$("#dwarfguess").addClass("dropshadow-active-dwarf");
		$("#dwarfguess").addClass("active-dwarf");
	}
}

// function to reset the locked choices
function resetChoices() {
	for (i = 0; i < answers.length; i++) {
		$(answers[i]).removeClass("dropshadow-active-dwarf");
		$(answers[i]).removeClass("active-dwarf");
		$(answers[i]).removeClass("dropshadow-active-elf");
		$(answers[i]).removeClass("active-elf");
		$(answers[i]).removeClass("dropshadow-lock");
		$(answers[i]).removeClass("active-lock");
		$(answers[i]).addClass("dropshadow-inactive");
		$(answers[i]).addClass("inactive");
	}
}

function removeLocks() {
	for (i = 0; i < answers.length; i++) {
		$(answers[i]).removeClass("dropshadow-active-dwarf");
		$(answers[i]).removeClass("active-dwarf");
	}
}

function removeLocksM() {
	for (i = 0; i < multiple.length; i++) {
		$(multiple[i]).removeClass("dropshadow-active-dwarf");
		$(multiple[i]).removeClass("active-dwarf");
		$(multiple[i]).removeClass("dropshadow-active-elf");
		$(multiple[i]).removeClass("active-elf");
		$(multiple[i]).removeClass("dropshadow-lock");
		$(multiple[i]).removeClass("active-lock");
		$(multiple[i]).addClass("dropshadow-inactive");
		$(multiple[i]).addClass("inactive");
	}
}

function showWrong(answer) {
	setTimeout(function () {
		wrongSelection(answer);
	}, answerDelay);
	wrongSound();
	setTimeout(function () {
		restartRound();
	}, 2000);
}

function showRight(answer) {
	setTimeout(function () {
		rightSelection(answer);
	}, answerDelay);
	rightSound();
}

// function to resolve the winner and loser
function showCorrectGuess(winner, loser, points, type) {
	$("#correctamount").css("opacity", 100);

	setTimeout(function () {
		countUp(points, "#guess_question");
	}, 1000);

	if (type == "1") {
		setTimeout(function () {
			rightWrong(winner, loser);
		}, answerDelay);
	} else if (type == "2") {
		setTimeout(function () {
			rightRight(winner, loser);
		}, answerDelay);
	}

	rightSound();
}

function rightWrong(winner, loser) {
	removeLocksM();
	rightSelectionM(winner);
	wrongSelectionM(loser);
}

function rightRight(winner, loser) {
	removeLocksM();
	rightSelectionM(winner);
	rightSelectionM(loser);
}

// function to graphically announce that the answer was wrong
// MUST BE CALLED FROM SHOW WRONG
function wrongSelection(answer) {
	removeLocks();
	$(`${"#" + answer}`).removeClass("dropshadow-inactive");
	$(`${"#" + answer}`).removeClass("inactive");
	$(`${"#" + answer}`).addClass("dropshadow-active-elf");
	$(`${"#" + answer}`).addClass("active-elf");
}

function wrongSelectionM(answer) {
	$(`${"#" + answer + "guess"}`).removeClass("dropshadow-inactive");
	$(`${"#" + answer + "guess"}`).removeClass("inactive");
	$(`${"#" + answer + "guess"}`).addClass("dropshadow-active-elf");
	$(`${"#" + answer + "guess"}`).addClass("active-elf");
}

// function to audiologically announce that the selection was wrong
// MUST BE CALLED FROM SHOWWRONG
function wrongSound() {
	gameLoop.pause();
	gameLoop.currentTime = 0;
	wrongAnswer.play();
}

// function to graphically announce that the answer was correct
// MUST BE CALLED FROM SHOW WRONG
function rightSelection(answer) {
	removeLocks();
	$(`${"#" + answer}`).removeClass("dropshadow-inactive");
	$(`${"#" + answer}`).removeClass("inactive");
	$(`${"#" + answer}`).addClass("dropshadow-lock");
	$(`${"#" + answer}`).addClass("active-lock");
}

function rightSelectionM(answer) {
	let answerdiv = "#" + answer + "guess";
	console.log(answerdiv);
	$(answerdiv).removeClass("dropshadow-inactive");
	$(answerdiv).removeClass("inactive");
	$(answerdiv).addClass("dropshadow-lock");
	$(answerdiv).addClass("active-lock");
}

function setTeam(team) {
	if (team == "elf") {
		$("#elf").addClass("dropshadow-active-elf");
		$("#elf").removeClass("dropshadow-inactive");
		$("#elf").addClass("active-elf");
		$("#elf").removeClass("inactive");
		$("#dwarf").removeClass("dropshadow-active-dwarf");
		$("#dwarf").addClass("dropshadow-inactive");
		$("#dwarf").removeClass("active-dwarf");
		$("#dwarf").addClass("inactive");
	} else if (team == "dwarf") {
		$("#dwarf").addClass("dropshadow-active-dwarf");
		$("#dwarf").removeClass("dropshadow-inactive");
		$("#dwarf").addClass("active-dwarf");
		$("#dwarf").removeClass("inactive");
		$("#elf").removeClass("dropshadow-active-elf");
		$("#elf").addClass("dropshadow-inactive");
		$("#elf").removeClass("active-elf");
		$("#elf").addClass("inactive");
	}
}

function startRound(type) {
	resetChoices();
	setTimeout(loop, 750);
	intro();
	console.log(type);
	if (type == "guess") {
		$("#multiplechoice").css("opacity", 0);
		$("#guess").css("opacity", 100);
		$("#guess_elf").html("0");
		$("#guess_dwarf").html("0");
		$("#guess_question").html("0");
		$("#correctamount").css("opacity", 0);
		removeLocksM();
	} else if (type == "multiple") {
		$("#multiplechoice").css("opacity", 100);
		$("#guess").css("opacity", 0);
		$("#guess_elf").html("0");
		$("#guess_dwarf").html("0");
		$("#guess_question").html("0");
		$("#correctamount").css("opacity", 0);
	}
}

function restartRound() {
	setTimeout(loop, 1500);
	intro();
}

function loop() {
	gameLoop.play();
}

function intro() {
	roundIntro.play();
}

function rightSound() {
	gameLoop.pause();
	gameLoop.currentTime = 0;
	rightAnswer.play();
}

function countUp(points, id) {
	cntr = setInterval(function () {
		counter(points, id);
	}, 1);
}

let i = 0;

function counter(points, id) {
	$(id).html(i);
	if (i < points) {
		i += Math.round(points / (30 * points.toString().length));
	} else {
		$(id).html(points);
		clearInterval(cntr);
		i = 0;
	}
}
