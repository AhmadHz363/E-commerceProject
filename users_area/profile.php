<!--Connect file -->
<?php
include ('../database/DbConnect.php');

//including function
include('../functions/common_functions.php');
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome <?php echo $_SESSION['username'] ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
   <!-- Css link -->
   <link rel="stylesheet" href="style.css">
    <!--font awesom link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
    <style>
        img{
            width:100%;
            display:block;
            height: 100%;
            margin:auto;
            object-fit:contain;
        }
        .row{
            color: white;
        }
        /* body{
    overflow-x: hidden;
 } */
    </style>
</head>
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
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all_products.php">Products</a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i> <sup> <?php cart_num_Items();?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total price: <?php  total_price()?></a>
        </li>
       
      </ul>
      <form class="d-flex" action="../search_product.php" method= "get" >
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
  <a class='nav-link active'  href='#'>Welcome ".$_SESSION['username']."</a>
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
  <a class='nav-link active'  href='logout.php'>Logout</a>
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

<!-- Forth child -->
<div class="row">
    <div class="col-md-2 p-0">
      <ul class="navbar-nav bg-dark text-center" style="height:100vh"> 
        <li class="nav-item bg-danger">
          <a class="nav-link" href="#"><h4>Your Profile</h4></a>
        </li>
        <?php
        $user= $_SESSION['username'];
        //fetching the image from the database
        $query_user_img= "select * from `user_table` where user_name='$user'";
        $res_img= mysqli_query($con,$query_user_img);
        $row_img= mysqli_fetch_array($res_img);
        $user_img=$row_img['user_image']; 
        echo " <li class='nav-item'>
        <img src='./user_images/$user_img' class='profile-image' alt='profile-image'>
         </li>"
        ?>
         <li class="nav-item">
          <a class="nav-link" href="profile.php">Pending orders</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php?edit_account">Edit Account</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php?my_orders">My orders</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php?delete_account">Delete Account</h4></a>
        </li>   
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</h4></a>
        </li>
        
    </ul>
    </div>
    <div class="col-md-10">
    <?php getU_order_details();
    if(isset($_GET['edit_account'])){
      include('editaccount.php');
   }
   if(isset($_GET['my_orders'])){
    include('user_orders.php');
    }
    if(isset($_GET['delete_account'])){
      include('delete_account.php');
      }
   ?>
    
    </div>
  
</div>
<!-- footer -->
<!-- <div class= "bg-danger p-3 text-center">
  <p text-light>All rights reserved @-Designed by Ahmad-2023</p>
</div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
          
  
</html>

<?php

?>