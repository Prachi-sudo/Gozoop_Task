<?php 
session_start();
  include("database/config.php");
?>

<html>
<head>
  <title></title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <img src="images/gozoop.svg" id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form action="" method="post">
        <input type="text" id="username" class="fadeIn second" name="username" placeholder="username">
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="password" >
        <input type="submit" name="submit" id="login" class="fadeIn fourth" value="Log In">
      </form>

      <!-- Remind Passowrd -->
      <!-- <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div> -->

    </div>
  </div>
</body>
<?php
  if(isset($_POST['submit'])){
    $usr = $_POST['username'];
    $pwd = $_POST['password'];

    $query = "SELECT * FROM gozoop_users WHERE username = '$usr' AND password = '$pwd'";
    $data = mysqli_query($db, $query);

    $total = mysqli_num_rows($data);
    // echo $total;
    if($total == 1){
      $_SESSION['username'] = $usr;
      header('location: home.php');
    }else{
      echo "Login Failed";
    }
  }
?>
</html>

