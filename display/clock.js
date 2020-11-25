var zielzeit = [];
zielzeit.h = 11;
zielzeit.m = 47;
zielzeit.s = 0;

var countdown_secs;
var counting = false;

function checkTime(i) {
	if (i < 10) {
		i = "0" + i;
	} // add zero in front of numbers < 10
	return i;
}

function setZielzeit(h, m, s) {
	zielzeit.h = h;
	zielzeit.m = m;
	zielzeit.s = s;
}

function initializeCountdown() {
	var today = new Date();
	var jetzt_secs =
		today.getHours() * 60 * 60 +
		today.getMinutes() * 60 +
		today.getSeconds();

	var ziel_secs = zielzeit.h * 60 * 60 + zielzeit.m * 60 + zielzeit.s;
	//console.log("Ziel:" + ziel_secs);
	//console.log("jetzt: " + jetzt_secs);

	countdown_secs = ziel_secs - jetzt_secs;

	//console.log("Count Secs " + countdown_secs);
	$("#elapsedtime").addClass("timeokay");
	$("#elapsedtime").removeClass("timeover");

	counting = true;
}

var cntdn = setInterval(function () {
	var today = new Date();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);
	document.getElementById("currenttime").innerHTML = h + ":" + m + ":" + s;

	var minus;
	var cds;
	if (counting) {
		countdown_secs -= 1;

		if (countdown_secs < 0) {
			cds = countdown_secs * -1;
			minus = "+";
		} else {
			cds = countdown_secs;
			minus = "-";
		}
		var se = cds % 60;
		var mi = ((cds - se) / 60) % 60;
		var h = (((cds - se) / 60 - mi) / 60) % 24;

		if (se < 10) {
			se = "0" + se;
		}

		if (mi < 10) {
			mi = "0" + mi;
		}

		if (h < 10) {
			h = "0" + h;
		}

		zeit = minus + h + ":" + mi + ":" + se;

		if (countdown_secs == 0) {
			$("#elapsedtime").removeClass("timeokay");
			$("#elapsedtime").addClass("timeover");
		}
		$("#elapsedtime").html(zeit);
	}
}, 1000);
