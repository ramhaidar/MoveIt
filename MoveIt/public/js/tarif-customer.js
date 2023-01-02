const form = document.forms['pesanan'];

const main = () => {
	form.elements.berat.addEventListener('select', onInputOrChange);
	form.elements.berat.addEventListener('change', onInputOrChange);
	form.elements.berat.addEventListener('input', onInputOrChange);
	form.elements.jarak.addEventListener('select', onInputOrChange);
	form.elements.jarak.addEventListener('change', onInputOrChange);
	form.elements.jarak.addEventListener('input', onInputOrChange);
};

const applyTarif = (jarak, berat) => {
	// Motor
	if (berat < 10) {
		if (jarak <= 4) {
			return "Rp" + (9200 * 1).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
		} else {
			return "Rp" + (9200 + ((jarak - 4) * 2300)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
		}
	}
	// Van
	if (berat < 60) {
		if (jarak <= 5) {
			return "Rp" + (85000 * 1).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
		} else {
			return "Rp" + (85000 + ((jarak - 5) * 2000)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
		}
	}
	// PickUp
	if (berat < 80) {
		if (jarak <= 5) {
			return "Rp" + (95000 * 1).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
		} else {
			return "Rp" + (95000 + ((jarak - 5) * 2000)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
		}
	}
	if (berat < 199) {
		if (jarak <= 2) {
			return "Rp" + (240000 * 1).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
		} else {
			return "Rp" + (240000 + ((jarak - 2) * 2500)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
		}
	}
	if (berat < 500) {
		if (jarak <= 4) {
			return "Rp" + (480000 * 2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
		} else {
			return "Rp" + (480000 + ((jarak - 2) * 2500)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
		}
	}
	if (berat > 500) {
		return ("Maksimal Berat adalah 500kg")
	}
};

const onInputOrChange = e => {
	const jarak = parseInt(form.elements.jarak.value || '0', 10);
	const berat = parseInt(form.elements.berat.value || '0', 10);
	form.elements.tarif.value = applyTarif(jarak, berat);
};

window.onload = onInputOrChange;
main();