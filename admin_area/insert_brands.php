<?php
include('../database/DbConnect.php');   

if(isset($_POST['insert_brands']))
{
    $brand_title= $_POST['brand_title'];
    //select data from data base
    $select_query= "Select * from `brand` where brand_title= '$brand_title'";
    $result_select= mysqli_query($con,$select_query);
    $number= mysqli_num_rows($result_select);

    if($number>0)
    {
        echo "<script>alert('This brand is created before try another ')</script>";
    }
    else
    {
        $insert_query= "insert into `brand` (brand_title) values ('$brand_title')";
        $result= mysqli_query($con,$insert_query);
        if($result)
        {
            echo "<script>alert('Brand inserted succesfully')</script>";
        }
    }
   
}
?>
<h2 class="text-center">Insert Brands</h2>

<form action="" method="post" class= "mb-3">
<div class="input-group w-90 mb-3">
  <span class="input-group-text" id="basic-addon1">
    <i class="fa-solid fa-receip">   </i>
  </span>

  <input type="text" class="form-control" placeholder="Insert brands"  name= "brand_title" aria-label="brands">
</div>
<div class="input-group w-10 m-auto">
  <input type="submit" class=" bg-danger border-0 p-2 my-3" name= "insert_brands" >

</div>
</form>