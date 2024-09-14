<?php
if(isset($_GET['edit_products']))
{
    $edit_Id= $_GET['edit_products'];
    $data= "Select * from `product` where prod_id= $edit_Id";
    $res= mysqli_query($con,$data);
    $row= mysqli_fetch_assoc($res);
    $title= $row['prod_title'];
    $description= $row['prod_description'];
    $keyWord= $row['product_keywords'];
    $catid= $row['cat_id'];
    $brandid= $row['brand_id'];
    $img1= $row['prod_img1'];
    $img2= $row['prod_img2'];
    $img3= $row['prod_img3'];
    $price=$row['prod_price'];

    //get cat id
    $get_cat="select * from `categories` where cat_id= $catid";
    $resCat=mysqli_query($con,$get_cat);
    $row_cat= mysqli_fetch_assoc($resCat);
    $cat_title= $row_cat['cat_title'];
    

    //get brand
    $get_brand="select * from `brand` where brand_id= $brandid";
    $resbrand=mysqli_query($con,$get_brand);
    $row_brand= mysqli_fetch_assoc($resbrand);
    $brand_title= $row_brand['brand_title'];
 
}
?>
<style>
    .product_img{
        width:100px;
        object-fit:contain;
    }
</style>
<div class="container mt-5">
<h1 class="text-center text-danger">Edit Product</h1>
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-outline w-50 m-auto mb-4">
     <label for="product_title" class="form-label">Product Title</label>
     <input type="text" id="product_title" name="product_title"  value="<?php echo $title;?>" class="form-control" required="required">
  </div>

  <div class="form-outline w-50 m-auto mb-4">
     <label for="product_desc" class="form-label">Product Description</label>
     <input type="text" id="product_desc" name="product_desc"  value="<?php echo $description;?>" class="form-control" required="required">
  </div>
  <div class="form-outline w-50 m-auto mb-4">
     <label for="product_keywords" class="form-label">Product Keywords</label>
     <input type="text" id="product_keywords" name="product_keywords"  value="<?php echo $keyWord;?>" class="form-control" required="required">
  </div>
  <div class="form-outline w-50 m-auto mb-4">
  <label for="product_category" class="form-label">Product Categories</label>
    <select name="product_category" class="form-select">
    <option value="<?php echo $cat_title;?>"><?php echo $cat_title;?></option>
    <?php
      $get_All_cat="select * from `categories`";
      $resAllCat=mysqli_query($con,$get_All_cat);
      while( $All_cat= mysqli_fetch_assoc($resAllCat))
      {
        $Allcat_title= $All_cat['cat_title'];
        $Allcat_id= $All_cat['cat_id'];
        echo"<option value='$Allcat_id'> $Allcat_title </option>";
      }          
    ?>

    </select>
  </div>
  <div class="form-outline w-50 m-auto mb-4">
  <label for="product_brands" class="form-label">Product Brands</label>
    <select name="product_brands" class="form-select">
    <option value="<?php echo $brand_id;?>"><?php echo $brand_title; ?></option>
    <?php
      $get_All_brand="select * from `brand`";
      $resAllbrand=mysqli_query($con,$get_All_brand);
      while( $All_brand= mysqli_fetch_assoc($resAllbrand))
      {
        $Allbrand_title= $All_brand['brand_title'];
        $Allbrand_id= $All_brand['brand_id'];
        echo"<option value='$Allbrand_id'> $Allbrand_title </option>";
      }          
    ?>
    </select>
  </div>
  <div class="form-outline w-50 m-auto mb-4">
     <label for="product_image1" class="form-label">Product Image1</label>
     <div class="d-flex">
      <input type="file" id="product_image1" name="product_image1" class="form-control w-90 m-auto" required="required">
      <img src="./product_images/<?php echo $img1 ?>" alt="" class="product_img">
     </div>
  </div>
  <div class="form-outline w-50 m-auto mb-4">
     <label for="product_image2" class="form-label">Product Image2</label>
     <div class="d-flex">
      <input type="file" id="product_image2" name="product_image2" class="form-control w-90 m-auto" required="required">
      <img src="./product_images/<?php echo $img1 ?>" alt="" class="product_img">
     </div>
  </div>
  <div class="form-outline w-50 m-auto mb-4">
     <label for="product_image3" class="form-label">Product Image3</label>
     <div class="d-flex">
      <input type="file" id="product_image3" name="product_image3" class="form-control w-90 m-auto" required="required">
      <img src="./product_images/<?php echo $img1 ?>" alt="" class="product_img">
     </div>
  </div>
  <div class="form-outline w-50 m-auto mb-4">
     <label for="product_price" class="form-label">Product Price</label>
     <input type="number" id="product_price" name="product_price" value ="<?php echo $price;?>"class="form-control" required="required">
  </div>
  <div class="w-50 m-auto">
    <input type="submit" name="edit_product" value="Update Product" class="btn btn-danger px-3 mb-3">
  </div>
</form>
</div>

<!-- edit the database -->
<?php
if(isset($_POST['edit_product']))
{
    $prod_title=$_POST['product_title'];
    $prod_desc= $_POST['product_desc'];
    $prod_KW= $_POST['product_keywords'];
    $prod_cat= $_POST['product_category'];
    $prod_brand= (int) $_POST['product_brands'];
    $prod_price= $_POST['product_price'];

    //accessing images
    $product_image1= $_FILES['product_image1']['name'];  
    $product_image2= $_FILES['product_image2']['name'];  
    $product_image3= $_FILES['product_image3']['name']; 

    //accessing image temp name
    $temp_image1= $_FILES['product_image1']['tmp_name'];  
    $temp_image2= $_FILES['product_image2']['tmp_name'];  
    $temp_image3= $_FILES['product_image3']['tmp_name'];

    //check if empty
    if($prod_title == '' or $prod_desc =='' or $prod_KW= '' or $prod_cat= '' or $prod_brand= '' or $prod_price= '' 
        or     $product_image1== '' or $product_image2== '' or  $product_image3== '')
    {
        echo "<script> alert('please fill all the fields ')</script>";
    }
    else
    {
        move_uploaded_file($temp_image1,"./product_Images/$product_image1");
        move_uploaded_file($temp_image2,"./product_Images/$product_image2");
        move_uploaded_file($temp_image3,"./product_Images/$product_image3");
        // Check if $prod_brand is not empty
// if (empty($prod_brand)) {
//     echo "<script> alert('Brand is empty')</script>";
//     die('Brand is empty');
// }
        //run the updates update
        $updateProd= "UPDATE `product` SET
                    prod_title	='$prod_title',
                    prod_description ='$prod_desc',	
                    product_keywords= '$prod_KW',
                    cat_id=7,
                    brand_id= 6,
                    prod_img1= '$product_image1',
                    prod_img2='$product_image2',
                    prod_img3='$product_image3',
                    prod_price= $prod_price
                    WHERE prod_id =$edit_Id ";
                    echo $updateProd; 
       $resUpdate= mysqli_query($con,$updateProd);
       if($resUpdate)
       {
        echo"<script> alert('Product updated successfully')</script>";
        echo"<script> window.open('./insert_product.php','_self') </script>";
       }
       else{
          die('Error updating product: ' . mysqli_error($resUpdate));
       }
    }
    error_reporting(E_ALL);
ini_set('display_errors', 1);

}
?>