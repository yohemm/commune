<?php 
	session_start();
	include 'console/database.php'; 
	global $db;
	if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {

		if (isset($_GET['id'])) {

			$c = $db->prepare("SELECT * FROM users WHERE id = :id");
			$c->execute(['id' => $_GET['id']]);
			$result = $c->fetch();

			if ($result) {

			$req = $db->prepare('DELETE FROM news WHERE id = :id');
			$req-> execute(['id' => $_GET['id']]);

			header('location:index');
			}
			else
			{
			header('location:index');
			}
		}
		else
		{
			header('location:index');
		}
	}
	else
	{
		header('location:index');
	}
?>