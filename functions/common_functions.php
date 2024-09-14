<?php

//including connect file
// include('database/DbConnect.php');

//getting products
function getProducts()
{
    global $con; //kermal $con temshi honek
    
    // condition to check isset or not
    if(!isset($_GET['category']))
    {
        if(!isset($_GET['brand']))
        {
            
        $select_query= "Select * from `product` order by rand() limit 0,9";
        $res_q= mysqli_query($con,$select_query);
        while($row= mysqli_fetch_assoc($res_q))
        { 
         $product_id= $row['prod_id'];
         $product_title= $row['prod_title'];
         $product_des= $row['prod_description'];
         $product_Key= $row['product_keywords'];
         $product_cat_id= $row['cat_id'];
         $product_brand_id= $row['brand_id'];
         $product_img1= $row['prod_img1'];
         $product_price= $row['prod_price'];

         echo " <div class='col-md-4 mb-2'>
        <div class='card'>
        <img src='./admin_area/product_images/$product_img1' class='card-img-top' alt='$product_title'>                          <!--img 1 -->
        <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>  $product_des</p>
        <p class='card-text'>  $product_price $</p>
        <a href='index.php?add_to_cart=$product_id' class='btn btn-danger'>Add to Cart</a>
        <a href='product_details.php?product_id=$product_id' class='btn btn-dark'>view More</a>
       </div>
       </div>
        </div>";
        }
        }
    }
}


//displaying brands 
function getBrands(){
    global $con;
    $select_brands= "Select * from `brand` ";
    $result_brands= mysqli_query($con,$select_brands);

    while( $row_data= mysqli_fetch_assoc($result_brands))
    {
      $brand_title= $row_data['brand_title'];
      $brand_id= $row_data['brand_id'];
      echo " <li class='nav-item'>
          <a href='index.php?brand=$brand_id' class='nav-link text-light'><h4> $brand_title </h4></a> 
          </li> ";
     }
}


//getting unique categories 
function get_uniqueCategories()
{
    global $con; //kermal $con temshi honek
    
    // condition to check isset or not
    if(isset($_GET['category']))
    {
        $category_id= $_GET['category'];       
        $select_query= "Select * from `product` where cat_id = $category_id";
        $res_q= mysqli_query($con,$select_query);
        $num_rows= mysqli_num_rows($res_q);

        if($num_rows == 0)
        {
            echo "<h2 class= 'text-center text-danger'> No stock for this category </h2>";

        }

        else
        {
            while($row= mysqli_fetch_assoc($res_q))
            { 
                $product_id= $row['prod_id'];
             $product_title= $row['prod_title'];
             $product_des= $row['prod_description'];
             $product_Key= $row['product_keywords'];
             $product_cat_id= $row['cat_id'];
             $product_brand_id= $row['brand_id'];
             $product_img1= $row['prod_img1'];
             $product_price= $row['prod_price'];
    
             echo " <div class='col-md-4 mb-2'>
            <div class='card'>
            <img src='./admin_area/product_images/$product_img1' class='card-img-top' alt='$product_title'>                          <!--img 1 -->
            <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>  $product_des</p>
            <p class='card-text'>  $product_price $</p>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-danger'>Add to Cart</a>
       
            <a href='#' class='btn btn-dark'>view More</a>
           </div>
           </div>
            </div>";
    
    
           }
        }
       
    }
}



//getting unique brands
 
function get_uniqueBrands()
{
    global $con; //kermal $con temshi honek
    
    // condition to check isset or not
    if(isset($_GET['brand']))
    {
        $brand_id= $_GET['brand'];       
        $select_query= "Select * from `product` where brand_id = $brand_id";
        $res_q= mysqli_query($con,$select_query);
        $num_rows= mysqli_num_rows($res_q);

        if($num_rows == 0)
        {
            echo "<h2 class= 'text-center text-danger'> This brand is not available for service  </h2>";

        }
        while($row= mysqli_fetch_assoc($res_q))
        { 
            $product_id= $row['prod_id'];
         $product_title= $row['prod_title'];
         $product_des= $row['prod_description'];
         $product_Key= $row['product_keywords'];
         $product_cat_id= $row['cat_id'];
         $product_brand_id= $row['brand_id'];
         $product_img1= $row['prod_img1'];
         $product_price= $row['prod_price'];

         echo " <div class='col-md-4 mb-2'>
        <div class='card'>
        <img src='./admin_area/product_images/$product_img1' class='card-img-top' alt='$product_title'>                          <!--img 1 -->
        <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>  $product_des</p>
        <p class='card-text'>  $product_price $</p>
        <a href='index.php?add_to_cart=$product_id' class='btn btn-danger'>Add to Cart</a>
       
        <a href='#' class='btn btn-dark'>view More</a>
       </div>
       </div>
        </div>";


    }
        }
}










