<html>
<body>
<?php
    session_start();
$dbhost = "sylvester-mccoy-v3.ics.uci.edu";
$dbuser = 'inf124grp30';
$dbpass = 'st#VuY6R';
try {    
	$conn = new PDO("mysql:host=$dbhost;dbname=myDB", $dbuser, $dbpass);
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   	

   	$orderid = $hatid = $firstname = $lastname = $email = $address = $phonenumber = $city = $state = $zipcode = $ccnumber = $ccname = $expmonth = $expyear = $shipping = $quantity = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $orderid = rand(1,10000);
            $hatid = $_POST["HatID"];
            $quantity = test_input($_POST["QuantityField"]);
            $firstname = test_input($_POST["FirstNameField"]);
            $lastname = test_input($_POST["LastNameField"]);
            $email = test_input($_POST["EmailAddressField"]);
            $phonenumber = test_input($_POST["PhoneNumberField"]);
            $address = test_input($_POST["ShippingAddressField"]);
            $city = test_input($_POST["CityField"]);
            $state = test_input($_POST["StateField"]);
            $zipcode = test_input($_POST["ZipCodeField"]);
            $ccnumber = test_input($_POST["CreditCardNumberField"]);
            $ccname = test_input($_POST["CreditCardNameField"]);
            $expmonth = test_input($_POST["ExpMonthField"]);
            $expyear = test_input($_POST["ExpYearField"]);
            $shipping = test_input($_POST["Shipping"]);
	}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function CheckOrder() { 
    global $quantity, $firstname, $lastname, $email, $phonenumber, $address, $city, $state, $zipcode, $ccnumber, $ccname, $expmonth, $expyear, $shipping;
    if(is_numeric($quantity))
    {
    	if(intval($quantity) <= 0)
    	{
    		echo "quantity must be a postitive integer";
    		return false;
    	}
    }
    elseif(ctype_alpha($firstname) == false)
    {
    	echo "no numbers allowed in first name";
    	return false;
    }   
    elseif(ctype_alpha($lastname) == false)
    {
    	echo "no numbers allowed in last name";
    	return false;
    }          
    elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
    {
    	echo "not a valid email address";
    	return false;
    }
    elseif(is_numeric($phonenumber))
    {
    	if(!preg_match('/^\d{10}$/', $phonenumber)
    	{
    		echo "phone number must be 10 digits long";
    		return false;
    	}
    }
    elseif(ctype_alpha($city) == false)
    {
    	return false;
    }
    elseif(ctype_alpha($state) == false)
    {
    	echo "State cannot contain numbers";
    	return false;
    }
    elseif(is_numeric($zipcode))
    {
    	if(!preg_match('/^\d{5}$/', $zipcode)
    	{
    		echo "Zip code must contain only numbers";
    		return false;
    	}
    }
    elseif(is_numeric($ccnumber))
    {
    	if(!preg_match('/^\d{16}$/', $ccnumber)
    	{
    		echo "Credit Card numbers must contain only numbers";
    		return false;
    	}
    }
    elseif(ctype_alpha($ccname) == false)
    {
    	echo "Credit Card name must contain only alphabet";
    	return false;
    }
    else
    {
    	echo "Order is properly validated";
    	return true;
    }
    
}
	$inthatid = intval($hatid);
	$intquantity = intval($quantity);
	$intphone = intval($phonenumber);
	$intmonth = intval($expmonth);
	$intyear = intval($expyear);
	


   	echo "Connected successfully";
   	if(CheckOrder())
	{
    	$sql = 'INSERT INTO orders '.
       '(id, hat_id, quantity, first_name, last_name, phone, address, city, state, zip, card, name_on_card, month, year, shipping, email) '.
       "VALUES ( '$orderid', '$inthatid', '$intquantity', '$firstname', '$lastname', '$intphone', '$address', '$city', '$state', '$zipcode', '$ccnumber', '$ccname', '$intmonth', '$intyear', '$shipping', '$email')";
      
    	
    	$result = mysql_query( $sql, $conn );
   
    	if(!$result ) {
       		$message  = 'Invalid query: ' . mysql_error() . "\n";
    		$message .= 'Whole query: ' . $query;
    		die($message);
    	}
   
    	echo "Entered data successfully\n";
        $_SESSION['order_id'] = $orderid;
    }
   
    mysql_close($conn);

} catch (PDOException $e) {
    echo "Connection failed: ". $e->getMessage();
}
?>

</body>
</html>