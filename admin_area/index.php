<!--Connect file -->
<?php
include ('../database/DbConnect.php');

//including function
include('../functions/common_functions.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-sc .0">
    <!--bootstrap CSS link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<!--bootstrap link -->  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- Css link --> 
<link rel="stylesheet" href="../style.css">
<!-- font awesom link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  

    <title>Admin Dashbord</title>

   <style>
    .admin-image{
    width: 100px;
    object-fit: contain;
     }
    

     body{
      overflow-x:hidden;
     }
     img{
    width: 100px;
    object-fit: contain;
     }
    
   </style>
</head>

<body>
    <!-- NavBar-->
    <div class="container-fluid p-0 ">
        <!--First Child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
            <img src="images/admin.jpg" alt="" class= "logo">
            
           <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <ul class= "navbar-nav">
                <li class= "nav-item">
                    <a href="" class= "nav-link"> Welcome Guest</a>
                </li>
            </ul>
          </nav>
           </div>
        </nav>
      <!--Second child -->
      <div class="bg-dark">
        <h3 class="text-center text-light   p-2">Manage Details</h3>
      </div>
      <!-- Third Child -->
      <div class="row">
        <div class="col-md-12 bg-light d-flex align-items-center">
            <div class= "p-5 ">
                <a href="#"><img src="images/schema.jpg" alt="" class= "admin-image"></a>
                <p class="text-light text-center">Admin Name</p>
            </div>
            <div class="button text-center">
                <button class= "btn btn-danger m-4 p-3 " id="btnAdmin"><a href="insert_product.php" class="nav-link text-light ">Insert Products</a></button>
                <button class= "btn btn-danger m-4 p-3 "><a href="index.php?view_products" class="nav-link text-light  ">View Products</a> </button>
                <button class= "btn btn-danger m-4 p-3"><a href="index.php?insert_category" class="nav-link text-light  ">Insert Categories</a></button>
                <button class= "btn btn-danger m-4 p-3"><a href="index.php?view_categories" class="nav-link text-light ">View Categories</a></button>
                <button class= "btn btn-danger m-4 p-3"><a href="index.php?insert_brand" class="nav-link text-light  ">Insert Brands</a></button>
                <button class= "btn btn-danger m-4 p-3"><a href="index.php?view_brands" class="nav-link text-light  ">View Brands</a></button>
                <button class= "btn btn-danger m-4 p-3"><a href="index.php?list_orders" class="nav-link text-light  ">All Orders</a></button>
                <button class= "btn btn-danger m-4 p-3"><a href="index.php?list_payments" class="nav-link text-light  ">All payments</a></button>
                <button class= "btn btn-danger m-4 p-3"><a href="index.php?list_users" class="nav-link text-light  ">List users</a></button>
                <button class= "btn btn-danger m-4 p-3"><a href="index.php?viewMessages" class="nav-link text-light  ">View Messages</a></button>
                <button class= "btn btn-danger m-4 p-3"><a href="../index.php" class="nav-link text-light  ">Logout</a></button>
            </div>
        </div>
      </div>
      <!--Fourth child -->
      <div class="container my-3">
        <?php
        if(isset($_GET['insert_category'])){
            include ('insert_categories.php');
        }

        if(isset($_GET['insert_brand'])){
            include ('insert_brands.php');
        }
        if(isset($_GET['view_products'])){
          include('view_products.php');
         }
         if(isset($_GET['edit_products'])){
          include('edit_products.php');
      }
      if(isset($_GET['delete_product'])){
        include('delete_products.php');
    }
    if(isset($_GET['view_categories'])){
      include('view_categories.php');
  }
  if(isset($_GET['view_brands'])){
    include('view_brands.php');
}
if(isset($_GET['edit_category'])){
  include('edit_category.php');
}
if(isset($_GET['edit_brands'])){
  include('edit_brands.php');
}
if(isset($_GET['delete_category'])){
  include('delete_category.php');
}
if(isset($_GET['delete_brands'])){
  include('delete_brands.php');
}
if(isset($_GET['list_orders'])){
  include('list_orders.php');
}
if(isset($_GET['list_payments'])){
  include('list_payments.php');
}
if(isset($_GET['list_users'])){
  include('list_users.php');
}
if(isset($_GET['viewMessages'])){
  include('viewMessages.php');
}
        ?>
      </div>

    
    </div>
   

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
 crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" 
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
 crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
 integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
 crossorigin="anonymous"></script>

 
 <footer>
     <!-- footer -->
      <div class= "bg-danger p-3 text-center footer">
      <p text-light>All rights reserved @-Designed by Ahmad hijazi and Marwa Tlais-2023</p>
    </div>
 </footer>
</body>

</html>