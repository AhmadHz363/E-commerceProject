<?php
include('../database/DbConnect.php');   

if(isset($_POST['insert_categories']))
{
    $category_title= $_POST['cat_title'];
    //select data from data base
    $select_query= "Select * from `categories` where cat_title= '$category_title'";
    $result_select= mysqli_query($con,$select_query);
    $number= mysqli_num_rows($result_select);

    if($number>0)
    {
        echo "<script>alert('This category is created before try another ')</script>";
    }
    else
    {
        $insert_query= "insert into `categories` (cat_title) values ('$category_title')";
        $result= mysqli_query($con,$insert_query);
        if($result)
        { 
            echo "<script>alert('Category inserted succesfully')</script>";
        }
    }
   
}
?>

<h2 class="text-center">Insert Categories</h2>
<form action="" method="post" class= "mb-3">
<div class="input-group w-90 mb-3">
  <span class="input-group-text" id="basic-addon1">
    <i class="fa-solid fa-receip">   </i>
  </span>

  <input type="text" class="form-control" placeholder="Insert Categories"  name= "cat_title" aria-label="Categories">
</div>
<div class="input-group w-10 m-auto">
  <input type="submit" class=" bg-danger border-0 p-2 my-3" name= "insert_categories" >

</div>
</form>