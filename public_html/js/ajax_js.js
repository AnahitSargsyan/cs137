/* 
 Arash Nase
 Javascript side of the Ajax, used in item_description.php page 
 */


// js side of ajax
function get_state_city(str) {
	if (str.length == 0) { 
		document.getElementById("CityName").innerHTML = "";
		return;
	} else {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("CityName").value = (xmlhttp.responseText).toString().split(":")[0];
				document.getElementById("StateName").value = (xmlhttp.responseText).toString().split(":")[1];
			}
		};
		xmlhttp.open("GET", "../php/get_state_city.php?zip=" + str, true);
		xmlhttp.send();
	}
}