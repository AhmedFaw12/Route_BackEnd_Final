<?php
session_start();
//to make sure that no one but user will try to access home.php using url
if(empty($_SESSION["user"])){
  header("location:index.php?error=secure_page");
}
?>
<html>
  <head>
    <title>smartLoginHome.html</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/index_style.css" />
  </head>
  <body class="overflow-hidden">
      <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
       <div class="container">
          <a class="navbar-brand" href="home.html">SMART LOGIN</a>
          <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
              aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
              <li class="nav-item active">
                <a id="logoutBtn" href="logout.php" class="nav-link btn">Logout <span class="sr-only">(current)</span></a>
              </li>
            </ul>
       </div>
          
        </div>
      </nav>

      <section id="welcomeUser" class="container vh-100 text-info d-flex justify-content-center align-items-center">
        <div class="w-75 text-center py-5">
          <!-- printing user name and  email -->
          <h1>Welcome <span id = "userName"><?=$_SESSION["user"]["name"]. " your email is " . $_SESSION["user"]["email"]?></span></h1>
        </div>
      </section>


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  
  </body>
</html>
