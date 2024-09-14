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
    <title>Admin Login</title>
    <style>
body{
    overflow:hidden;
}
    
    </style>
        <!--bootstrap CSS link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<!--bootstrap link -->  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- Css link --> 
<link rel="stylesheet" href="../style.css">
<!-- font awesom link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  

</head>
<style>
        body {
            margin: 0;
            padding: 0;
            background: url('images/wal.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }
        .inputform{
        margin-right:40px;
        border: 5px solid transparent;
        padding:40px;
        box-shadow: 0 0 10px 0px red;
        animation: glow 1.5s infinite alternate;
    }
    
    p{
        margin-top: 30px;
    }
    p:hover{
       
        padding:1px;
    }
    </style>
<body >
  
    <div class="container-fluid m-5 ">
       
         <div class="row d-flex justify-content-center ">
       
            <div class="col-lg-6 col-xl-4">
                <div class="inputform">            
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username"  placeholder="Enter you username" required="required" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password"
                        placeholder="Enter you password" required="required"
                        class="form-control">
                    </div>
                    <div>
                        <input type="submit"class="bg-danger py-2 px-3 border-0" name="admin_login" value="Login">
                        <p class="small fw-bold mt-2 pt-1">Do you already have an account? <a href="admin_registration.php" class="link-danger">Register</a></p>
                    </div>
                </form>
            </div>
            </div>
         </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['admin_login']))
{
    $username= $_POST['username'];
    $pass= $_POST['password'];

    $query_sel="select * from `admin_table` where admin_name='$username'";
    $res= mysqli_query($con,$query_sel);
    $num_rows= mysqli_num_rows($res);
    $row_data= mysqli_fetch_assoc($res);

    if($num_rows >0)
    {
      
        if(password_verify($pass,$row_data['admin_password']))
        {
           
            // echo "<script> alert('Login successfuly') </script>";
            if($num_rows==1)
            {
                echo "<script> alert('Login successfuly') </script>";
                echo "<script> window.open('index.php','_self') </script>";
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