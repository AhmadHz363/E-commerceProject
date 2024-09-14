<?php
include('../functions/common_functions.php');  
include('../database/DbConnect.php'); 

if(isset($_GET['user_id']))
{
   $user= $_GET['user_id'];

}

//getting the total price 
$ip= getIPAddress();
$total_price=0;
$query_price="select * from `cart_details` where ip_address= '$ip'";
$res_cart= mysqli_query($con,$query_price);
$invoice=mt_rand();
$status='pending'; //initial state for all products
$count_prod= mysqli_num_rows($res_cart);
while($count_prod= mysqli_fetch_array($res_cart))
{
    $prod_id= $count_prod['prod_id'];
    $query_select_prod= "select * from `product` where prod_id='$prod_id'";
    $res_selProd= mysqli_query($con,$query_select_prod);
    while($count_prod= mysqli_fetch_array($res_selProd))
    {
        $prod_price= array($count_prod['prod_price']);
        $prod_sum= array_sum($prod_price);
        $total_price += $prod_sum;
    }
}

//getting quantity from cart
$query_get_cart= "select * from `cart_details` ";
$res_get_cart=mysqli_query($con,$query_get_cart);
$get_quantity=mysqli_fetch_array($res_get_cart);
$quantity= $get_quantity['quantity'];
if($quantity ==0)
{
    $quantity=1;
    $subtotal= $total_price;
}
else
{
    $quantity= $quantity;
    $subtotal= $total_price*$quantity; // if their is multiple item of same type
}

//inserting to user_orders
$query_insert_orders= "insert into `user_orders`(user_id,amount,invoice_number,total_prods,order_date,order_status)
                                            values($user,$subtotal,$invoice,'$quantity',now(),'$status') ";
 $res_ins= mysqli_query($con,$query_insert_orders);
 if($res_ins)
 {
    echo "<script>alert('Orders are submitted successfully') </script>";
    echo "<script>window.open('profile.php','_self')</script>"; //self mean to open profile in the same tab
 }

 //insert to orders_pending
 $query_insert_Porders= "insert into `orders_pending`(user_id,invoice_number,prod_id,quantity,order_status )
                                            values($user,$invoice,$prod_id,'$quantity','$status') ";
 $res_ins_Porders= mysqli_query($con,$query_insert_Porders);

 //deleting items from cart after inserting
 $empty_cart= "delete from `cart_details` where ip_address= '$ip'";
 $res_del= mysqli_query($con,$empty_cart);

?>