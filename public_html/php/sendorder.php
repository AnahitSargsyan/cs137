<html>
<body>
<?php
    session_start();
    $servername = "sylvester-mccoy-v3.ics.uci.edu";
    $username = "inf124grp30";
    $password = "st#VuY6R";
    $dbname = "inf124grp30";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=inf124grp30", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $orderid = $hatid = $firstname = $lastname = $email = $address = $phonenumber = "";
        $city = $state = $zipcode = $ccnumber = $ccname = $expmonth = $expyear = $shipping = $quantity = "";
        $quantityErr = $firstnameErr = $lastnameErr = $emailErr = $phoneErr = $cityErr = $stateErr = $zipErr = $ccnumErr = $ccnameErr = "";
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        function console_log( $data ){
            echo '<script>';
            echo 'console.log('. json_encode( $data ) .')';
            echo '</script>';
        }
        
   	
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
        
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["QuantityField"])) {
                $quantityErr = "Quantity is required";
                console_log($quantityErr);
            } else {
                $quantity = test_input($_POST["QuantityField"]);
                // check if quantity is numeric
                if (is_numeric($quantity)) {
                    if(intval($quantity) <= 0)
                    {
                        $quantityErr = "Quantity must be positive";
                    }
                }
            }
  
            if (empty($_POST["FirstNameField"])) {
                $firstnameErr = "First Name is required";
                console_log($firstnameErr);
            } else {
                $firstname = test_input($_POST["FirstNameField"]);
                if (ctype_alpha($firstname) == false) {
                    $firstnameErr = "Names must be alphabetical";
                    console_log($firstnameErr);  
                }
            }
                    
            if (empty($_POST["LastNameField"])) {
                $lastnameErr = "Last Name is required";
                console_log($lastnameErr);
            } else {
                $lastname = test_input($_POST["LastNameField"]);
                        
                if (ctype_alpha($lastname) == false) {
                    $lastnameErr = "Names must be alphabetical";
                    console_log($lastnameErr);  
                }
            }
                    
            if (empty($_POST["EmailAddressField"])) {
                $emailErr = "email is required";
                console_log($emailErr);
            } else {
                $email = test_input($_POST["EmailAddressField"]);
                        
                if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                    $emailErr = "not a valid email"; 
                    console_log($emailErr);  
                            
                }
            }
                    
            if (empty($_POST["PhoneNumberField"])) {
                $phoneErr = "phone number is required";
                console_log($phoneErr);
            } else {
                $phonenumber = test_input($_POST["PhoneNumberField"]);
                        
                if(is_numeric($phonenumber))
                {
                    if(strlen($phonenumber) != 10)
                    {
                        $phoneErr = "phone number must be 10 digits long"; 
                        console_log($phoneErr);  
                    }
                }
            }
                    
            if (empty($_POST["CityField"])) {
                $cityErr = "City is required";
                console_log($cityErr);
            } else {
                $city = test_input($_POST["CityField"]);
                        
                if (ctype_alpha($city) == false) {
                    $cityErr = "Cities must be alphabetical";
                    console_log($cityErr);  
                }
            }
                    
            if (empty($_POST["StateField"])) {
                $stateErr = "State is required";
                console_log($stateErr);
            } else {
                $state = test_input($_POST["StateField"]);
                        
                if (ctype_alpha($state) == false) {
                    $stateErr = "States must be alphabetical";
                    console_log($stateErr);  
                }
            }
                    
            if (empty($_POST["ZipCodeField"])) {
                $zipErr = "zip code is required";
                console_log($zipErr);
            } else {
                $zipcode = test_input($_POST["ZipCodeField"]);
                            
                if(is_numeric($zipcode))
                {
                    if(strlen($zipcode) != 5)
                    {
                        $zipErr = "ZIP codes must be 5 digits";
                        console_log($zipErr);  
                    }
                }
            }
                    
            if (empty($_POST["CreditCardNumberField"])) {
                $ccnumErr = "CC number is required";
                console_log($ccnumErr);
                } else {
                $ccnumber = test_input($_POST["CreditCardNumberField"]);
                            
                if(is_numeric($ccnumber))
                {
                    if(strlen($ccnumber) != 16)
                    {
                        $ccnumErr = "CC numbers must be 16 digits";
                        console_log($ccnumErr);  
                    }
                }
            }
                    
            if (empty($_POST["CreditCardNameField"])) {
                $ccnameErr = "CC name is required";
                console_log($ccnameErr);
            } else {
                $ccname = test_input($_POST["CreditCardNameField"]);
                        
                if (ctype_alpha($ccname) == false) {
                    $ccnameErr = "names must be alphabetical";
                    console_log($ccnameErr);  
                }
            }
        }
               
        
        $stmt = $conn->prepare("INSERT INTO orders(id, hat_id, quantity, first_name, last_name, phone, address, city, state, zip, card, name_on_card, month, year, shipping, email) VALUES(:id, :hat_id, :quantity, :first_name, :last_name, :phone, :address, :city, :state, :zip, :card, :name_on_card, :month, :year, :shipping, :email)");
        $stmt->execute(array(':id' => $orderid, ':hat_id' => $hatid, ':quantity' => $quantity, ':first_name' => $firstname, ':last_name' => $lastname, ':phone' => $phonenumber, ':address' => $address, ':city' => $city, ':state' => $state, ':zip' => $zipcode, ':card' => $ccnumber, ':name_on_card' => $ccname, ':month' => $expmonth, ':year' => $expyear, ':shipping' => $shipping, ':email' => $email));
            
   
        
        $_COOKIE['order_id'] = $orderid;
   

    } catch (PDOException $e) {
        echo "Connection failed: ". $e->getMessage();
    }
    
    $conn = null;
?>
</body>
</html>
