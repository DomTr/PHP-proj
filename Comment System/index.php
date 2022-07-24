<?php 

include 'config.php';

error_reporting(0); // For not showing any error

if (isset($_POST['submit'])) { // kai paspaudziamas 'post'
	$name = $_POST['name']; // gauti varda
	$email = $_POST['email']; // gauti email
	$comment = $_POST['comment']; // gauti komentara

	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo 'Email must be a valid email adress';
	}


	$sql = "INSERT INTO comments (name, email, comment)
			VALUES ('$name', '$email', '$comment')";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Comment added successfully.')</script>";
	} else {
		echo "<script>alert('Comment does not add.')</script>";
	}
}

if(isset($_POST['reply-btn'])){
	echo 'To reply please fill in the form';

	$name = $_POST['name']; // gauti varda
	$email = $_POST['email']; // gauti email
	$comment = $_POST['reply']; // gauti komentara

	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo 'Email must be a valid email adress';
	}


	$sql = "INSERT INTO replies (name, email, reply)
			VALUES ('$name', '$email', '$reply')";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Reply added successfully.')</script>";
	} else {
		echo "<script>alert('Reply does not add.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>PHP comment system</title>
</head>
<body>
	<div class="wrapper">
		<form action="" method="POST" class="form">
			<div class="row">
				<div class="input-group">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" placeholder="Enter your Name" required>
				</div>
				<div class="input-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" placeholder="Enter your Email" required>
				</div>
			</div>
			<div class="input-group textarea">
				<label for="comment">Comment</label>
				<textarea id="comment" name="comment" placeholder="Enter your Comment" required></textarea>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Post Comment</button>
			</div>
		</form>
		<div class="prev-comments">
			<?php 
			
			$sql = "SELECT * FROM comments";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

			?>
			<div class="single-item">
				<h4><?php echo $row['name']; ?></h4>
				<a href="mailto:<?php echo $row['email']; ?>"> <?php echo $row['email']; ?> </a>

				<div><a href="#"> <?php echo $row['comment'];?></a></div>

				<div class="input-group">
					<button name="reply-btn" class="btn">Reply</button>
				</div>	
				<div class = "prev-replies">
					<?php 
					$sql2 = "SELECT * FROM replies";
					$result2 = mysqli_query($conn, $sql2);
					if(mysqli_num_rows($result2) > 0){
						while($row2 = mysqli_fetch_assoc($result2)){
							?>
							<h4><?php echo $row2['name']; ?></h4>
							<a href="#"><?php echo $row2['email']; ?></a>
							<div><a href="#"><?php echo $row2['reply'] ?></a></div>

					<?php 	
						}
					 
					}
					?>

				</div>


			</div>
			<?php

				}
			}
			
			?>
		</div>
	</div>
</body>
</html>