<?php
	include 'includes/session.php';

	$output = '';

	$conn = $pdo->open();
                    $r_id = $rentor['id']; 

	$stmt = $conn->prepare("SELECT * FROM products where rentor_id = $r_id");
	$stmt->execute();
	foreach($stmt as $row){
		$output .= "
			<option value='".$row['id']."' class='append_items'>".$row['name']."</option>
		";
	}

	$pdo->close();
	echo json_encode($output);

?>