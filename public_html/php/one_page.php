
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
        
   	
        $action = $_SERVER["PHP_SELF"];
        $submit = "Verify Order";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $hatID = test_input($_POST["HatID"]);
            $id = test_input($_POST["HatID"]);
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
            // check if quantity is numeric
            echo "CHECKING FOR VALIDITY";
            if (!is_numeric($quantity)) {
                $quantityErr = "Quantity must be positive";
                console_log($quantityErr);
            }
            elseif(intval($quantity) <= 0) {
                $quantityErr = "Quantity must be positive";
                console_log($quantityErr); 
            }
                
            elseif (ctype_alpha($firstname) == false) {
                $firstnameErr = "Names must be alphabetical";
                console_log($firstnameErr);  
            }
            elseif (ctype_alpha($lastname) == false) {
                $lastnameErr = "Names must be alphabetical";
                console_log($lastnameErr);  
            }
            elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $emailErr = "not a valid email"; 
                console_log($emailErr);  
                            
            }
            elseif(!is_numeric($phonenumber)) {
                $phoneErr = "phone number must be 10 digits long"; 
                console_log($phoneErr);  
            }
            elseif(strlen($phonenumber) != 10) {
                $phoneErr = "phone number must be 10 digits long"; 
                console_log($phoneErr);  
            }
            
            elseif (ctype_alpha($city) == false) {
                $cityErr = "Cities must be alphabetical";
                console_log($cityErr);  
            }
            elseif (ctype_alpha($state) == false) {
                $stateErr = "States must be alphabetical";
                console_log($stateErr);  
            }
            elseif(!is_numeric($zipcode)) {
                $zipErr = "ZIP codes must be 5 digits";
                console_log($zipErr);    
            }
            elseif(strlen($zipcode) != 5) {
                    $zipErr = "ZIP codes must be 5 digits";
                    console_log($zipErr);  
            }
            
            elseif(!is_numeric($ccnumber)) {
                $ccnumErr = "CC numbers must be 16 digits";
                console_log($ccnumErr);
            }
            elseif(strlen($ccnumber) != 16) {
                    $ccnumErr = "CC numbers must be 16 digits";
                    console_log($ccnumErr);  
            }
            
            elseif (ctype_alpha($ccname) == false) {
                $ccnameErr = "names must be alphabetical";
                console_log($ccnameErr);  
            }
            else {
                echo "GETTING STUCK HERE";
                $submit = "Submit Order";
                $action = "confirmation.php";
                
                
            }
            
        }
        
    } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

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
            <form action = "<?php echo $action; ?>" name = "OrderForm" method="post">
      
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
                    <input id="QuantityOrdered" type="text" name="QuantityField" value="<?php echo $quantity; ?>" required/><br />
                </div>
                <div class="left">
                    First Name: 
                </div>
                <div class="right">
                    <input id="FirstName" type="text" name="FirstNameField"  value="<?php echo $firstname; ?>" required/><br />
                </div>
                <div class="left">
                    Last Name: 
                </div>
                <div class="right">
                    <input id="LastName" type="text" name="LastNameField"  value="<?php echo $lastname; ?>" required/><br />
                </div>
                <div class="left">
                    Email: 
                </div>
                <div class="right">
                    <input id="EmailAddress" type="text" name="EmailAddressField"  value="<?php echo $email; ?>" required/><br />
                </div>
                <div class="left">
                    Phone Number: 
                </div>
                <div class="right">
                    <input id="PhoneNumber" type="text" name="PhoneNumberField" maxlength="10" value="<?php echo $phonenumber; ?>" required/><br />
                </div>
                <div class="left">
                    Address: 
                </div>
                <div class="right">
                    <input id="ShippingAddress" type="text" name="ShippingAddressField"  value="<?php echo $address; ?>" required/><br />
                </div>
                <div class="left">
                    City: 
                </div>
                <div class="right">
                    <input id="CityName" type="text" name="CityField"  value="<?php echo $city; ?>" required/><br />
                </div>
                <div class="left">
                    State: 
                </div>
                <div class="right">
                    <input id="StateName" type="text" name="StateField"  value="<?php echo $state; ?>" required/><br />
                </div>
                <div class="left">    
                    ZIP: 
                </div>
                <div class="right">
                    <input id="ZipCode" type="text" name="ZipCodeField" maxlength="5"  value="<?php echo $zipcode; ?>" required/><br />
                </div>
                <div class="left">
                    Card Number: 
                </div>
                <div class="right">
                    <input id="CreditCardNumber" type="text" name="CreditCardNumberField" maxlength="16"  value="<?php echo $ccnumber; ?>" required/><br />
                </div>
                <div class="left">
                    Name on card: 
                </div>
                <div class="right">
                    <input id="CreditCardName" type="text" name="CreditCardNameField"  value="<?php echo $ccname; ?>" required/><br />
                </div>
                <div class="left">
                    Expiration Date:
                </div>
                <div class="right">
                    <select id="CCExpiresMonth" name="ExpMonthField" required>
                                    <option value="" >--Month--
                                    <option value="01" <?php if($expmonth == "01") echo "selected"; ?> >January (01)
                                    <option value="02" <?php if($expmonth == "02") echo "selected"; ?> > February (02)
                                    <option value="03" <?php if($expmonth == "03") echo "selected"; ?> >March (03)
                                    <option value="04" <?php if($expmonth == "04") echo "selected"; ?> >April (04)
                                    <option value="05" <?php if($expmonth == "05") echo "selected"; ?> >May (05)
                                    <option value="06" <?php if($expmonth == "06") echo "selected"; ?> >June (06)
                                    <option value="07" <?php if($expmonth == "07") echo "selected"; ?> >July (07)
                                    <option value="08" <?php if($expmonth == "08") echo "selected"; ?> >August (08)
                                    <option value="09" <?php if($expmonth == "09") echo "selected"; ?> >September (09)
                                    <option value="10" <?php if($expmonth == "10") echo "selected"; ?> >October (10)
                                    <option value="11" <?php if($expmonth == "11") echo "selected"; ?> >November (11)
                                    <option value="12" <?php if($expmonth == "12") echo "selected"; ?> >December (12)
                                 </select> /
                                 <select id="CCExpiresYear" name="ExpYearField" required>
                                    <option value="" >--Year--
                                    <option value="2016" <?php if($expyear == "2016") echo "selected"; ?> >2016
                                    <option value="2017" <?php if($expyear == "2017") echo "selected"; ?> >2017
                                    <option value="2018" <?php if($expyear == "2018") echo "selected"; ?> >2018
                                    <option value="2019" <?php if($expyear == "2019") echo "selected"; ?> >2019
                                    <option value="2020" <?php if($expyear == "2020") echo "selected"; ?> >2020
                                    <option value="2021" <?php if($expyear == "2021") echo "selected"; ?> >2021
                                    <option value="2022" <?php if($expyear == "2022") echo "selected"; ?> >2022
                                    <option value="2023" <?php if($expyear == "2023") echo "selected"; ?> >2023
                                    <option value="2024" <?php if($expyear == "2024") echo "selected"; ?> >2024
                                    <option value="2025" <?php if($expyear == "2025") echo "selected"; ?> >2025
                                    <option value="2026" <?php if($expyear == "2026") echo "selected"; ?> >2026
                                    <option value="2027" <?php if($expyear == "2027") echo "selected"; ?> >2027
                                 </select><br />
                </div>
                <div class="left">
                    Shipping Method:
                </div>
                <div class="right">
                    <input type="radio" name="Shipping" value="Overnight" <?php if($shipping == "Overnight") echo "checked"; ?> />Overnight<br />
                    <input type="radio" name="Shipping" value="2 Days Air" <?php if($shipping == "2 Days Air") echo "checked"; ?>  />2 Days Air<br />
                    <input type="radio" name="Shipping" value="6 Days Ground" <?php if($shipping == "6 Days Ground") echo "checked"; ?>  />6 Days Ground<br />
                </div>
                <div class="left">
                    <input type="submit" value="<?php echo $submit; ?>" />
                </div>
                    
            </form>
        </div>
        
     
        <div id="footer">
            Copyright © HatSpace.com
        </div>       
        
        
   
    </body>
</html>



