
<?php
include ('../database/DbConnect.php');
//including function
session_start();
?>

<!DOCTYPE htm1> 
<html lang= "en">
<head>
<meta charset= "UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User orders </title>
</head> 
<body>
<!--Whatever data i have in db, that data shoud be displayed here> To Get Data From Db-->
<?php
$username= $_SESSION['username'];
$get_user="Select * from `user_table` where user_name='$username'";
$result=mysqli_query($con, $get_user);
$row_fetch=mysqli_fetch_assoc($result);
$user_id=$row_fetch['user_id'];
?>
<h3 class="text-danger text-center">All my Orders</h3>
<table class="table table-bordered mt-5">
<thead class="bg-info">
<th>S1no</th>
<th>Amount Due </th>
<th>Total products</th> 
<th>Invoice number</th> 
<th>Date</th> 
<th>Complete/Incomplete </th>
<th>Status</th>
</thead>
<tbody class="bg-secondary text-light">
<?php
$get_order_details="Select * from `user_orders` where user_id=10";
$result_orders=mysqli_query($con, $get_order_details);
while($row_orders=mysqli_fetch_assoc($result_orders)){
   $order_id=$row_orders['order_id'];
   $amount=$row_orders['amount'];
   $total_prods=$row_orders['total_prods'];
   $invoice_number=$row_orders['invoice_number'];
   $order_status=$row_orders['order_status'];
   if ($order_status== 'pending'){
      $order_status2='Incomplete';
    }
   else{
      $order_status2='Complete';
    }
   $order_date=$row_orders ['order_date'];
   $number=1;
    echo"
<tr>
<td>$number</td>
<td>$amount</td>
<td>$total_prods</td>
<td>$invoice_number</td> 
<td>$order_date</td>
<td>$order_status2</td>";
?>
<?php
if($order_status=='Complete'){
echo "<td>Paid</td>";
}
else{
echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-danger'>Confirm</a></td>
</tr>";
}
$number++;
}
?>
</tbody>
</body>
</html>