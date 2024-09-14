<?php
include('../functions/common_functions.php');  
include('../database/DbConnect.php'); 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <style>
    img{
        width: 50%;
        margin:auto;
        display: block;

    }
   </style>
</head>
<body>
    <!-- php code to get the user id -->
    <?php
    $ip= getIPAddress();
    $get_user="select * from `user_table` where user_ip='$ip'";
    $res= mysqli_query($con,$get_user);

    $fetch= mysqli_fetch_array($res);
    $user_id= $fetch['user_id'];

    ?>
    <div class="container">
        <h2 class="text-center text-danger">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <a href="https://whish.money/"><img src="whish_v2.png" alt="" target="_blank"></a> <!--target to open a new tab -->
        </div>
        <div class="col-md-6">
            <a href="order.php?user_id=<?php echo $user_id?>"><h2 class="text-center mt-5">Pay Offline</h2>
        </div>
</div>
    </div>
    
</body>
</html>