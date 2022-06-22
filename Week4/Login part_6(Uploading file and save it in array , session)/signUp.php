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

            <?php
            if (!empty($_GET["error"])) {
                header("refresh:3;url=signUp.php");

            ?>
                <div id="alertIncorrect" class="alert text-dark bg-danger">
                    <strong>
                        <?php

                        switch ($_GET["error"]) {

                            case "email_already_exists":
                                echo "email_already_exists";
                                break;

                            case "Invalid_email_format":
                                echo "Invalid_email_format ";
                                break;

                            case "empty":
                                echo "Name , Email and Password and  are required";
                                break;

                        }
                        ?>
                    </strong>
                </div>
            <?php
            }
            ?>

            <form action="signUp_proc.php" method="POST" enctype="multipart/form-data">


                <h1 class="mb-4">Smart Login System</h1>

                <input id="name" type="text" name="name" class="inputBox form-control mb-3" placeholder="Enter your name">

                <input id="email" type="email" name="email" class="inputBox form-control mb-3" placeholder="Enter your email">

                
                <input id="password" type="password" name="password" class="inputBox form-control mb-3" placeholder="Enter your password">
                
                <div class="d-flex">
                    <input id="" type="file" name="photo" class="inputBox  mb-3" placeholder="Enter your email">

                </div>

                <button id="SignUpBtn" type="submit" class="btn border border-info form-control my-3 ">Sign Up</button>



                <p id="haveAccount" class="">You have an account? <a id="signInLink" class="text-white " href="index.php">Sign In</a></p>
            </form>
        </div>
    </section>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>