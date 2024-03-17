<?php
	include 'includes/session.php';

	$conn = $pdo->open();

	$output = array('error'=>false);

	$id = $_POST['id'];
	$dayss = $_POST['dayss'];

	
			$stmt = $conn->prepare("UPDATE cart SET dayss = $dayss  WHERE id= $id");
			$stmt->execute();
			$output['message'] = 'Updated';
	
	

	$pdo->close();
	echo json_encode($output);

?>