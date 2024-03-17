<?php
	include '../includes/conn.php';
	session_start();

	if(!isset($_SESSION['rentor']) || trim($_SESSION['rentor']) == ''){
		header('location: ../index.php');
		exit();
	}

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	$stmt->execute(['id'=>$_SESSION['rentor']]);
	$rentor = $stmt->fetch();

	$pdo->close();

?>