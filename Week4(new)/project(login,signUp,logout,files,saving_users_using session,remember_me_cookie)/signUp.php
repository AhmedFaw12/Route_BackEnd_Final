<html>

<head>
    <title>smartLoginSignUp.html</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/index_style.css" />
</head>

<body class="d-flex justify-content-center align-items-center">

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
                case"empty_email_or_password_or_name":
                echo "empty Email or Password or Name";
                break;
                case "email_already_exists":
                echo "Email Already Exists";
                break;
                case "invalid_email_format":
                echo "invalid email format";
                break;
            }
            ?>
                </strong>
            </div>
            <?php
            }
            ?>
            <form action="sign_up_proc.php" method="POST">


                <h1 class="mb-4">Smart Login System</h1>

                <input id="name" type="text" name="name" class="inputBox form-control mb-3" placeholder="Enter Your Name">

                <input id="email" type="email" name="email" class="inputBox form-control mb-3" placeholder="Enter your email">
                
                
                <input id="password" type="password" name="password" class="inputBox form-control mb-3"
                placeholder="Enter your password">
                
                <button id="SignUpBtn" class="btn border border-info form-control my-3  ">Sign Up</button>
                
                
            

                <p id="haveAccount" class="">You have an account? <a id="signInLink"  class="text-white " href="index.php">Sign In</a></p>
            </form>
        </div>
    </section>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>