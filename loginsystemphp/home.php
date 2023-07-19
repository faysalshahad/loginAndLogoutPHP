<?php
# including the connectphp.php file inside this user.php file
include "connectphp.php";

session_start();

$SID = $_SESSION['ID'];
$SName = $_SESSION['username'];

if (isset($SID) && isset($SName)) {
    # code...



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>

     <!--Bootsrap CSS Link-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body style="background:#F2EE9D">

<div class="container my-5 d-flex align-items-center justify-content-center">

    <div class="card">

        <div class="card-header">
            <h1 class="text-center">Hello, <?php echo $SName ?></h1>
            <a href="update.php"  class="btn btn-outline-primary" style="margin-top: 1rem; margin-right: 18rem; margin-bottom: 1rem;">Update Info</a>
            <a href="logout.php"  class="btn btn-outline-dark" style="margin-top: 1rem;  margin-bottom: 1rem;">Logout</a>
        </div>

        <div class="card-header text-center">
            <h5 class="text-center">Delete this Account! This Process cannot be revereserd.</h5>
          <a href="delete.php"  class="btn btn-outline-danger" style="margin-top: 1rem;">Delete My Account</a>
        </div>
</div>
</div>
    
</body>
</html>

<?php

} else {
    # code...

    header("Location: index.php");
        exit();
}

?>