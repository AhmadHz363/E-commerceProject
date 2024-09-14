<?php
include 'database_lib.php';
?>
<?php
$server_name= "localhost";
$server_log= "root";
$server_pass= "root";
$dbconnect= connectServer($server_name,$server_log,$server_pass,1);

$DbName= "MyStore";
//  createDB($dbconnect,$DbName);

// // Creating category table

selectDB($dbconnect,$DbName,1);

 $queryCat = "CREATE TABLE IF NOT EXISTS `Categories` (
         cat_id INT  PRIMARY KEY AUTO_INCREMENT,
   cat_title CHAR(255)
 )";

 mysqli_query($dbconnect, $queryCat);

 // Creating Brand Table
 $queryBrand = "CREATE TABLE IF NOT EXISTS `Brand` (
     brand_id  INT PRIMARY KEY AUTO_INCREMENT ,
     brand_title CHAR(255)
 )";
mysqli_query($dbconnect, $queryBrand);



//Creating product table

$queryProd= "CREATE TABLE IF NOT EXISTS  `product`(
    prod_id INT AUTO_INCREMENT PRIMARY KEY,
    prod_title CHAR(255),
    prod_description CHAR(255),
    product_keywords CHAR(255),
    cat_id INT,
    brand_id  INT,
    prod_img1 CHAR(255),
    prod_img2 CHAR(255),
    prod_img3 CHAR(255),
    prod_price INT,
    status CHAR(255),
    FOREIGN KEY (cat_id) REFERENCES categories(cat_id),
    FOREIGN KEY (brand_id) REFERENCES brand(brand_id)
    )";

 $createProd= mysqli_query($dbconnect,$queryProd);


$queryCart= "CREATE TABLE IF NOT EXISTS `Cart_details` (
    prod_id INT  PRIMARY KEY,
    ip_address CHAR(255),
    quantity INT
)"; 
$createCart_details= mysqli_query($dbconnect,$queryCart);

$query_user= "CREATE TABLE IF NOT EXISTS `user_table`(
     user_id    INT PRIMARY KEY AUTO_INCREMENT ,
     user_name  CHAR(255),
     user_email CHAR(255) ,
     user_password CHAR(255),
     user_image CHAR(255),
     user_ip  CHAR(255),
     user_mobile CHAR(20),
     user_address CHAR(255)
     )
     ";
   $createCart_details= mysqli_query($dbconnect,$query_user);

 $query_user_orders="CREATE TABLE IF NOT EXISTS `user_orders`(
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    amount INT,
    invoice_number INT,
    total_prods INT, 
    order_date TIMESTAMP,
    order_status CHAR(255),
    FOREIGN KEY (user_id) REFERENCES user_table(user_id)
    )";
    $create_user_orders= mysqli_query($dbconnect,$query_user_orders);
   $query_orders_pending="CREATE TABLE IF NOT EXISTS `orders_pending`(
    order_id INT,
    user_id INT,
    invoice_number INT,
    prod_id INT,
    quantity INT,
    order_status CHAR(255),
    FOREIGN KEY (order_id) REFERENCES user_orders(order_id),
    FOREIGN KEY (user_id) REFERENCES user_table(user_id)
    )";
     $create_orders_pending= mysqli_query($dbconnect,$query_orders_pending);

    $query_userPayments="CREATE TABLE IF NOT EXISTS  `user_payments`(
        payment_id INT PRIMARY KEY AUTO_INCREMENT,
        order_id INT,
        invoice_number INT,
        amount INT,
        payment_mode CHAR(255),
        payment_date TIMESTAMP,
        FOREIGN KEY (order_id) REFERENCES user_orders(order_id)
        )";

    $create_userPayment= mysqli_query($dbconnect,$query_userPayments);

    $query_adminTable="CREATE TABLE IF NOT EXISTS `admin_table`(
    admin_id    INT PRIMARY KEY AUTO_INCREMENT ,
    admin_name  CHAR(255),
    admin_password CHAR(255)
      )";
    $create_adminPayment= mysqli_query($dbconnect,$query_adminTable);

    $query_contactTable="CREATE TABLE IF NOT EXISTS `Contact`(
      user_id INT PRIMARY KEY AUTO_INCREMENT,
      Username  CHAR(255),
      user_email  CHAR(255),
      user_message CHAR(255)
        )";
      $create_contact= mysqli_query($dbconnect,$query_contactTable);


      
     //uncomment this to insert the data 
     // insertData();

     //uncomment this to delete all the database
    //  deleteAll();
?>
