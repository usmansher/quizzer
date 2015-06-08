<?php
if(!($_GET)){
	header('Location: question.php?n=1');
}
?>
<?php include 'db.php'; ?>
<?php 
	// Set Question Number
	$number = (int) $_GET['n'];

	/*
	*  Get Question
	*/

	$query = "SELECT * FROM questions WHERE question_number = $number";

	// Get Result

	$result = $mysqli->query($query) or die($mysqli->error. __LINE__);

	$question = $result->fetch_assoc();


	/*
	*  Get Choices
	*/

	$query = "SELECT * FROM choices WHERE question_number = $number";

	// Get Result

	$choices = $mysqli->query($query) or die($mysqli->error. __LINE__);

	/*
	* Get Total Questions
	*/

$query = "SELECT * FROM questions";

// Get Results
$result = $mysqli->query($query) or die($mysqli->error. __LINE__);

$total = $result->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP Quizzer - Usman</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<header>
	<div class="container">
		<h1>PHP Quizzer</h1> 
	</div>
</header>
<main>
	<div class="container">
		<div class="current">
			Question <?php echo $number; ?> of <?php echo $total; ?>		
		</div>
		<p class="question">
			<?php echo $question['text']; ?>
		</p>
		<form method="post" action="core.php">
			<ul class="choices">
				<?php while ($row = $choices->fetch_assoc()) : ?>
					<li class="choice"><input name="choice" type="radio" value="<?php echo $row['id']; ?>"><?php echo " ".$row['text']; ?></li>
				<?php endwhile; ?>
			</ul>
			<input type="submit" value="submit">
			<input type="hidden" name="number" value="<?php echo $number; ?>">
		</form>
	</div>
</main>
<footer>
	<div class="container">
Copyright &copy; 2015, Usman's Concept		
	</div>
</footer>
</body>
</html>