<!--Connect file -->
<?php
include ('../database/DbConnect.php');
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-commerce website Checkout page</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
   <!-- Css link -->
   <link rel="stylesheet" href="style.css">
    <!--font awesom link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
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
          <a class="nav-link" href="user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
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
  <h3 class="text-center">Hidden Store</h3>
  <p class="text-center">Communication is at heart of e-commerce and community</p>
</div>

<!-- Forth child -->
<div class="row">
  <div class="col -md-10">
    <!-- products-->
    <div class="row">

    <!-- Fetching products-->
    <?php
 
    ?>
     


    </div>
  </div>

  <!--forth child -->
  <div class="row px-1">
    <div class="col md-12">
        <!-- products -->
        <div class="row">
            <?php
            if(!isset($_SESSION['username']))
            {
                include('user_login.php');
            }
            else
            {
                include('payment.php');
            }
            ?>
        </div>
    </div>
  </div>
 
  </div>
</div>

</div>

<!-- footer -->
<div class= "bg-danger p-3 text-center mt-5">
  <p text-light>All rights reserved @-Designed by Ahmad-2023</p>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>

