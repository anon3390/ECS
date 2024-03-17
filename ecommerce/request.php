<?php
	include 'includes/session.php';

	$conn = $pdo->open();

	$output = array('error'=>false);
	$rentid = $_POST['rentor_id'];
    $userid = $_POST['user_id'];
    $description = $_POST['descrption'];
    $photo = $_POST['proof'];
	if(isset($_SESSION['user'])){
		try{
           
            $stmt = $conn->prepare("INSERT INTO report (from_id, against_id, request) VALUES (:user_id, :rent_id, :description)");
			$stmt->execute(['rent_id'=>$rentid, 'user_id'=>$userid, 'description'=>$description]);
       
            $output['message'] = "reported";
        
            echo '<script>alert("Rentor Reported")</script>';	
            header('location: index.php');
            
		}
		catch(PDOException $e){
			$output['message'] = $e->getMessage();
		}
	}
	

	$pdo->close();
	echo json_encode($output);

?>