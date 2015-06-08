<?php
include 'db.php';
$query = "SELECT * FROM questions";
$questions = $mysqli->query($query) or die($mysqli->error.__LINE__);
$total = $questions->num_rows;
$next = $total + 1;

	if(isset($_POST['submit'])){
		// Get post variables
		$question_number = $_POST['question_number'];
		$question_text = $_POST['question_text'];
		$correct_choice = $_POST['correct_choice'];

		// Choices Array
		$choices = array();
		$choices[1] = $_POST['choice1'];
		$choices[2] = $_POST['choice2'];
		$choices[3] = $_POST['choice3'];
		$choices[4] = $_POST['choice4'];
		$choices[5] = $_POST['choice5'];

		//  Question Query
		$query = "INSERT INTO questions (question_number, text) VALUES('$question_number', '$question_text')";
		$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);

		// Validate Insert

		if($insert_row){
			foreach ($choices as $choice => $value) {
				if ($value != '') {
					if ($correct_choice == $choice) {
							$is_correct = 1;
						}else{
							$is_correct = 0;
						}
						// choice query
						$query = "INSERT INTO choices(question_number, is_correct, text) VALUES('$question_number', '$is_correct', '$value')";
						// Run Query
						$insert_row = $mysqli->query($query) or die($mysqli->error.__LINE__);

						//Validate insrt
						if ($insert_row) {
							continue;
						}else{
							die('ERROR: '.$mysqli->errno . " | ". $mysqli->error);
						}
				}
			}
		}
		$msg = "Question has been added";
	}

?><!DOCTYPE html>
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
	<div class="one bl">
	<h2>Add A Question</h2>
	<?php if (isset($msg)) : ?>
		<p class="submit"><?php echo $msg; ?></p>
		<?php endif; ?>
		<form method="post" action="admin.php">
			<p>
				<label>Question Number</label>
				<input type="number" name="question_number" value="<?php echo $next; ?>">
			</p>		
			<p>
				<label>Question Text</label>
				<input type="text" name="question_text">
			</p>
			<p>
				<label>Choice #1</label>
				<input type="text" name="choice1">
			</p>	
			<p>
				<label>Choice #2</label>
				<input type="text" name="choice2">
			</p>
			<p>
				<label>Choice #3</label>
				<input type="text" name="choice3">
			</p>
			<p>
				<label>Choice #4</label>
				<input type="text" name="choice4">
			</p>
			<p>
				<label>Choice #5</label>
				<input type="text" name="choice5">
			</p>	
			<p>
				<label>Correct Choice Question</label>
				<input type="number" name="correct_choice">
			</p>
			<input type="submit" name="submit" value="Submit">		
		</form>
		</div>
		<div class="one">
	<h2>Delete a Question</h2>

		<?php

$query = "SELECT * FROM questions";
$result = $mysqli->query($query);


if(isset($_GET['delete_id'])){
	$selected = $_GET['delete_id'];

	$query = "DELETE FROM questions WHERE question_number = '$selected'";
	$run = $mysqli->query($query);
	$query = "DELETE FROM choices WHERE question_number = $selected";
	$re = $mysqli->query($query);

	if($re && $run){
		echo "Deleted";
	}else{
		echo "Error Reported";
	}

}

?>


	<form action="admin.php" method="GET">
	    <select name="delete_id" id="delete_id" onchange="this.form.submit()">
	        <?php while ($row = $result->fetch_assoc()) : ?>
				  <option value="<?php echo $row['question_number']; ?>"><?php echo " ".$row['text']; ?></option>
			<?php endwhile; ?>
	    </select>
	</form>
		
</div>
	</div>
</main>
	<footer>
		<div class="container">
			Copyright &copy; 2015, Usman's Concept		
		</div>
	</footer>
</body>
</html>