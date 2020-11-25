function toggle_div(id, richtung) {
	var ziel = id;
	var quelle = ziel & "_link";
	$(ziel).toggle();
	if (richtung == "o") {
		$(quelle).html(
			"Einklappen <span class='fas fa-arrow-circle-up'></span>"
		);
	}
}
