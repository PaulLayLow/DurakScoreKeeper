// Show/hide adding new items
function showHiddenDiv() {
	var x = document.getElementById('hideDiv');
	if (x.style.display === 'none') {
		x.style.display = 'inline';
		x.style.left = "100px";
	} 
	
	else {
	x.style.display = 'none';
	}
}

function showHiddenDivEndOfWeek() {
	var x = document.getElementById('hideDivEndOfWeek');
	if (x.style.display === 'none') {
		x.style.display = 'inline';
		x.style.left = "100px";
	} 
	
	else {
	x.style.display = 'none';
	}
}

// Search bar
function searchInventory() {
	// Declare variables 
	var input, filter, table, tr, td, i;
	input = document.getElementById("searchInput");
	filter = input.value.toUpperCase();
	table = document.getElementById("mainTable");
	tr = table.getElementsByTagName("tr");

	// Loop through all table rows, and hide those who don't match the search query
	for (i = 0; i < tr.length; i++) {
		tdName = tr[i].getElementsByTagName("td")[1];
		tdType = tr[i].getElementsByTagName("td")[3];
		tdLocation = tr[i].getElementsByTagName("td")[4];
		if (tdName) {
			if (tdName.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} 
			else if (tdType){
				if (tdType.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				}
				else if (tdLocation){
					if (tdLocation.innerHTML.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					}
					else{
						tr[i].style.display = "none";
					}
				}
				else {
					tr[i].style.display = "none";
				}
			}
			else {
				tr[i].style.display = "none";
			}
		} 
	}
}

// Clear search bar
function resetForm(id) {
    $('#' + id).val(function() {
        return this.defaultValue;
    });
}

// Open date picker dialog
$('.datepicker').pickadate({
	format: 'yyyy/mm/dd',
	selectMonths: true,
	selectYears: 40,
	hiddenPrefix: 'prefix__',
	hiddenSuffix: '__suffix'
});
	
// Select input fields intializer	
$(document).ready(function() {
	$('select').material_select();
});
  
$('select').material_select('destroy');

// Collapsible initializer
$(document).ready(function(){
	$('.collapsible').collapsible();
});