<?php
$active = "Users";
require_once("header.php");
require_once("config.php");
// //only admins can enter this page
// if (!empty($_SESSION["user"]) && $_SESSION["user"]["role"] == "admin") {
//     $user = $_SESSION["user"];
// } else {
//     session_unset();
//     header("location:index.php?errors=secure_page");
// }

?>

<div class="container d-flex justify-content-center align-items-center mt-4 ">
    <table class="table table-striped table-responsive table-bordered table-hover table-inverse">
        <thead class="bg-primary">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Created By</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                    $cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);

                    $qry = "select u.id, u.email, u.mobile, u.name, u.gender, u.role, u.created_at, a.name as created_by
                    from users u left outer join users a
                    on (u.created_by = a.id)
                    order by created_at desc";
                    $rslt = mysqli_query($cn, $qry);
                    while($row = mysqli_fetch_assoc($rslt)){
                ?>
                    <tr>
                        <td scope="row"><?=$row["id"]?></td>
                        <td><?=$row["name"]?></td>
                        <td><?=$row["email"]?></td>
                        <td><?=$row["mobile"]?></td>
                        <td><?=$row["gender"]?></td>
                        <td><?=$row["role"]?></td>
                        <td><?=$row["created_by"]?></td>
                        <td><?=$row["created_at"]?></td>
                    </tr>
                <?php
                    }
                    mysqli_close($cn);
                ?>
                
            </tbody>
    </table>
</div>




<?php
if (!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
if (!empty($_SESSION["old_values"])) unset($_SESSION["old_values"]);
if (!empty($_SESSION["success"])) unset($_SESSION["success"]);
?>

<?php require_once("footer.php"); ?>