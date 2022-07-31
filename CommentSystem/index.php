<?php 

include 'config.php';
error_reporting(0); // For not showing any error

if (isset($_POST['submit'])) { // Check press or not Post Comment Button
	$name = $_POST['name']; // Get Name from form
	$email = $_POST['email']; // Get Email from form
	$comment = $_POST['comment']; // Get Comment from form
	$datetoday = date('Y-m-d H:i:s',strtotime($date_today));

	$sql = "INSERT INTO comments (name, email, comment, created_at)
			VALUES ('$name', '$email', '$comment', '$datetoday')";
	$result = mysqli_query($conn, $sql);
	/*if ($result) {
		echo "<script>alert('Comment added successfully.')</script>";
	} else {
		echo "<script>alert('Comment does not add.')</script>";
	}*/
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Comment System in PHP</title>

</head>
<body>
	<div class="wrapper">
		<form action="" method="POST" class="form" id = "input_form">
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
				<textarea id="comment" name="comment" placeholder="Enter your Comment or Reply" required></textarea>
			</div>
			<div class="input-group">
				<!--<input type="submit" name="Submit" id = "Submit" class = "btn btn-secondary" value = "Submit"/>-->
				<button name="submit" class="btn">Comment</button>
			</div>
		</form>

		<div class="prev-comments">
			<?php 
			
			$sql = "SELECT * FROM comments ORDER BY id DESC";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

			?>
			<form class="single-item">
				<h4><?php echo $row['name']; ?></h4>
				<a><?php echo $row['email']; ?></a>
				<p><?php echo $row['comment']; ?></p>
				<form method = "post">
					<div class="row">
						<div class="input-group">
							<label for="name">Name</label>
							<input type="text" name="name" id="name" placeholder="Enter your Name" required>
						</div>
						<div class="input-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" placeholder="Enter your Email" required>
						</div>
						<div class="input-group textarea">
							<label for="comment">Reply</label>
							<textarea id="reply" name="Reply" placeholder="Reply" required></textarea>
						</div>
					</div>
					
				</form>
				<button type = "submit" name = "reply">Reply</button>
			</form>
			
			
			<?php

				}
			}
			
			?>
		</div>
	</div>
</body>
</html>
