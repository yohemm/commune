<?php 
	session_start();
	include 'console/database.php'; 
	global $db;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Liézey | Actualités</title>
	<link rel="stylesheet" type="text/css" href="includes/global.css">
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<div id="content">
		<?php include 'includes/menu-nav.php'; ?>
		<div id="right_box">
			<?php 
				$q = $db->query('SELECT * FROM news ORDER BY id DESC');
				$result = $q->fetchAll();
				foreach ($result as $news ) : ?>
					<div class="new">
						<h3 class="new_title"><?= $news['title'] ?></h3>
						<p class="new_content" ><?= substr($news['content'], 0, 20), "..."?> <br/><a href="single_new?id=<?= $news['id'] ?>">voir plus</a></p>
						<p class="new_end">par <?= $news['autor']?>, le <?= substr($news['date'], 0, 10) ?></p>
					</div>
					<br>
				<?php endforeach ?>
		</div>
	</div>
	<?php include 'includes/footer.php'; ?>
</body>
</html>