//displaying categories

function getCategories()
{
    global $con;
    $select_cat= "Select * from `categories` ";
    $result_cat= mysqli_query($con,$select_cat);
    while( $row_data_cat= mysqli_fetch_assoc($result_cat))
   {
     $cat_title= $row_data_cat['cat_title'];
     $cat_id= $row_data_cat['cat_id'];
     echo " <li class='nav-item'>
     <a href='index.php?category=$cat_id' class='nav-link text-light'><h4> $cat_title </h4></a> 
     </li> ";
   }
}

// searching product functions
function Search_products()
{
    global $con; //kermal $con temshi honek
    
    // condition to check isset or not
    if(isset($_GET['search_data_product'])){
        
        $value= $_GET['search_data'];
        $select_query= "Select * from `product` where product_keywords like '%$value%'"; // % % to increase the displayed data

        $res_q= mysqli_query($con,$select_query);
        $num_rows= mysqli_num_rows($res_q);

        if($num_rows == 0)
        {
            echo "<h2 class= 'text-center text-danger'> No item found, try another category! </h2>";

        }
        while($row= mysqli_fetch_assoc($res_q))
        { 
            $product_id= $row['prod_id'];
         $product_title= $row['prod_title'];
         $product_des= $row['prod_description'];
         $product_Key= $row['product_keywords'];
         $product_cat_id= $row['cat_id'];
         $product_brand_id= $row['brand_id'];
         $product_img1= $row['prod_img1'];
         $product_price= $row['prod_price'];

         echo " <div class='col-md-4 mb-2'>
        <div class='card'>
        <img src='./admin_area/product_images/$product_img1' class='card-img-top' alt='$product_title'>                          <!--img 1 -->
        <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>  $product_des</p>
        <p class='card-text'>  $product_price $</p>
       
        <a href='index.php?add_to_cart=$product_id' class='btn btn-danger'>Add to Cart</a>
        <a href='#' class='btn btn-dark'>view More</a>
       </div>
       </div>
        </div>";
        }
 }
}



function displayAllProducts()
{
 
    global $con; //kermal $con temshi honek
    
    // condition to check isset or not
    if(!isset($_GET['category']))
    {
        if(!isset($_GET['brand']))  
        {
            
        $select_query= "Select * from `product` order by rand()";
        $res_q= mysqli_query($con,$select_query);
        while($row= mysqli_fetch_assoc($res_q))
        { 
            $product_id= $row['prod_id'];
         $product_title= $row['prod_title'];
         $product_des= $row['prod_description'];
         $product_Key= $row['product_keywords'];
         $product_cat_id= $row['cat_id'];
         $product_brand_id= $row['brand_id'];
         $product_img1= $row['prod_img1'];
         $product_price= $row['prod_price'];

         echo " <div class='col-md-4 mb-2'>
        <div class='card'>
        <img src='./admin_area/product_images/$product_img1' class='card-img-top' alt='$product_title'>                          <!--img 1 -->
        <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>  $product_des</p>
        <p class='card-text'>  $product_price $</p>
       
        <a href='index.php?add_to_cart=$product_id 'class='btn btn-danger'>Add to Cart</a>
        <a href='#' class='btn btn-dark'>view More</a>
       </div>
       </div>
        </div>";
        }
        }
    }   
}


// view details functions

//getting products
function viewDetails()
{
    global $con; //kermal $con temshi honek
    
    // condition to check isset or not
    if(!isset($_GET['prod_id']))
    {
        if(!isset($_GET['category']))
        {
            if(!isset($_GET['brand']))
            {
            $product_id= $_GET['product_id'];
                
            $select_query= "Select * from `product` where prod_id= '$product_id'";
            $res_q= mysqli_query($con,$select_query);
            while($row= mysqli_fetch_assoc($res_q))
            { 
             $product_id= $row['prod_id'];
             $product_title= $row['prod_title'];
             $product_des= $row['prod_description'];
             $product_Key= $row['product_keywords'];
             $product_cat_id= $row['cat_id'];
             $product_brand_id= $row['brand_id'];
             $product_img1= $row['prod_img1'];
             $product_img2= $row['prod_img2'];
             $product_img3= $row['prod_img3'];
             $product_price= $row['prod_price'];
    
             echo " <div class='col-md-4 mb-2'>
            <div class='card'>
            <img src='./admin_area/product_images/$product_img1' class='card-img-top' alt='$product_title'>                          
            <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>  $product_des</p>
            <p class='card-text'>  $product_price $</p>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-danger'>Add to Cart</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-dark'>view More</a>
           </div>
           </div>
            </div>
            <div class='col-md-8'>
               <!--related images -->
            <div class='row'>
                <div class='col-md-12'>
                    <h4 class='text-center text-dark'>Related Products</h4>
                </div>
                <div class='col-md-6'>
                <img src='./admin_area/product_images/$product_img2' class='card-img-top' alt='$product_title'>                          <!--img 2-->
            
                </div>
    
                <div class='col-md-6'>
                <img src='./admin_area/product_images/$product_img2' class='card-img-top' alt='$product_title'>                          <!--img 3 -->
                    
                </div>
            </div>
          </div>";
            }
            }
        }   
    }
}



