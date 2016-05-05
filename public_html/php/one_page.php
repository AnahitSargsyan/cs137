
<?php
session_start();
$servername = "sylvester-mccoy-v3.ics.uci.edu";
$username = "inf124grp30";
$password = "st#VuY6R";
$dbname = "inf124grp30";

try {
            $conn = new PDO("mysql:host=$servername;dbname=inf124grp30", $username, $password);
        
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTYION);
            //echo "Connected Successfully";
            $sql = "SELECT id, title, color, price, material, image_url, description FROM hats WHERE id = "; 
            

            //echo $sql;
            $sql .= $_GET['id'];
            foreach ($conn->query($sql) as $row) { 
                $id = $row['id'];
                $price = $row['price'];
                $material = $row['material'];
                $description = $row['description'];
                $image_url = $row['image_url'];
                $title = $row['title'];
                $color = $row['color'];
            }
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

?>

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
               
        
        $stmt = $conn->prepare("INSERT INTO orders(id, hat_id, quantity, first_name, last_name, phone, address, city, state, zip, card, name_on_card, month, year, shipping, email) 
        VALUES(:id, :hat_id, :quantity, :first_name, :last_name, :phone, :address, :city, :state, :zip, :card, :name_on_card, :month, :year, :shipping, :email)");
        $stmt->execute(array(':id' => $orderid, ':hat_id' => $hatid, ':quantity' => $quantity, ':first_name' => $firstname, ':last_name' => $lastname, ':phone' => $phonenumber, ':address' => $address, ':city' => $city, ':state' => $state, ':zip' => $zipcode, ':card' => $ccnumber, ':name_on_card' => $ccname, ':month' => $expmonth, ':year' => $expyear, ':shipping' => $shipping, ':email' => $email));
            
   
        
        $_SESSION['order_id'] = $orderid;
   

    } catch (PDOException $e) {
        echo "Connection failed: ". $e->getMessage();
    }
    
    $conn = null;
?>

<!DOCTYPE html>
<!--
Made by Arash Nase
-->
<html>
    <head>
        <title>Item Description</title>       
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <script type="text/javascript" src="../js/order_form.js" ></script>  
        <link rel="stylesheet" type="text/css" href="../css/item_description.css">
    </head>
    
    <body>
        
        <div>
            <div id="header">
                <h1>HatSpace</h1>
                <form>
                    <input id="search" type="text" placeholder="Search">
                </form>
            </div>       
       
            <img id="image" src="../img/hats/<?php echo $image_url; ?>" alt="<?php echo $title; ?> "> 
            <div>
                <ul>
                    <li>Name: <?php echo $title; ?></li>
                    <li>Color: <?php echo $color; ?></li>
                    <li>Material: <?php echo $material; ?></li>
                    <li>Price: $ <?php echo $price; ?></li>
                </ul>
            </div>
            <div class ="description"> 
                <?=$description?>
            </div>
        </div>
        
        <div id ="form">
            <form action = "confirmation.php" name = "OrderForm" method="post">
                <div class="left">    
                    Hat ID: 
                </div>
                <div class="right">
                    <input id="HatID" type="text" name="HatID" value="<?php echo $id; ?>" maxlength="4" required/><br />
                </div>
                <div class="left">
                    Quantity: 
                </div>
                <div class="right">
                    <input id="QuantityOrdered" type="text" name="QuantityField" value="" required/><br />
                </div>
                <div class="left">
                    First Name: 
                </div>
                <div class="right">
                    <input id="FirstName" type="text" name="FirstNameField" required/><br />
                </div>
                <div class="left">
                    Last Name: 
                </div>
                <div class="right">
                    <input id="LastName" type="text" name="LastNameField" required/><br />
                </div>
                <div class="left">
                    Email: 
                </div>
                <div class="right">
                    <input id="EmailAddress" type="text" name="EmailAddressField" required/><br />
                </div>
                <div class="left">
                    Phone Number: 
                </div>
                <div class="right">
                    <input id="PhoneNumber" type="text" name="PhoneNumberField" maxlength="10" value="XXXXXXXXXX" required/><br />
                </div>
                <div class="left">
                    Address: 
                </div>
                <div class="right">
                    <input id="ShippingAddress" type="text" name="ShippingAddressField" required/><br />
                </div>
                <div class="left">
                    City: 
                </div>
                <div class="right">
                    <input id="CityName" type="text" name="CityField" required/><br />
                </div>
                <div class="left">
                    State: 
                </div>
                <div class="right">
                    <input id="StateName" type="text" name="StateField" required/><br />
                </div>
                <div class="left">    
                    ZIP: 
                </div>
                <div class="right">
                    <input id="ZipCode" type="text" name="ZipCodeField" maxlength="5" required/><br />
                </div>
                <div class="left">
                    Card Number: 
                </div>
                <div class="right">
                    <input id="CreditCardNumber" type="text" name="CreditCardNumberField" maxlength="16" required/><br />
                </div>
                <div class="left">
                    Name on card: 
                </div>
                <div class="right">
                    <input id="CreditCardName" type="text" name="CreditCardNameField" required/><br />
                </div>
                <div class="left">
                    Expiration Date:
                </div>
                <div class="right">
                    <select id="CCExpiresMonth" name="ExpMonthField" required>
                                    <option value="" SELECTED>--Month--
                                    <option value="01">January (01)
                                    <option value="02">February (02)
                                    <option value="03">March (03)
                                    <option value="04">April (04)
                                    <option value="05">May (05)
                                    <option value="06">June (06)
                                    <option value="07">July (07)
                                    <option value="08">August (08)
                                    <option value="09">September (09)
                                    <option value="10">October (10)
                                    <option value="11">November (11)
                                    <option value="12">December (12)
                                 </select> /
                                 <select id="CCExpiresYear" name="ExpYearField" required>
                                    <option value="" SELECTED>--Year--
                                    <option value="16">2016
                                    <option value="17">2017
                                    <option value="18">2018
                                    <option value="19">2019
                                    <option value="20">2020
                                    <option value="21">2021
                                    <option value="22">2022
                                    <option value="23">2023
                                    <option value="24">2024
                                    <option value="25">2025
                                    <option value="26">2026
                                    <option value="27">2027
                                 </select><br />
                </div>
                <div class="left">
                    Shipping Method:
                </div>
                <div class="right">
                    <input type="radio" name="Shipping" value="Overnight" />Overnight<br />
                    <input type="radio" name="Shipping" value="2 Days Air" />2 Days Air<br />
                    <input type="radio" name="Shipping" value="6 Days Ground" />6 Days Ground<br />
                </div>
                <div class="left">
                    <input type="submit" value="Submit Email" />
                </div>
                    
            </form>
        </div>
        
     
        <div id="footer">
            Copyright © HatSpace.com
        </div>       
        
        <script src="js/item_description_js.js"></script> 
   
    </body>
</html>



