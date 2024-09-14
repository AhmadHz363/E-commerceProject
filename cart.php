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
    <title>E-commerce website-Cart details</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
   <!-- Css link -->

    <!--font awesom link -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
    <style>
        img{
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all_products.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-sharp fa-solid fa-cart-shopping"></i> <sup> <?php cart_num_Items();?></sup></a>
        </li>
     
      </ul>
     
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
  <a class='nav-link active'  href='./users_area/user_login.php'>Logout</a>
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

<!-- table---------------------------------------------------- -->
<div class="container">
    <div class="row">
        <form action="" method="post">
        <table class="table table-bordered">
           
            <tbody>
                <!--Php code -->
                <?php
                global $con;
                $total_price =0;
                $get_ip2= getIPAddress();
                $query= "Select * from `cart_details` where ip_address='$get_ip2'";
                $res= mysqli_query($con,$query);
                $count_prod= mysqli_num_rows($res);
                if($count_prod >0)
                {
                  echo " <thead>
                  <tr>
                      <th>Product title</th>
                      <th>Product image</th>
                      <th>Quantity</th>
                      <th>Total price</th>
                      <th>Remove</th>
                      <th colspan= '2'>Operation</th>
                  </tr>
                   </thead>";
                  while($row= mysqli_fetch_array($res))
                  {
                      $prod_id= $row['prod_id'];
                      $select_prod= "select * from `product` where prod_id= '$prod_id'";
                      $res_products= mysqli_query($con,$select_prod);
              
                      while($row_products = mysqli_fetch_array($res_products)){
                          $prod_price= array($row_products['prod_price']);
                          $price_table= $row_products['prod_price'];
                          $prod_title= $row_products['prod_title'];
                          $prod_image1= $row_products['prod_img1'];
                          $prod_values= array_sum($prod_price);
                          $total_price += $prod_values;
                }

              
               
                ?>
                 <?php
                    $get_ip= getIPAddress();
                    if(isset($_POST['update-cart']))
                    {
                        $quanti=  (INT)$_POST['quantity'];
                        $update_cart = "UPDATE `cart_details` SET quantity =$quanti WHERE ip_address='$get_ip'";
                        $res_s= mysqli_query($con,$update_cart);
                        $total_price= $total_price*$quanti;
                    }
                    ?>

               
                <tr>
                    <td><?php echo $prod_title ?></td>
                    <td><img src="admin_area/product_images/<?php echo $prod_image1 ?>" alt=""> </td>
                    <td><input type="number" name="quantity" id="" class="form-input w-50"></td>
                  
                    <td><?php echo   $total_price ?></td>
                    <td><input type="checkbox" name="removeitem[]" id="" value="<?php echo $prod_id ?>"></td>
                    <td>
             
                        <input type="submit" value="Update-cart" class="bg-danger px-3 py-2 border-0 mx-3" name="update-cart">
                   
                        <input type="submit" value="remove-cart" class="bg-danger px-3 py-2 border-0 mx-3" name="remove-cart">
                       
                    </td>
                   

                </tr>
                <?php
                    }
                }
                else
                {
                  echo "<h2 class= 'text-center text-danger ml-20'> Cart is empty</h2>";
                }
              
                ?>
            </tbody>
        </table>
        <!--total -->
        <?php
 
        $get_ip2= getIPAddress();
        $query= "Select * from `cart_details` where ip_address='$get_ip2'";
        $res= mysqli_query($con,$query);
        $count_prod= mysqli_num_rows($res);
        if($count_prod >0){
          echo" <h4 class='px-3'>total: <strong class='text-danger'> $total_price $</strong></h4>
          <input type='submit' value='Continue Shopping' class='bg-danger px-3 py-2 border-0 mx-3' name='continue'>
                      
          <button class='bg-danger px-3 py-2 border-0 mx-3'><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>";
        }
        else
        {
          echo" <input type='submit' value='Continue Shopping' class='bg-danger px-3 py-2 border-0 mx-3' name='continue'>
          ";
        }

        if(isset($_POST['continue']))
        {
          echo "<script> window.open('index.php','_self')</script>";
        }
        ?>

        
        <div class="d-flex mb-5">
           
        </div>
    </div>
</form>
<?php
//function to remove items
function remove_cart_item()
{
    global $con;
    if(isset($_POST['remove-cart']))
    {
      foreach($_POST['removeitem'] as $remove_id)
      {
        echo $remove_id;
        $delete_query="Delete from `cart_details` where prod_id =$remove_id";
        $res_d= mysqli_query($con,$delete_query);
        if($res_d)
        {
          echo "<script>window.open('cart.php','_self') </script>";
        }
      }
    }
}
echo $remove_item= remove_cart_item();
?>
</div>











</div>

<!-- footer -->
<div class= "bg-danger p-3 text-center">
  <p text-light>All rights reserved @-Designed by Ahmad-2023</p>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>