//get ip address function from google javatpoint.com

function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  



//cart function 
function cart()
{
    if(isset($_GET['add_to_cart']))
    {
        global $con;
        $ip= getIPAddress();
        $get_product_id= $_GET['add_to_cart'];
        $select_query= "Select * from `cart_details` where ip_address= '$ip' and prod_id= $get_product_id";
        $res_q= mysqli_query($con, $select_query);
        $num_rows= mysqli_num_rows($res_q);
        if($num_rows> 0)
        {
            echo "<script>alert(' Item already present! ') </script>";
            echo "<script> window.open('index.php') </script>"; // when i click ok on alert ha erja3 3al index.php

        }else
        {
            $ins_query= "insert into `cart_details` (prod_id, ip_address, quantity) values ($get_product_id,'$ip',0 )";
            $res= mysqli_query($con, $ins_query);
            echo "<script>alert(' Item Added to Cart! ') </script>";
            echo "<script> window.open('index.php') </script>";

        }

    }
}


//get the cart numbers

function cart_num_Items()
{
     if(isset($_GET['add_to_cart']))
    {
        global $con;
        $ip= getIPAddress();
      
        $select_query= "Select * from `cart_details` where ip_address= '$ip' ";
        $res_q= mysqli_query($con, $select_query);
        $cart_items= mysqli_num_rows($res_q);
    }else    
    {
        global $con;
        $ip= getIPAddress();
        $select_query= "Select * from `cart_details` where ip_address= '$ip' ";
        $res_q= mysqli_query($con, $select_query);
        $cart_items= mysqli_num_rows($res_q);
    }
    echo $cart_items;
}

function total_price()
{
    global $con;
    $total_price =0;
    $get_ip= getIPAddress();
    $query= "Select * from `cart_details` where ip_address='$get_ip'";
    $res= mysqli_query($con,$query);
    while($row= mysqli_fetch_array($res))
    {
        $prod_id= $row['prod_id'];
        $select_prod= "select * from `product` where prod_id= '$prod_id'";
        $res_products= mysqli_query($con,$select_prod);

        while($row_products = mysqli_fetch_array($res_products)){
            $prod_price= array($row_products['prod_price']);
            $prod_values= array_sum($prod_price);
            $total_price += $prod_values;
        }
    }
    echo $total_price;
}

// get the order details
function getU_order_details()
{
    echo"ajhdsd";
    global $con;
    $username= $_SESSION['username'];
    $query_get_details= "select * from `user_table` where user_name='$username'";
    $res_getDet=mysqli_query($con,$query_get_details);
    while($row=mysqli_fetch_array($res_getDet)) 
    {
        $user_id=$row['user_id'];
        if(!isset($_GET['edit_account']))
        {
            if(!isset($_GET['my_orders']))
            {
                if(!isset($_GET['delete_account'])) // if all the 3 options are not clicked 
                {
                    $query_get_orders="select * from `user_orders` where user_id= $user_id and order_status='pending'";
                    $res_orders_query=mysqli_query($con,$query_get_orders);
                    $row_count=mysqli_num_rows($res_orders_query);
                    if($row_count>0)
                    {
                        echo "<h3 class='text-center text-dark mt-5 mb-2' >you have <span class='text-danger'>$row_count </span>pending orders </h3> 
                        <button type='button' class='btn btn-outline-danger bg-danger'><a href='../index.php' style='text-decoration:none' class='text-light'>Order details</a></button>";
                 
                    }
                    else
                    {
                        echo "<h3 class='text-center text-dark mt-5 mb-2' >you have <span class='text-danger'>0</span>pending orders </h3> 
                        <button type='button' class='btn btn-outline-danger bg-danger'><a href='../index.php' style='text-decoration:none' class='text-light'>Explore products</a></button>";
                 
                    }
                }
            }
        }
    }

}

?>

