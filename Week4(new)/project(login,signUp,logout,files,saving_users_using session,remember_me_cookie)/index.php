<?php 
session_start();
if(!empty($_COOKIE["user"])){
  
  $_SESSION["user_data"] = json_decode($_COOKIE["user"], true); 

  header("location:home.php");
}
?>

<html>

<head>
  <title>mySmartLoginIndex</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="css/index_style.css" />

  <meta name="viewport" content="width=device=width,initial-scale=1.0">

</head>

<body class=" d-flex justify-content-center align-items-center">


  <section id="loginBox" class="container w-75 my-5 py-5 text-center ">
    <div class="px-5">
        <!-- check if there is error msg and print it  then refresh page to remove error_msg-->

        <!-- check on empty_error_msg -->
        <?php 
          if(!empty($_GET["error"])){
            header("refresh:2; url=index.php");
        ?>
         <div id="alertIncorrect" class="alert text-dark bg-danger">
              <strong>
        <?php 
          switch($_GET["error"]){
            case "empty_email_or_password":
              echo "empty Email or Password";
              break;
            case "incorrect_email_or_password":
              echo "Incorrect Email or Password";
              break;
            case "invalid_email_format":
              echo "invalid email format";
              break;
            case "secure_page":
              echo "Please Login First";
              break;
            
          }
        ?>
            </strong>
          </div>
        <?php
          }
        ?>
      <h1 class="mb-4">Smart Login System</h1>
      <form action="login.php" method="POST">

        <input id="email" type="text" name="email" class="inputBox form-control mb-3" placeholder="Enter your email">

        <input id="password" type="password" name="pw" class="inputBox form-control mb-3" placeholder="Enter your password">

        <button id="loginBtn" type="submit" class="btn border border-info form-control my-3 ">Login</button>
        
        <label >Remember Me</label>
        <input  type="checkbox" value="1" name = "remember">
       

      </form>
      <p id="makeAccount" class="">Don't have an account? <a id="signUpLink" class="text-white " href="signUp.php">Sign Up</a></p>
    </div>
  </section>

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>


</body>

</html>