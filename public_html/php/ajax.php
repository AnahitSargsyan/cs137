<script>
function get_state_city(str) {
    if (str.length == 0) { 
        document.getElementById("state_city").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("state_city").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "get_state_city.php?zip=" + str, true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>

<p><b>Type a zip code below:</b></p>
<form> 
Zip: <input type="text" onblur="get_state_city(this.value)">
</form>
<p>Result: <span id="state_city"></span></p>
</body>
</html>