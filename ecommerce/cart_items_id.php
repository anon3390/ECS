<?php 
    include 'includes/session.php';
    
	if(isset($_SESSION['user'])){
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT id FROM cart WHERE user_id=:user_id");
		$stmt->execute(['user_id'=>$user['id']]);
        foreach($stmt as $row){
			$cart = $row['id'];
		}
	

		$pdo->close();

		echo json_encode($cart);
	}
?>