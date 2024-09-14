<?php
include ('DbConnect.php');
/*------------**connectServer**-----------------*/
function connectServer($host,$log,$pass,$mess)
{ 
	$dbc=@mysqli_connect($host,$log,$pass) 
	  or die("connection error:".@mysqli_errno($dbc).
	         ": ".@mysqli_error($dbc)
			 );
	
	if($mess == 1)	print '<p>Successfully connected to MySQL!</p>';
	return $dbc;
}
/*------------**selectDB**-----------------*/
function selectDB($dbc, $db, $mess)
{
	mysqli_select_db($dbc ,$db) 
	 or die ('<p style="color: red;">'.
			 "Could not select the database ".$db.
			 "because:<br/>".mysqli_error($dbc).
			 ".</p>");
	
	if ($mess == 1) echo "<p>The database $db has been selected.</p>";
}
/*------------**createDB**-----------------*/
function createDB($dbc,$db)
{
	$query= "CREATE DATABASE ".$db;
	mysqli_query($dbc,$query) 
	 or die('<p style="color: red;">'.
	        "Could not create the database ".
			$db." because:<br>".mysqli_error($dbc).
			".</p>");
		
	echo "<p>The database $db has been created!</p>";
}
/*------------**deleteDB**-----------------*/
function deleteDB($dbc,$db)
{
	$query= "DROP DATABASE IF EXISTS ".$db;
	mysqli_query($dbc,$query) 	 
     or die("DB Error: Could not delete the data base ".
		    $db."! <br>".@mysqli_error($dbc));
	
	print "<p> Data base $db deleted.</p>";
}
/*------------**deleteDB_v1**-----------------*/
function deleteDB_v1($dbc,$db,$tables)
{
	//$tables: array of tables names	
	foreach ($tables as $ind=>$table)
	{
		deleteDataFromTab($dbc, $table);
		deleteTable($dbc, $table);
	}
	$query= "DROP DATABASE IF EXISTS ".$db;
	mysqli_query($dbc,$query) 	 
     or die("DB Error: Could not delete the data base ".
		    $db."! <br>".@mysqli_error($dbc));
	
	print "<p> Data base $db deleted.</p>";
}
/*------------**createTable**-----------------*/
function createTable($dbc,$query,$Tab)
{
	//selectDB($dbc, $db); select base deja fait
	// Execute the query:
	if (@mysqli_query($dbc,$query))
	{
		print "<p> The table $Tab has been created.</p>";
	}
	else
	{
		$str='<p style="color: red;">';
		$str.="Could not create the table $Tab because:<br>";
		$str.=mysqli_error($dbc);
		$str.=".</p><p>The query being run was:".$query."</p>";
		print $str;		    
	}
}
/*------------**deleteDataFromTab**-----------------*/
function deleteDataFromTab($dbc, $Tab)
{
	$query = "DELETE FROM ".$Tab;
    @mysqli_query($dbc,$query) 
    or die ("DB Error: Could not delete data from table $Tab! <br>".
		     @mysqli_error($dbc));
	
	print "<p> All data are deleted inside table $Tab.</p>";
}
/*------------**deleteTable**-----------------*/
function deleteTable($dbc, $Tab)
{
	$query = "DROP TABLE IF EXISTS ".$Tab;
    @mysqli_query($dbc,$query) 
      or die ("DB Error: Could not delete table $Tab! <br>".
	          @mysqli_error($dbc));
	
	print "<p> Table $Tab deleted.</p>";
}
/*------------**insertDataToTab**-----------------*/
function insertDataToTab($dbc, $Tab, $query)
{
    @mysqli_query($dbc,$query) 
      or die ("DB Error: Could not insert $Tab! <br>".
			  @mysqli_error($dbc));
   
    print ("<h2 style = 'color: blue'> The $Tab was added successfully! </h2>");	
}
/*------------**executeQuery**-----------------*/
function executeQuery($dbc, $query)
{
    @mysqli_query($dbc,$query) 
      or die ("DB Error: Could not execute the query! <br>".
			  @mysqli_error($dbc));
   
    print ("<h2 style = 'color: blue'> The query was executed successfully! </h2>");	
}

