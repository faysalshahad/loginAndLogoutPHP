
<?php

# including the connectphp.php file inside this user.php file
include "connectphp.php";

session_start();

$SID = $_SESSION['ID'];
$SName = $_SESSION['username'];

#$idtoupdate = $_GET['updateID'];

$sqldisplayinfo = "select * from regusertable where ID = $SID";
$resultdisplay = mysqli_query($connectphp,$sqldisplayinfo);
$rowtable = mysqli_fetch_assoc($resultdisplay);


#useremail is the column name is sql database
$emaildisplay = $rowtable ['email'];
#userphone is the column name is sql database
$phonedisplay = $rowtable ['phone'];
#username is the column name is sql database
$usernamedisplay = $rowtable ['username'];
#userpassword is the column name is sql database
#$passworddisplay = $rowtable ['password'];


if (isset($_POST['updateButton'])) {
    # code.. creating variables to capture user input.
    $getusername = $_POST['usernameinput'];
    $getemail = $_POST['useremailinput'];
    $getphone = $_POST['userphoneinput'];    
    $getpassword = $_POST['userpasswordinput'];
    $getconfirmpassword = $_POST['confirmuserpasswordinput'];

    # checking the passwords whether they are matching with each other or not.
    if  ($getpassword === $getconfirmpassword ) {
    # sql query to insert the user input inside the database in table named crudtable

       // The hash of the password that
  // can be stored in the database
  $getpasswordhash = password_hash($getpassword, PASSWORD_DEFAULT);

    $sqlupdateinfo = "update regusertable set ID = $SID,
    username = '$getusername', email = '$getemail', phone = $getphone, 
    password = '$getpasswordhash'
    where ID = $SID";

    # $connectphp is the variable which has been created inside the coonect.php file
    # this mysqli_query takes two arguments. first one is $con to connect to the database
    #second one is the $sqlinsertdataintotable query variable to insert the data from the database. 
    $resulttoupdate = mysqli_query($connectphp, $sqlupdateinfo);

    
        if ($resulttoupdate) {
                        
        # code...
        #echo '<script>alert("Data has been updated successfully")</script>';
        header("Location: login.php");
        exit();
    } else {
            # code...
        echo ("There is an error to connect to the database. 
        Please check your internet, connection or codes.");
        die(mysqli_error());

           
        }

    } else {
         # code...
         echo '<script>alert("Please Fill out the form again carefully as the passwords did not match with each other.")</script>';
        
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
<!-- 
    <link rel="stylesheet" href="css/style.css"> -->

</head>
<body style="background:#F2EE9D">

<div class="container my-5 d-flex align-items-center justify-content-center">

    <div class="card">

        <div class="card-header">
            <h3 class="text-center">After Updating your Informtation</h3>
            <h5 class="text-center">You will be required to Login Again</h5>
        </div>

        <div class="card-body">

            <form action="" method="post">

            <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Email:</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="useremailinput" value=<?php echo $emaildisplay; ?> required>
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Phone:</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="userphoneinput" min="0" minlength="5" value=<?php echo $phonedisplay; ?> required>
    </div>
  </div>

    <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="usernameinput" value=<?php echo $usernamedisplay; ?> required>
    </div>
  </div>


  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Password:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="userpasswordinput" placeholder="Enter the Password" required>
    </div>
  </div>


  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Confirm Password:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="confirmuserpasswordinput" placeholder="Confirm Your Password" required>
    </div>
  </div>
            
            <button type="submit" class="btn btn-outline-success btn-lg"  style="margin-top: .1rem; margin-right: 15rem;" name="updateButton">Update info</button>
            <a href="home.php"  class="btn btn-outline-danger btn-lg" style="margin-top: .1rem; ">Cancel</a>
            <a href="logout.php"  class="btn btn-outline-dark btn-lg" style="margin-top: .1rem;">Logout</a>

        </div>

        <div class="card-header text-center">
            <h5 class="text-center">Delete this Account! This Process cannot be revereserd.</h5>
          <a href="delete.php"  class="btn btn-outline-danger" style="margin-top: .1rem;">Delete My Account</a>
        </div>

        <!-- <div class="card-footer text-center">
            <p>If you already a registered user then Login instead by using any one of options below!</p>
            <a href="login.php"  class="btn btn-outline-primary" style="margin-top: .1rem;">Login by Username</a>
            <a href="loginemail.php"  class="btn btn-outline-dark" style="margin-top: .1rem;">Login by Email</a>
            <a href="loginphone.php"  class="btn btn-outline-warning" style="margin-top: .1rem;">Login by Mobile No</a>
             
        </div> -->

        </form>

    </div>
</div>

</body>
</html>