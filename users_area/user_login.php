<?php
include('../functions/common_functions.php');  
include('../database/DbConnect.php'); 
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User-Registration</title>
       <!--bootstrap CSS link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<!--bootstrap link -->  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- Css link --> 

<!-- font awesom link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  

<style>
 body{
    overflow-x: hidden;
 }

</style>
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center ">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
             <form action="" method="post" enctype="multipart/form-data"><!-- enctype becuase i want to read an image as input -->
                <!-- username  -->
               <div class="form-outline mb-4">
                <label for="user_username" class="form-lable">Username</label>
                <input type="text" name="username" id= "user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" >
               </div>
          

               <!-- password -->
               <div class="form-outline mb-4">
                <label for="user_password" class="form-lable">Password</label>
                <input type="password" name="password" id= "user_password" class="form-control" placeholder="Enter your password" autocomplete="off"  required="required" >
              

               <div class="text-center pt-2">
                <input type="submit" value="Login" class="bg-danger py-2 px-3 border-0 " name="user_login">
                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? &nbsp &nbsp<a href="user_registration.php" class="text-danger text-decoration-none">Register</a></p>
               </div>



             </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['user_login']))
{
    $username= $_POST['username'];
    $pass= $_POST['password'];

    $query_sel="select * from `user_table` where user_name='$username'";
    $res= mysqli_query($con,$query_sel);
    $num_rows= mysqli_num_rows($res);
    $row_data= mysqli_fetch_assoc($res);
    $ip= getIPAddress();
    //cart item
    $query_sel_cart="select * from `cart_details` where ip_address='$ip'";
    $select_cart= mysqli_query($con,$query_sel_cart);
    $row_cart= mysqli_num_rows($select_cart);


    if($num_rows >0)
    {
        $_SESSION['username']= $username;
        if(password_verify($pass,$row_data['user_password']))
        {
            $_SESSION['username']= $username;
            // echo "<script> alert('Login successfuly') </script>";
            if($num_rows ==1 and $row_cart==0)
            {
                echo "<script> alert('Login successfuly') </script>";
                echo "<script> window.open('profile.php','_self') </script>";
            }
            else
            {
                $_SESSION['username']= $username;
                echo "<script> alert('Login successfuly') </script>";
                echo "<script> window.open('payment.php','_self') </script>";
            }
        }
        else
        {
            echo "<script> alert('Invalid password') </script>";
        }
    }
    else
    {
        echo "<script> alert('Invalid username ') </script>";
    }
}
?>