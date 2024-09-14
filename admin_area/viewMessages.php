<?php
include('../database/DbConnect.php');

$query = "select * from `Contact`";
$res = mysqli_query($con, $query);

echo "<div class='d-flex'>";

while ($row = mysqli_fetch_array($res)) {
    echo "<div class='card m-4' style='width: 18rem;'>
        <div class='card-body'> 
            <h5 class='card-title'>from " . $row['Username'] . "</h5>
            <p class='card-text'>".$row['user_message']."</p>
            <a href='https://mail.google.com/mail/u/0/' class='btn btn-danger'>reply</a>
        </div>
    </div>";
}

echo "</div>";

?>
