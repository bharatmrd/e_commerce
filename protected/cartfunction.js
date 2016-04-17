function validateitem(form, itemno) {
	var x = itemno;
	if(Number.isInteger(x)) {
		form.submit();
	} else {
		alert("You must provide a valid item number.");
	}
}