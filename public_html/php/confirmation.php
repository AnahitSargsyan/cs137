 <?php
 session_start();

        $servername = "sylvester-mccoy-v3.ics.uci.edu";
        $username = "inf124grp30";
        $password = "st#VuY6R";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=inf124grp30", $username, $password);
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTYION);
            //echo "Connected Successfully";
	



$the_id = $_SESSION['order_id'];

$sql = "SELECT hat_id, quantity, first_name, last_name, phone, address, city, state, zip, email , shipping FROM orders WHERE id = $the_id"; 
    
			foreach ($conn->query($sql) as $row) { 
				$the_hat_id =  $row['hat_id'];
				$the_quantity = $row['quantity'];
				$the_name = $row['first_name'].' '.$row['last_name'];
				$the_phone = $row['phone'];
				$the_address = $row['address'];
				$city_state_zip = $row['city']. ', '. $row['state'] . ' ' . $row['zip'];
				$the_email = $row['email'];
				$the_zip = $row['zip'];
				$the_shipping = $row['shipping'];

			}



$sql = "SELECT tax_rate FROM tax_rates WHERE zip_code = $the_zip";
			foreach ($conn->query($sql) as $row){
				$the_tax_rate = $row['tax_rate'] ;
				//print $the_tax_rate;
			
			}
			$formatted_tax_rate =number_format($the_tax_rate *100 ,2,'.','').'%';

$sql = "SELECT title, price FROM hats WHERE id = $the_hat_id";
			foreach ($conn->query($sql) as $row){
				$the_price = $row['price'];
				$the_title = $row['title'];
			//	print $the_price;
			}
	

	$before_tax = $the_price * $the_quantity;
	//print $before_tax;
	$the_tax = $before_tax * $the_tax_rate;
	//print $the_tax;
	$total = '$'. number_format($before_tax + $the_tax, 2,'.','');


print "<!DOCTYPOE html>

<html>
	<head>

	</head>


	<body style=\"background-color:burlywood;\">
	<h1> Thank you for your order</h1>
	<h2> This is your confirmation</h2>

		<table>
			<tr>
				<td>Order ID:</td><td> $the_id</td>
			</tr>
			<tr>
				<td>Hat Name:</td><td> $the_title (Hat ID: $the_hat_id)</td>
			</tr>
			<tr>
				<td>Quantity:</td><td> $the_quantity</td>
			</tr>
			<tr>
				<td>Name:</td><td> $the_name</td>
			</tr>
			<tr>
				<td>Address:</td><td> $the_address</td>
			</tr>

			<tr>
				<td></td><td> $city_state_zip</td>
			</tr>
			<tr>
				<td>Phone:</td><td> $the_phone</td>
			</tr>
			<tr>
				<td>Email:</td><td>$the_email</td>
			</tr>
			<tr>
				<td>Shipping:</td><td> $the_shipping</td>
			</tr>
			<tr>
				<td>Tax:</td><td>$formatted_tax_rate</td>
			</tr>
			<tr>
				<td>Order Total:</td><td> $total</td>
			</tr>


		</table>
	</body>

</html>";














}
		catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}

		
?>

