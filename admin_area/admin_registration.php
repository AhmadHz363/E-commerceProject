<?php
include('../database/DbConnect.php');
include('../functions/common_functions.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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
<body>
    <div class="container-fluid m-3 ">
         <div class="row d-flex justify-content-center ">
           
            <div class="col-lg-6 col-xl-4">
                <div class="inputform">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username"
                        placeholder="Enter you username" required="required"
                        class="form-control">
                    </div>
            
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password"
                        placeholder="Enter you password" required="required"
                        class="form-control">
                    </div>
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password"
                        placeholder="Enter you confirm_password" required="required"
                        class="form-control">
                    </div>
                    <div>
                        <input type="submit"class="bg-danger py-2 px-3 border-0" name="admin_registration" value="Registor">
                        <p class="small fw-bold mt-2 pt-1">Don't you have an account? <a href="admin_login.php" class="link-danger">Login</a></p>
                    </div>
                </form>
                </div>
            </div>
         </div>
    </div>
</body>
</html>
<?php
if(isset($_POST['admin_registration']))
{
    $username=$_POST['username'];
    $pass= $_POST['password'];
    $hash_pass= password_hash($pass,PASSWORD_DEFAULT);
    $confirm= $_POST['confirm_password'];

    //select data
    $query_sel= "select * from `admin_table` where admin_name= '$username'";
    $res_sel= mysqli_query($con,$query_sel);
    $rows_count= mysqli_num_rows($res_sel);
    if($rows_count>0)
    {
        echo "<script>alert('Username already exist !') </script>";
    }
    else if($pass != $confirm)
    {
        echo "<script>alert('Password and confirm password do not match') </script>";
    }
    else
    {
        $query_ins= "insert into `admin_table`(admin_name,admin_password) 
                       values ('$username','$hash_pass')";
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
}
?>