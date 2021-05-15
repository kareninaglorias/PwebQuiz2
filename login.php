<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>
  </head>
  <body>
    <?php
    if(isset($_POST['login'])){
  
      session_start();
      include('conn.php');
  
      $username=$_POST['username'];
      $password=$_POST['password'];
  
      $query=mysqli_query($conn,"select * from `datapengguna` where username='$username' && password='$password'");
  
      if (mysqli_num_rows($query) == 0){
        $_SESSION['message']="Login Failed. User not Found!";
        header('location:index.php');
      }
      else{
        $row=mysqli_fetch_array($query);
  
        if (isset($_POST['remember'])){
          //set up cookie
          setcookie("user", $row['username'], time() + (86400 * 30)); 
          setcookie("pass", $row['password'], time() + (86400 * 30)); 
        }
  
        $_SESSION['id']=$row['userid'];
        header('location:success.php');
      }
    }
    else{
      header('location:index.php');
      $_SESSION['message']="Please Login!";
    }
    ?>
  </body>
</html>