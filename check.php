<?php
include "config.php";

if(isset($_POST['username'])){
   $username = $_POST['username'];

   $query = "select count(*) as cntUser from users where username='".$username."'";

   $result = mysqli_query($connection, $query);
   $response = "<div class=\"alert alert-success\" role=\"alert\">User Available</div>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];
    
      if($count > 0){
          $response = "<div class=\"alert alert-danger\" role=\"alert\">User not Available</div>";;
      }
   }
   echo $response;
   die;
}


if(isset($_POST['email'])){
    $email = $_POST['email'];

    $query = "select count(*) as cntEmail from users where email='".$email."'";

    $result = mysqli_query($connection, $query);
    $response = "<div class=\"alert alert-success\" role=\"alert\">Email Available</div>";
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);

        $count = $row['cntEmail'];

        if($count > 0){
            $response = "<div class=\"alert alert-success\" role=\"alert\">Email not Available</div>";
        }
    }
    echo $response;
    die;
}
