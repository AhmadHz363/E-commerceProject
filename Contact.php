<!--Connect file -->
<?php
include ('database/DbConnect.php');

//including function
include('./functions/common_functions.php');
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-commerce website using php and mysql</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" >
   <!-- Css link -->
   <link rel="stylesheet" href="style.css">
    <!--font awesom link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
</head>
<style>
    
.medsos{
    margin-bottom: 40px;
}

.medsos i{
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    color: black;
    border: 3.5px solid red;
    border-radius: 50%;
    backdrop-filter: brightness(88%);
    box-shadow: 0 0 20px transparent;
    cursor: pointer;
    transition: all .50s ease;
}

.medsos i:hover{
    transform: scale(1.1);
    box-shadow: 0 0 20px red;
}
</style>
  <body>
    
    <!--nav bar -->
    <div class= "container-fluid p-0">
        <!--first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-danger">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all_products.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_area/admin_login.php">Admin Page </a>
        </li>
        <?php
       if(isset($_SESSION['username'])){
          echo 
        "<li class= 'nav-item'> 
        <a class= 'nav-link' href='./users_area/profile.php'>My Account</a> </li>";
      }else{
      echo 
        "<li class= 'nav-item'>
        <a class= 'nav-link' href='./users_area/user_registration.php'>Register</a> </li>";
       }
?>
        
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i> <sup> <?php cart_num_Items();?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total price: <?php  total_price()?></a>
        </li>
       
      </ul>
      <form class="d-flex" action="search_product.php" method= "get" >
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name= "search_data">
        <!-- <button class="btn btn-outline-light" type="submit">Search</button> -->
        <input type="submit" value= "Search" class= "btn btn-outline-light" name= "search_data_product">
      </form>
    </div>
  </div>
</nav>

<!--Second Child-->
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
<ul class="navbar-nav me-auto">

<?php
if(!isset($_SESSION['username']))
{
  echo "<li class='nav-item'>
  <a class='nav-link active'  href='#'>Welcome Guest</a>
</li>";
}
else
{
  echo "<li class='nav-item'>
  <a class='nav-link active'  href='./users_area/profile.php'>Welcome ".$_SESSION['username']."</a>
</li>";
}

if(!isset($_SESSION['username']))
{
  echo "<li class='nav-item'>
  <a class='nav-link active'  href='./users_area/user_login.php'>Login</a>
</li>";
}
else
{
  echo "<li class='nav-item'>
  <a class='nav-link active'  href='./users_area/logout.php'>Logout</a>
</li>";
}
?>

</ul>
</nav>
<!-- Third child -->
<div class="bg-light">
  <h3 class="text-center">Auto-part store</h3>
  <p class="text-center">Communication is at heart of e-commerce and community</p>
</div>

<!-- form send  -->
<div class="container-fluid w-50">
    <h1 class="text-center mt-5 text-success">CONTACT US!</h1>
    <p>We can't solve the problem if you don't tell us about it!</p>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="your name" class= "form-control">
        <input type="email" name="email" placeholder="your email" class= "form-control mt-4">
        <input type="text" name="message" placeholder="Message" class= "form-control mt-4"   >

        <input type="submit" value= "submit" class="btn btn-danger mt-4 mb-5" name="submit">
    </form>
    <div class="medsos">
                <a href="#"><i class="ri-tiktok-fill"></i></a>
                <a href="#"><i class="ri-instagram-fill"></i></a>
                <a href="#"><i class="ri-twitter-x-fill"></i></a>
                <a href="#"><i class="ri-linkedin-box-fill"></i></a>
    </div>
</div>


<!-- footer -->
<div class= "bg-danger p-3 text-center">
<p text-light>All rights reserved @-Designed by Ahmad hijazi and Marwa Tlais-2023</p>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>

<?php
if(isset($_POST['submit']))
{
  $username= $_POST['name'];
  $email= $_POST['email'];
  $mesg= $_POST['message'];

  $query= "insert into `Contact`(Username,user_email,user_message) values('$username','$email','$mesg')";

  $res=mysqli_query($con,$query);
  if($res)
  {
    echo "<script> alert('message submited succesfully') </script>";
    echo "<script> window.open('index.php','_self') </script>";
  }
  else
  {
    echo "<script> alert('error happend') </script>";
  }
}
?>

