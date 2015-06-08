<?php include 'db.php';
error_reporting(-1);
ini_set('display_errors', 'On');
 ?>
<?php session_start(); ?>
<?php 
	if (!isset($_SESSION['score'])) {
		$_SESSION['score'] = 0;
	}
	if ($_POST) {
		$number = $_POST['number'];
		$selected_choice = $_POST['choice'];
		$next = $number+1;

		/*
		*  Get Total Ques
		*/		
			 $query = "SELECT * FROM questions";

			// Get results

			 $results = $mysqli->query($query) or die($mysqli->error.__LINE__);

			 $total = $results->num_rows;
		/*
		*  Get Correct Choice
		*/

		$query = "SELECT * FROM choices WHERE question_number = '$number' AND is_correct = 1";
		$result = $mysqli->query($query) or die($mysqli->error. __LINE__);

		// Get 
		 $row = $result->fetch_assoc();

		// Get correct Choice
		 $correct_choice = $row['id'];

		// Compare
		if ($correct_choice == $selected_choice) {

		 	// Correct Ans
			$_SESSION['score'] = $_SESSION['score'] + 1;

		}

		// Check Last Question
		if($number == $total){
			header('Location: final.php');
			exit();
		}else{
			header('Location: question.php?n='.$next);
		}

	}

?>