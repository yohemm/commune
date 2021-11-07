<?php 
	session_start();
	include 'console/database.php'; 
	global $db;
	include 'includes/function.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Liézey | Contacts</title>
	<link rel="stylesheet" type="text/css" href="includes/global.css">
</head>
<body>
	<?php include 'includes/header.php'; ?>
	<div id="content">
		<?php include 'includes/menu-nav.php'; ?>
		<div id="right_box">
			<?php 
				if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {

					if (isset($_GET['id'])) {

						$c = $db->prepare("SELECT * FROM users WHERE id = :id");
						$c->execute(['id' => $_GET['id']]);
						$result = $c->fetch();

						if ($result == true) {

							$new = getNew($db,1,$_GET['id']);
							?>

							<h3>Modifier l'article <?= $new->title ?></h3>
							<h4>Ne pas ecrir le "." dans les consigne <br/> Pour passer un ligne veuillez écrir <.br>, <br/> pour inserer une image faites <.img src="Le lien de l'image"> <br> pour inserer un lien faite <.a href="Le lien">Le text sur le quel on doit cliquer<./a></h4>

							<form method="post">
								<input type="text" name="title" value="<?=  $new->title?>"><br/>
								<textarea name="content"rows=15 COLS=90><?=  $new->content?></textarea><br/>
								<input type="text" name="autor" value="<?=  $new->autor?>"><br/>
								<input type="submit" name="btn" id="btn" value="Modifier l'article">
							</form>

							<?php if (isset($_POST['btn'])) {

								extract($_POST);
								if (!empty($title) && !empty($content) && !empty($autor)) {

									$req = $db->prepare('UPDATE news SET title = :title, content = :content, autor = :autor WHERE id = :id');
									$req->execute([
										'title' => $title,
										'content' => $content,
										'autor' => $autor,
										'id' => $_GET['id']
									]);
									?> 
									<div class="success"><p>Article modifié!</p></div>
									<?php
								}
								else
								{
									?> 
									<div class="error"><p>veuillez remplir tous les champs!</p></div>
									<?php
								}
							}
						}
						else
						{
						header('location:index.php');
						}
					}
					else
					{
						header('location:index.php');
					}
				}
				else
				{
					header('location:index.php');
				}
			?>
		</div>
	</div>
	<?php include 'includes/footer.php'; ?>
</body>
</html>