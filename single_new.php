<?php 
	session_start();
	include 'console/database.php'; 
	global $db;
	include 'includes/function.php'
?>
<!DOCTYPE html>
<html>
<head>
	<title>Liézey | Nouvelles</title>
	<link rel="stylesheet" type="text/css" href="includes/global.css">
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<div id="content">
		<?php include 'includes/menu-nav.php'; ?>
		<div id="right_box">
			<?php 
				if (isset($_GET['id'])) {
					$new = getNew($db,1,$_GET['id']); ?>
					<div class="new">
					<h3 class="new_title"><?= $new->title ?></h3>
					<p class="new_content"><?= $new->content ?></p>
					<p class="new_end">par <?= $new->autor?>, le <?= $new->date ?></p>
				</div>
				<?php 
					if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) : ?>
						<a href="modify_new?id=<?= $_GET['id'] ?>">Modifier l'article</a>
						<a href="delete_new?id=<?= $_GET['id'] ?>">Supprimer l'article</a>
						<a href="console/">Administration</a>
					<?php 
					endif;
				}
				else
				{
					header('location:news.php');
				}
			?>
			
		</div>
	</div>
	<?php include 'includes/footer.php'; ?>
</body>
</html>