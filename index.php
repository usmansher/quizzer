
<?php include 'db.php'; ?>
<?php

session_start();
session_destroy();

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
		<h2>Test your PHP Knowledge</h2>
		<p>this is a multiple choice quiz to test your knowledhr of PHP</p>
		<ul>
			<li><strong>Number of Question: </strong><?php echo $total; ?></li>
			<li><strong>Type: </strong>Multiple Choice</li>
			<li><strong>Estimated Time </strong><?php echo $total * .5; ?> minutes</li>
		</ul>
		<a href="question.php?n=1" class="start">Start Quiz</a>
	</div>
</main>
<footer>
	<div class="container">
Copyright &copy; 2015, Usman's Concept		
	</div>
</footer>
</body>
</html>