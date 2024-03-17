<?php 

			$stmt = $conn->prepare("UPDATE cart SET dayss = 3  WHERE id=13");
			$stmt->execute();
			$output['message'] = 'Updated';
		
	
	
?>