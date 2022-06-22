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
            <form action="">


                <h1 class="mb-4">Smart Login System</h1>
                <input id="name" type="text" name="name" class="inputBox form-control mb-3" placeholder="Enter your name">

                <input id="email" type="email" name="email" class="inputBox form-control mb-3" placeholder="Enter your email">
                <input id="password" type="password" name="password" class="inputBox form-control mb-3"
                placeholder="Enter your password">
                
                <button id="SignUpBtn" class="btn border border-info form-control my-3  ">Sign Up</button>
                
                
                <!-- <div id="alertAll" class="alert text-danger d-none">
                    <strong>All inputs are required</strong>
                </div>

                <div id="alertCorrect" class="alert text-success d-none">
                    <strong>Success</strong>
                </div>

                <div id="alertEmailExist" class="alert text-danger d-none">
                    <strong>email already exists</strong>
                </div> -->


                <p id="haveAccount" class="">You have an account? <a id="signInLink"  class="text-white " href="index.php">Sign In</a></p>
            </form>
        </div>
    </section>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>