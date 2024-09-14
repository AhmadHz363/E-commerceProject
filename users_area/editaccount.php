<?php
if(isset ($_GET['edit_account'])){
    $user_session_name=$_SESSION['username'];
    $select_query="Select * from `user_table` where user_name= '$user_session_name'";
    $result_query=mysqli_query($con, $select_query);
    $row_fetch=mysqli_fetch_assoc($result_query);
    $user_id=$row_fetch['user_id'];
    $username=$row_fetch['user_name'];
    $user_email=$row_fetch['user_email'];
    $user_address=$row_fetch['user_address'];
    $user_mobile=$row_fetch['user_mobile'];
}
if(isset($_POST['user_update'])){
$update_id=$user_id;
$username=$_POST[ 'user_username'];
$user_email=$_POST['user_email'];
$user_address=$_POST['user_address'];
$user_mobile=$_POST['user_mobile'];


// update query
$update_data="update `user_table` set user_name='$username', user_email='$user_email',
user_address='$user_address', user_mobile='$user_mobile' where user_id=$update_id";

$result_query_update=mysqli_query($con,$update_data);
if($result_query_update){
echo "<script>alert ('Data updated successfully')</script>";
}
}
?>

<!--EDIT USER ACCOUNT -->
<!-- BEL USER AREA--CREATE FILE NAME AS EDIT <ACCOUNT class="PHP-->
<DOCTYPE html>
 <html lang="en">
<head> <meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit account</title>
</head> 
<body>
<h3 class="text-center text-danger mb-4">Edit Account</h3> 
<form action="" method="post" enctype="multipart/form-data " class="text-center">
<div class="form-outline mb-4">
<input type="text" class="form-control w-50 m-auto" value="<?php echo $username ?>"
name='user_username'>
</div>
<div class="form-outline mb-4">
<input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email ?>"
name='user_email'>
</div>

<div class="form-outline mb-4">
<input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address ?>"
name='user_address'>
</div>
<div class="form-outline mb-4">
<input type="text" class="form-control w-50 m-auto" value="<?php echo $user_mobile ?>"
name='user_mobile'>
</div>
<input type="submit" value="update" class="bg-danger py-2 px-3 border-0 "
name='user_update'>
</form>
 </body> 
 </html>
