<?php
include('../database/DbConnect.php');   
if(isset($_POST['insert_products']))
{
 $product_title= $_POST['product_title']; 
 $description= $_POST['description'];  
 $product_keyword= $_POST['product_keyword'];  
 $product_categories= $_POST['product_categories'];    
 $product_brands= $_POST['product_brands'];  
$product_price= $_POST['product_price'];

//accessing images
$product_image1= $_FILES['product_image1']['name'];  
$product_image2= $_FILES['product_image2']['name'];  
$product_image3= $_FILES['product_image3']['name'];

//accessing image temp name
$temp_image1= $_FILES['product_image1']['tmp_name'];  
$temp_image2= $_FILES['product_image2']['tmp_name'];  
$temp_image3= $_FILES['product_image3']['tmp_name'];

//checking empty conditions

if($product_title== '' or $description==''  or $product_keyword=='' or $product_brands =='' or $product_categories == '' or $product_price== '' or $product_image1=='' or $product_image2 == ''  or  $product_image3 == '')
{
    echo " <script> alert('Please fill all the available fields') </script>";
    exit();
}
else
{
    //move the uploaded images to a folder
    move_uploaded_file($temp_image1, "./product_images/$product_image1");
    move_uploaded_file($temp_image2, "./product_images/$product_image2");
    move_uploaded_file($temp_image3, "./product_images/$product_image3");

    //insert query
    $insert_products= "insert into `product`(prod_title, prod_description,product_keywords, cat_id, brand_id ,prod_img1,prod_img2,prod_img3,prod_price)
                       values('$product_title', ' $description' , '$product_keyword', ' $product_categories', 
                       '$product_brands', '$product_image1', '$product_image2', '$product_image3' , '$product_price')";

    $res_ins= mysqli_query($con,$insert_products);
    if($res_ins)
    {
        echo "<script> alert('Successfully inserted the products')</script>";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashbord</title>   
    <style>
        *{
            color: white;
        }

        option{
            color: black;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<!--bootstrap link -->  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- Css link --> 
<link rel="stylesheet" href="../style.css">
<!-- font awesom link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />  

</head>
<body class= "bg-dark">
    <div class="container ">
        <h1 class="text-center"> Insert Products</h1>
        <!--Form  -->
        <form action="" method="post" enctype= "multipart/form-data"> <!--to be able to insert images --> 
           <div class="form-outline mb-4 w-50 m-auto">
             <label for="product_title" class="form-lable">Product title</label>
             <input type="text" name= "product_title" id="product_title" class= "form-control" placeholder= "Enter product title" autocomplete= "off" required= "required">
           </div>

           <!-- Description -->
           <div class="form-outline mb-4 w-50 m-auto">
             <label for="description" class="form-lable">Product Description</label>
             <input type="text" name= "description" id="description" class= "form-control" placeholder= "Enter product description" autocomplete= "off" required= "required">
           </div>

             <!-- KeyWords -->
             <div class="form-outline mb-4 w-50 m-auto">
             <label for="product_keywords" class="form-lable">Product KeyWords</label>
             <input type="text" name= "product_keyword" id="product_keyword" class= "form-control" placeholder= "Enter product Key Words" autocomplete= "off" required= "required">
             </div>

            <!-- Categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_categories" id="" class="form-select">

                    <option value="" class= "">Select a Category</option>
                   
                    <?php
                    $select_query= "Select * from `categories`";
                    $result_query= mysqli_query($con,$select_query);
                    while($row= mysqli_fetch_assoc($result_query))
                    {
                        $category_title= $row['cat_title'];
                        $category_id= $row['cat_id'];
                        echo " <option value='  $category_id'>$category_title</option>";
                    }
                    ?>
                 
                </select>
            </div>

            
            <!-- Brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brands" id="" class="form-select">
                    <option value="">Select a brand</option>
                    <?php
                    $select_query2= "Select * from `brand`";
                    $result_query2= mysqli_query($con,$select_query2);
                    while($row= mysqli_fetch_assoc($result_query2))
                    {
                        $brand_title= $row['brand_title'];
                        $brand_id= $row['brand_id'];
                        echo " <option value='  $brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!--Img 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
             <label for="product_iamge1" class="form-lable">Product image 1</label>
             <input type="file" name= "product_image1" id="product_image1" class= "form-control"  required= "required">
             </div>

              <!--Img 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
             <label for="product_iamge2" class="form-lable">Product image 2</label>
             <input type="file" name= "product_image2" id="product_image2" class= "form-control"  required= "required">
             </div>

               <!--Img 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
             <label for="product_iamge3" class="form-lable">Product image 3</label>
             <input type="file" name= "product_image3" id="product_image3" class= "form-control"  required= "required">
             </div>

            <!--Price -->
             <div class="form-outline mb-4 w-50 m-auto">
             <label for="product_price" class="form-lable">Product Price</label>
             <input type="text" name= "product_price" id="product_price" class= "form-control" placeholder= "Enter product price" autocomplete= "off" required= "required">
             </div>

             <!--Price button-->
             <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name= "insert_products"  class="btn btn-danger mb-3 px-3" value= "Insert Products">
        </form>
    </div>
    
 
</body>
</html>