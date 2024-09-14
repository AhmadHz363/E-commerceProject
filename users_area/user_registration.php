
<?php
include('../database/DbConnect.php');
include('../functions/common_functions.php');
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
        background-color: black;
    }
    h2{
        color:white;
    }
    label{
        color:white;
    }
    p{
        color:white;
    }

</style>
</head>
<body>
    <div class="container-fluid">
        <h2 class="text-center ">New user Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
             <form action="" method="post" enctype="multipart/form-data"><!-- enctype becuase i want to read an image as input -->
                <!-- username  -->
               <div class="form-outline mb-4">
                <label for="user_username" class="form-lable">Username</label>
                <input type="text" name="username" id= "user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" >
               </div>
               <!-- Email -->
               <div class="form-outline mb-4">
                <label for="user_email" class="form-lable">Email</label>
                <input type="email" name="email" id= "user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" >
               </div>

               <!-- image -->
               <div class="form-outline mb-4">
                <label for="user_image" class="form-lable">Image</label>
                <input type="file" name="image" id= "user_image" class="form-control"  required="required" >
               </div>

               <!-- password -->
               <div class="form-outline mb-4">
                <label for="user_password" class="form-lable">Password</label>
                <input type="password" name="password" id= "user_password" class="form-control" placeholder="Enter your password" autocomplete="off"  required="required" >
               </div>
               <!-- confirm password -->
               <div class="form-outline mb-4">
                <label for="confirm" class="form-lable">Confirm password</label>
                <input type="password" name="confirm_pass" id= "confirm" class="form-control" placeholder="Confirm your password" autocomplete="off"  required="required" >
               </div>

               <!-- Address -->
               <div class="form-outline mb-4">
                <label for="address" class="form-lable">Address</label>
                <input type="text" name="address" id= "address" class="form-control" placeholder="Enter your address" autocomplete="off"  required="required" >
               </div>
               <!-- Contact field -->
               <div class="form-outline mb-4">
                <label for="contact" class="form-lable">Contact </label>
                <input type="text" name="contact" id= "confirm" class="form-control" placeholder="Enter your mobile number" autocomplete="off"  required="required" >
               </div>

               <div class="text-center">
                <input type="submit" value="Register" class="bg-danger py-2 px-3 border-0 " name="user_register">
                <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? &nbsp &nbsp<a href="user_login.php" class="text-danger text-decoration-none">Login</a></p>
               </div>



             </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- php -->
<?php
if(isset($_POST['user_register']))
{
    $username=$_POST['username'];
    $email= $_POST['email'];
    $pass= $_POST['password'];
    $hash_pass= password_hash($pass,PASSWORD_DEFAULT);
    $confirm= $_POST['confirm_pass'];
    $address= $_POST['address'];
    $contact=$_POST['contact'];
    $image= $_FILES['image']['name'];
    $temp_image= $_FILES['image']['tmp_name'];
    $ip= getIPAddress();

    //select data
    $query_sel= "select * from `user_table` where user_name= '$username' or user_email='$email'";
    $res_sel= mysqli_query($con,$query_sel);
    $rows_count= mysqli_num_rows($res_sel);
    if($rows_count>0)
    {
        echo "<script>alert('Username or email already exist !') </script>";
    }
    else if($pass != $confirm)
    {
        echo "<script>alert('Password and confirm password do not match') </script>";
    }
    else
    {
         //insert data 
         move_uploaded_file($temp_image,"./user_images/$image"); //store te=he images in this folder
        $query_ins= "insert into `user_table`(user_name,user_email,user_password,user_image,user_ip,user_mobile,user_address) 
                       values ('$username','$email','$hash_pass','$image','$ip','$contact','$address')";
        $res= mysqli_query($con,$query_ins);

        if($res)
        {
            echo "<script>alert('Data inserted successfuly') </script>";
        }
    
        else
        {
            echo "<script>error happened</script>";
        }
    }

    //select cart items
    $select_cart="select * from `cart_details` where ip_address='$ip'";
    $res_sel_cart= mysqli_query($con,$select_cart);
    $rows_count_sc= mysqli_num_rows($res_sel_cart);
    if($rows_count_sc>0)
    {
        $_SESSION['username']= $username;
        echo "<script>alert('You have items in your cart') </script>";
         echo "<script>window.open('checkout.php','_self') </script>";
    }
    else
    {
        echo "<script>window.open('../index.php','_self') </script>";
    }
   
}
?>