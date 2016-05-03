<?php

$servername = "sylvester-mccoy-v3.ics.uci.edu";
$username = "inf124grp30";
$password = "st#VuY6R";
$dbname = "inf124grp30";

// get the q parameter from URL
$zip = $_REQUEST["zip"];

$state = "";
$city = "";

// lookup all hints from array if $q is different from "" 
if ($zip !== "") {
	try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTYION);
        //echo "Connected Successfully";
		$sql = "SELECT state, city FROM zip_codes WHERE zip=" . intval($zip);
		foreach ($conn->query($sql)->fetchAll() as $row) { 
				$state = $row['state'];	
				$city = $row['city'];					
		}		
	} 
	catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
	}	
}
// set the db to null
$conn = null;
// Output the result
echo $state . "   " . $city;
?>