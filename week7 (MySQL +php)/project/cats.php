<?php require("header.php")?>

<div class="container-fluid">
  <div class="row">
    <?php include('sidebar.php')?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Categories</h1>
      </div>

      <div class="container-fluid">
        <div class="row">
          <form action="category_proc.php" method="POST">
            <div class="col-6">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Categories" aria-describedby="helpId"> 


                <!-- if i submitted empty name , then category_proc page will send me an error message empty -->
                <?php 
                if(!empty($_GET["error"]) && $_GET["error"] == "empty" ){
                  echo '<small id = "helpId" class="form-text text-danger">Name is Required</small>';
                }
                ?>

              </div>
              <input class="btn btn-primary mt-3" type="submit" value="Save">              
            </div>
          </form>
        </div>
        
        <!-- i need to display the products that is inserted -->
        <!-- so i need to connect to database then select the data then display in div -->
        <div class="row mt-5">
            <?php 
              require_once("config.php");
              $cn = mysqli_connect(HOST_NAME, DB_UN, DB_PW, DB_NAME, DB_PORT);

              $qry = "select id , name, created_at from categories";

              $rslt = mysqli_query($cn, $qry);
              while($row = mysqli_fetch_assoc($rslt)){
                ?>
                  <div class="col-2">
                    <div class="card border-primary">
                      <img class="card-img-top" src="holder.js/100px180/" alt="">
                      <div class="card-body">
                        <h4 class="card-title"><?= $row["name"]?></h4>
                        <p class="card-text"><?= $row["created_at"]?></p>
                        <!-- we will add a link button that will direct me to category_delete.php page that will delete the data from database -->
                        <a href="category_delete.php?id=<?= $row["id"]?>"class = " btn btn-sm btn-danger">delete</a>
                      </div>
                    </div>
                  </div>

                <?php
              }

              mysqli_close($cn);
            ?>
          
        </div>
      
      </div>



    </main>
  </div>
</div>


<?php require("footer.php")?>