function insertData()
{
	global $con;
	
// Insert data into Categories
mysqli_query($dbconnect, "INSERT INTO Categories (cat_title) VALUES
('Engines'),
('Brakes'),
('Tires')");

// Insert data into Brand
mysqli_query($dbconnect, "INSERT INTO Brand (brand_title) VALUES
('Toyota'),
('Brembo'),
('Michelin')");

// Insert data into product
mysqli_query($dbconnect, "INSERT INTO product (prod_title, prod_description, product_keywords, cat_id, brand_id, prod_img1, prod_img2, prod_img3, prod_price, status) VALUES
('V6 Engine', 'High-performance V6 engine', 'engine, car', 1, 1, 'engine1.jpg', 'engine2.jpg', 'engine3.jpg', 2999, 'Active'),
('Brake Pad Set', 'Premium brake pad set', 'brakes, car', 2, 2, 'brakes1.jpg', 'brakes2.jpg', 'brakes3.jpg', 99, 'Active'),
('All-Season Tires', 'Durable all-season tires', 'tires, car', 3, 3, 'tires1.jpg', 'tires2.jpg', 'tires3.jpg', 199, 'Active')");

// Insert data into Cart_details
mysqli_query($dbconnect, "INSERT INTO Cart_details (prod_id, ip_address, quantity) VALUES
(1, '192.168.1.1', 2),
(2, '192.168.1.2', 1),
(3, '192.168.1.1', 3)");

// Insert data into user_table
mysqli_query($dbconnect, "INSERT INTO user_table (user_name, user_email, user_password, user_image, user_ip, user_mobile, user_address) VALUES
('ahmad hijazi', 'ahmad@example.com', 'hashedpassword123', 'user1.jpg', '192.168.1.3', '1234567890', '123 Main St'),
('marwa tlais', 'marwa@example.com', 'hashedpassword456', 'user2.jpg', '192.168.1.4', '9876543210', '456 Oak St')");

// Insert data into user_orders
mysqli_query($dbconnect, "INSERT INTO user_orders (user_id, amount, invoice_number, total_prods, order_date, order_status) VALUES
(1, 1500, 1001, 3, '2024-01-22 12:30:00', 'completed'),
(2, 250, 1002, 1, '2024-01-23 10:45:00', 'pending')");

// Insert data into orders_pending
mysqli_query($dbconnect, "INSERT INTO orders_pending (user_id, invoice_number, prod_id, quantity, order_status) VALUES
(1, 1003, 2, 2, 'Pending'),
(2, 1004, 3, 1, 'Pending')");

// Insert data into user_payments
mysqli_query($dbconnect, "INSERT INTO user_payments (order_id, invoice_number, amount, payment_mode, payment_date) VALUES
(1, 1001, 1500, 'Wish', '2024-01-22 14:00:00'),
(2, 1002, 250, 'Wish', '2024-01-23 12:15:00')");

// Insert data into admin_table
mysqli_query($dbconnect, "INSERT INTO admin_table (admin_name, admin_password) VALUES
('admin1', 'pass1'),
('admin2', 'pass2')");

// Insert data into Contact
mysqli_query($dbconnect, "INSERT INTO Contact (Username, user_email, user_message) VALUES
('ahmad', 'carlover@example.com', 'Looking for more car parts.'),
('ali', 'autoshop@example.com', 'Interested in bulk orders of auto parts.')");	
}



function deleteAll()
{
	global $con;
    deleteTable($con, 'Categories');
    deleteTable($con, 'Brand');
    deleteTable($con, 'product');
    deleteTable($con, 'Cart_details');
    deleteTable($con, 'user_table');
    deleteTable($con, 'user_orders');
    deleteTable($con, 'orders_pending');
    deleteTable($con, 'user_payments');
    deleteTable($con, 'admin_table');
    deleteTable($con, 'Contact');
    deleteDB($con,'myStore');
}
?>