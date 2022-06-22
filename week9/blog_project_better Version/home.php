<?php
$active = "home";
require_once("header.php");
require_once("config.php");

?>

<div class="container mt-4">

	<!-- make Post Appear only to admins and editors -->
	<?php
	if ($user['role'] == "admin" || $user['role'] == "editor") {
	?>
		<!-- Create Post UI -->
		<div>
			<h1><?= $messages["Make Post"] ?></h1>

			<form action="post/post_create.php" class="mt-5" method="POST" enctype="multipart/form-data">

				<div class="text-success h2">
					<strong>
						<?php
						if (!empty($_SESSION["success"]) && !empty($_SESSION["success"]["pending"])) {
							echo $_SESSION["success"]["pending"];
						}
						if (!empty($_SESSION["success"]) && !empty($_SESSION["success"]["approved"])) {
							echo $_SESSION["success"]["approved"];
						}
						?>
					</strong>
				</div>



				<!-- post_title -->
				<div class="validate-input <?php if (!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["post_title"])) echo "alert-validate"; ?>" data-validate="<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["post_title"])) echo $_SESSION['errors']["post_title"] ?>">

					<input type="text" name="title" class="form-control mt-1" value="<?php if (!empty($_SESSION['old_values']["post_title"])) echo $_SESSION['old_values']["post_title"] ?>" placeholder="<?= $messages["Post Title"] ?>">
				</div>

				<!-- post_body -->
				<div class="validate-input <?php if (!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["post_body"])) echo "alert-validate"; ?>" data-validate="<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["post_body"])) echo $_SESSION['errors']["post_body"] ?>">

					<textarea name="body" rows="5" class="form-control mt-1" placeholder="<?= $messages["Post Body"] ?>"><?php if (!empty($_SESSION['old_values']["post_body"])) echo $_SESSION['old_values']["post_body"] ?></textarea>
				</div>

				<!-- post-image -->
				<div class="validate-input <?php if (!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["post_image"])) echo "alert-validate"; ?>" data-validate="<?php if (!empty($_SESSION["errors"]) && !empty($_SESSION['errors']["post_image"])) echo $_SESSION['errors']["post_image"] ?>">

					<input type="file" name="image" class="form-control mt-1">
				</div>
				<button class="btn btn-light mt-2 px-5" type="submit"><?= $messages["POST"] ?></button>
			</form>
		</div>
	<?php
	}
	?>



	<div class="m-5">

		<div class="text-danger h2">
			<strong>
				<?php
				// var_dump($_SESSION);
				//  invalid delete 
				if (!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["delete"])) {
					echo $_SESSION["errors"]["delete"];
				}
				// invalid aprrove/reject
				if (!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["approve_reject"])) {
					echo $_SESSION["errors"]["approve_reject"];
				}

				// invalid Edit
				if (!empty($_SESSION["edit_errors"]) && !empty($_SESSION["edit_errors"]["post_id"])) {
					echo $_SESSION["edit_errors"]["post_id"];
				}

				if (!empty($_SESSION["edit_errors"]) && !empty($_SESSION["edit_errors"]["edit"])) {
					echo $_SESSION["edit_errors"]["edit"];
				}
				?>
			</strong>
		</div>

		<!-- displaying all posts -->
		<?php
		//check role, make approved posts appear to all users
		//make (pending), approved posts appear to admins only
		if ($user["role"] == "admin") $status_cond = "status in('pending','approved')";
		else $status_cond = "status ='approved'";


		$qry = "select p.id, p.title, p.body,p.image, p.created_by, p.created_at, p.status, u.name as user_name 
			from posts p join users u 
			on(u.id = p.created_by)
			where $status_cond
			order by p.created_at desc";

		$cn  = mysqli_connect(HOST_NAME, DB_USER_NAME, DB_PW, DB_NAME, PORT);
		$rslt = mysqli_query($cn, $qry);
		if ($rslt) {
			while ($post = mysqli_fetch_assoc($rslt)) {
		?>
				<div class="row">
					<div class="col  mx-2 my-1">
						<div class="card text-white bg-secondary">
							<img class="card-img-top" src="<?= $post["image"] ?>" alt="">
							<div class="card-body">
								<h4 class="card-title"><?= $post["title"] ?></h4>
								<p class="card-text"><?= $post["body"] ?></p>
								<div class="d-flex justify-content-between">

									<p class="card-text">Post By <?= $post["user_name"] ?> at <?= $post["created_at"] ?></p>
									<div>
										<?php
										// Edit button
										if ($post["status"] == "approved" && $user["id"] == $post["created_by"]) {

										?>
											<a class="btn btn-sm btn-primary" href="post/post_edit.php?post_id=<?= $post["id"] ?>"><?= $messages["Edit"] ?></a>
										<?php
										}
										// Approve - Reject buttons	
										if ($post["status"] == "pending" && $user["role"] == "admin") {
										?>
											<a class="btn btn-sm btn-success" href="post/post_action.php?post_id=<?= $post["id"] ?>&action=approved"><?= $messages["Approve"] ?></a>

											<a class="btn btn-sm btn-danger" href="post/post_action.php?post_id=<?= $post["id"] ?>&action=rejected"><?= $messages["Reject"] ?></a>
										<?php
											// Delete button
										} else if ($user["id"] == $post["created_by"] || $user["role"] == "admin") {
										?>
											<a class="btn btn-sm btn-danger" href="post/post_delete.php?post_id=<?= $post["id"] ?>"><?= $messages["delete"] ?></a>
										<?php
										}

										?>
									</div>
								</div>

								<!--like section  -->
								<div>
									<form action="like.php?post_id=<?= $post["id"] ?>" method="POST">
										<!-- select all likes -->
										<?php
										//get likes count
										$likes_count = 0;
										$loves_count = 0;
										$like_count_qry = "SELECT count(*) as 'like_count' from likes 
										group by type, post_id
										having post_id=" . $post["id"] . " and type ='like'";

										$like_count_rslt = mysqli_query($cn, $like_count_qry);
										if ($row = mysqli_fetch_assoc($like_count_rslt)) {
											$likes_count = $row["like_count"];
										}

										$love_count_qry = "SELECT count(*) as 'love_count' from likes 
										group by type, post_id
										having post_id=" . $post["id"] . " and type ='love'";

										$love_count_rslt = mysqli_query($cn, $love_count_qry);
										if ($row = mysqli_fetch_assoc($love_count_rslt)) {
											$loves_count = $row["love_count"];
										}

										$qry2 = "select id,type,user_id,post_id from likes where post_id=" . $post["id"] . " and user_id =" . $user["id"];
										$rslt2 = mysqli_query($cn, $qry2);

										if ($row = mysqli_fetch_assoc($rslt2)) {
											//already liked but never loved
											if ($row["type"] == "like") {
										?>
												<button type="submit" name="reaction" value="dislike"><i class="fa fa-thumbs-up  text-primary"></i> </button>
												<span><?php if ($likes_count > 0) echo $likes_count ?></span>

												<button type="submit" name="reaction" value="love"><i class="fa fa-heart text-white"></i></button>
												<span><?php if ($loves_count > 0) echo $loves_count ?></span>
											<?php
												//already loved but never liked
											} else if ($row["type"] == "love") {
											?>
												<button type="submit" name="reaction" value="like"><i class="fa fa-thumbs-up  text-white"></i> </button>
												<span><?php if ($likes_count > 0) echo $likes_count ?></span>
												<button type="submit" name="reaction" value="unlove"><i class="fa fa-heart text-danger"></i></button>
												
												<span><?php if ($loves_count > 0) echo $loves_count ?></span>
											<?php
											}
											?>
										<?php
										} else {
											//never liked
										?>
											<button type="submit" name="reaction" value="like"><i class="fa fa-thumbs-up text-white"></i> </button>
											<span><?php if ($likes_count > 0) echo $likes_count ?></span>
											<button type="submit" name="reaction" value="love"><i class="fa fa-heart text-white"></i></button>
											<span><?php if ($loves_count > 0) echo $loves_count ?></span>
											<!-- <button type="submit" name="reaction" value="angry">😡 </button> -->
										<?php
										}
										?>
									</form>
								</div>

								<!-- comment section -->
								<!-- <button class="" id="slide" onclick="alert('hello');">Comment</button> -->
								<button class="btn btn-sm btn-light mt-2 slide_btn" id="slide"><?= $messages["Comment"] ?></button>
								<style>
									#comment{
 										 display: none;
									}
								</style>
								<section id="comment">
									
									<!-- Entering comment -->
									<form id="comment_form" action="comment_create.php" class="" method="POST">
										<div class="d-flex justify-content-between">
											<div class="row w-100">
												<div class="col-md-8">
													<!-- hidden input to send post_id -->
													<input type="hidden" name="post_id" value="<?php if(!empty($post["id"])) echo $post["id"]?>" >

													<div class="validate-input  <?php if(!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["comment"])) echo "alert-validate ";?>" 

													data-validate="<?php if(!empty($_SESSION["errors"]) && !empty($_SESSION["errors"]["comment"])) echo $_SESSION["errors"]["comment"];
													?>">
														<textarea  name="comment" rows="2" class="form-control cmt-class mt-1" placeholder="<?= $messages["Enter Your Comment"] ?>"></textarea>
													<?php if (!empty($_SESSION["errors"])) unset($_SESSION["errors"]); ?>
													</div>
												</div>
											</div>
											<button class="btn btn-sm btn-light mt-2" type="submit"><?= $messages["Comment"] ?></button>
										</div>
									</form>
									<!-- displaying all comments for each post-->
									<div>
										<h2>Comments:</h2>
										<?php
										$comment_qry = "select c.id, c.comment, c.post_id, c.created_at, c.user_id, u.name user_name
										from comments c join users u
										on(c.user_id = u.id)
										where c.post_id =" . $post["id"] . " order by created_at desc";

										$comment_rslt = mysqli_query($cn, $comment_qry);
										while ($comment = mysqli_fetch_assoc($comment_rslt)) {
										?>
											<div class="row">
												<div class="col mt-2">
													<div class="card">
														<div class="card-body">
															<p class="card-text"><?= $comment["comment"] ?></p>
															<div class="d-flex justify-content-between">
																<p class="card-text">Comment By <?= $comment["user_name"] ?> at <?= $comment["created_at"] ?></p>
																		<div>
																			<!-- edit comment -->
																			<?php
																				if($user['id'] == $comment["user_id"]){
																			?>	
																				<a class="btn btn-sm btn-primary" href="comment_edit.php?comment_id=<?=$comment["id"]?>&post_id= <?=$post["id"]?>"><i class="fas fa-edit"></i></a>
																			<?php
																				}
																			?>
																			<!-- delete comment -->
																			<?php
																				if($user['role']=="admin" || $user['id'] == $comment["user_id"]){
																			?>	
																					<a class="btn btn-sm btn-danger" href="comment_delete.php?comment_id=<?=$comment["id"]?>&post_id= <?=$post["id"]?>"><i class="fas fa-trash-alt"></i></a>

																			<?php
																				}
																			?>
																		</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php
										}
										?>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
		<?php
			}
		}
		mysqli_close($cn);
		?>
	</div>
</div>
	
<script>
</script>
<!-- <script>
	//function to submit form when press Enter 
	var comment_inputs = document.querySelectorAll('.cmt-class');
	for (var i = 0; i < comment_inputs.length; i++) {
		comment_inputs[i].addEventListener('keypress', function(event) {
			// when press ctrl + enter , make a new line
			if (event.keyCode == 10) {
				document.getElementById('comment').value += '\r\n';
			}
			// when press enter , submit the form
			else if (event.keyCode == 13) {
				event.preventDefault();
				document.getElementById("comment_form").submit();
			}
		});
	}
</script> -->


<?php
if (!empty($_SESSION["errors"])) unset($_SESSION["errors"]);
if (!empty($_SESSION["edit_errors"])) unset($_SESSION["edit_errors"]);
if (!empty($_SESSION["old_values"])) unset($_SESSION["old_values"]);
if (!empty($_SESSION["success"])) unset($_SESSION["success"]);
?>
<?php require_once("footer.php") ?>