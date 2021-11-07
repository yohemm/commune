<?php 
	session_start();
	include 'database.php'; 
	global $db;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Liézey</title>
	<link rel="stylesheet" type="text/css" href="../includes/global.css">
	<link rel="icon" type="image/x-icon" href="/../img/favicon.ico" />
</head>
<body>
	<?php include '../includes/header.php'; ?>
	<div id="content">
		<div id="one_content">
			<form method="post">
	<input type="text" name="pseudo" id="pseudo" placeholder="pseudo" required="">
	<input type="password" name="password" id="password" placeholder="mot de passe" required="">
	<input type="submit" name="formsend" id="formsend" value="connection" required="">
</form>
<?php 
	include 'inscription.php';
	if (isset($_POST['formsend'])) {
		extract($_POST);
		if (!empty($pseudo) && !empty($password)) {

			$c = $db->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
			$c->execute(['pseudo' => $pseudo]);
			$result = $c->fetch();
			
			if ($result == true) {
				if (password_verify($password, $result['password'])){
					$_SESSION['admin'] = $pseudo;
					header('location:index');
				}
				else
				{?>
				<div class="error"> <p>Erreur de connection</p> </div>
				<?php }
			}
			else{ ?>
				<div class="error"> <p>Erreur de connection</p> </div>
			<?php }
		}
		else { ?>
			<div class="error"> <p>veuillez completez tous les champs!</p> </div>
		<?php } 
	}
 ?>
		</div>
	</div>
	<?php include '../includes/footer.php'; ?>
</body>
</html>