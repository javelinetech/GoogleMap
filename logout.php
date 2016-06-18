<?php
	session_start();

	unset($_SESSION['firstname']);
	unset($_SESSION['lastname']);
	unset($_SESSION['username']);
	unset($_SESSION['user_id']);
	
	header('Location: index.php');
?>