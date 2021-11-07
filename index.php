<?php 
	include 'console/database.php'; 
	global $db;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Liézey</title>
	<link rel="stylesheet" type="text/css" href="includes/global.css">
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<div id="content">
		<?php include 'includes/menu-nav.php'; ?>
		<div id="right_box">
			<p>
				<?php
				//améliorable pour prendre juste la page au lieux de tt 
				$req = $db->query('SELECT * FROM page WHERE id = 1');
				$page = $req ->fetchObject();
				echo $page->accueil;
				?>
			</p>
		</div>
	</div>
	<?php include 'includes/footer.php'; ?>
</body>
</html>