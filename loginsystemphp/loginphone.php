<?php

# including the connectphp.php file inside this user.php file
include "connectphp.php";

session_start();

if (isset($_POST['loginButton'])) {
    # code...

    #$getusername = $_POST['usernameinput'];
    # $getemail = $_POST['useremailinput'];
     $getphone = $_POST['userphoneinput'];    
    $getpassword = $_POST['userpasswordinput'];

       // The hash of the password that will be checked against password 
       #stored in database
  #$getpasswordhash = password_hash($getpassword, PASSWORD_DEFAULT);

    // function validate($varData){
    //     $varData = trim($varData);
    //     $varData = striplashes($varData);
    //     $varData = htmlspecialchars($varData);
    //     return $varData;

    // };

    // $getusername = validate($getusername);
    // $getpassword = validate($getpassword);

    $sqlInvestigateQuery = "select * from regusertable where phone='$getphone'";

    $resultInvestigateQuery = mysqli_query($connectphp, $sqlInvestigateQuery);

    if (mysqli_num_rows($resultInvestigateQuery) === 1) {
        # code...
        $rowTable = mysqli_fetch_assoc($resultInvestigateQuery);

        $phonedb = $rowTable['phone'];
        $passworddb = $rowTable['password'];

        // Verify the hash against the password entered
  $verify = password_verify($getpassword, $rowTable['password']);

        if ($phonedb === $getphone && $verify) {
            # code...
            echo '<script>alert("Successfully Logged in")</script>';
            $_SESSION ['username'] = $rowTable['username'];
            $_SESSION ['ID'] = $rowTable['ID'];
            header("Location: home.php");
            exit();
        } else {
            # code...
           # echo '<script>alert("Sorry, unsuccessful attempt as the credentials are not matching.")</script>';
            header("Location: index.php?error=Sorry, unsuccessful attempt as the credentials are not matching.");
            exit();
    } 
    } else {
        # code...
        header("Location: index.php");
        exit();
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

    <!--Bootsrap CSS Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="css/style.css"> -->

</head>
<body style="background:#F2EE9D">

<div class="container my-5 d-flex align-items-center justify-content-center">

    <div class="card">

        <div class="card-header">
            <h3 class="text-center">Login via Mobile Number</h3>
        </div>

        <div class="card-body">

        <form action="" method="post">
         
    <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Mobile:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="userphoneinput" placeholder="Enter Your Mobile Number" required>
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Password:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="userpasswordinput" placeholder="Enter Your Password" required>
    </div>
  </div>
  
            <button type="submit" class="btn btn-outline-success btn-lg"  style="margin-top: .5rem; margin-right: 25rem;" name="loginButton">Login</button>
            <a href="index.php"  class="btn btn-outline-danger btn-lg" style="margin-top: .5rem; ">Cancel</a>

        </div>

        <div class="card-footer text-center">
            <p>Forgotten the Mobile Number? Then try different login option<br></p>
            <a href="login.php"  class="btn btn-outline-primary" style="margin-top: .1rem;">Login by Username</a>
            <a href="loginemail.php"  class="btn btn-outline-dark" style="margin-top: .1rem;">Login by Email</a>
             
        </div>

        <div class="card-footer text-center">
            <p>If you are not a registered user then register first!<br></p>
            <a href="index.php"  class="btn btn-outline-warning" style="margin-top: .1rem;">Register</a>
             
        </div>

        </form>

    </div>
</div>

</body>
</html>