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
    
      <?php
      if (!empty($_GET["error"]) && $_GET["error"] === "Invalid Email or Password") {
        header("refresh:3;url=index.php");
      ?>
        <div id="alertIncorrect" class="alert text-dark bg-danger">
          <strong>Incorrect Email or Password</strong>
        </div>
      <?php
      }
      ?>
      <h1 class="mb-4">Smart Login System</h1>
      <form action="login.php" method="POST">

        <input id="email" type="email" name="email" class="inputBox form-control mb-3" placeholder="Enter your email">

        <input id="password" type="password" name="password" class="inputBox form-control mb-3" placeholder="Enter your password">

        <button id="loginBtn" type="submit" class="btn border border-info form-control my-3 ">Login</button>
        
        <label >Remeber Me</label>
        <input  type="checkbox" value="1" name = "rememberMe">
       
        <!-- <div id="alertAll" class="alert text-danger d-none">
          <strong>All inputs are required</strong>
        </div>

        <div id="alertCorrect" class="alert text-success d-none">
          <strong>Success</strong>
        </div> -->

      </form>
      <p id="makeAccount" class="">Don't have an account? <a id="signUpLink" class="text-white " href="signUp.html">Sign Up</a></p>
    </div>
  </section>

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>


</body>

</html>