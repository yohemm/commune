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
</head>
<body>
	<?php include '../includes/header.php'; ?>
	<div id="content">
		<div id="one_content">
			<?php
				$req = $db->query('SELECT * FROM page WHERE id = 1');
				$page = $req ->fetchObject();
			 	if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
			 		if(isset($_POST['page_btn'])){
			 			extract($_POST);
			 			if (!empty($index && $logement && $restaurant && $contact)) {
			 				$q = $db->prepare('UPDATE page SET accueil = :accueil, logement = :logement, restaurant = :restaurant , contact = :contact WHERE id= :id');
			 				$q->execute([
			 					'accueil' => $index,
			 					'logement' => $logement,
			 					'restaurant' => $restaurant,
			 					'contact' => $contact,
			 					'id' => 1
			 				]);
			 				?>
			 					<div class="success">Les pages ont été modifiées avec succes!</div><br>
			 				<?php
			 			}
			 			else
			 			{
			 				?> <div class="error">Veuillez remplir tous les champs!</div><br> <?php
			 			}
			 		}
			 		if (isset($_POST['news_btn'])) {
			 			extract($_POST);
			 			if(!empty($title && $content && $autor)) {
			 				$q = $db->prepare("INSERT INTO news(title, content, autor) VALUES (:title, :content, :autor)");
			 				$q -> execute([
								'title' => $title,
								'content' => $content,
								'autor' => $autor
			 				]);
			 			}

			 		}
		 		?>
			 		<h4>Ne pas ecrir le "." dans les consigne <br/> Pour passer un ligne veuillez écrir <.br>, <br/> pour inserer une image faites <.img src="Le lien de l'image"> <br> pour inserer un lien faite <.a href="Le lien">Le text sur le quel on doit cliquer<./a></h4>
					<form method="post">
						<h3>L'Accueil</h3>
						<textarea name="index" rows=15 COLS=90 required=""><?= $page->accueil ?></textarea>
						<h3>Logements</h3>
						<textarea name="logement" rows=15 COLS=90 required=""><?= $page->logement ?></textarea>
						<h3>Restauration</h3>
						<textarea name="restaurant" rows=15 COLS=90 required=""><?= $page->restaurant ?></textarea>
						<h3>Les Contacts</h3>
						<textarea name="contact" rows=15 COLS=90 required=""><?= $page->contact ?></textarea><br/>
						<input type="submit" name="page_btn" value="Modifier tous les articles">
					</form>
					<form method="post">
						<h3>Création de nouvelles:</h3>
						<textarea name="title" COLS=20 placeholder="Titre" required=""></textarea><br/>
						<textarea name="content" rows=15 COLS=90 placeholder="Contenue" required=""></textarea><br/>
						<textarea name="autor" rows=1 COLS=8 placeholder="Auteur" required=""></textarea><br/>
						<input type="submit" name="news_btn" value="Enregistrer le nouvelles articles">
					</form>
			 		<?php
			 	}
			 	else
			 	{
			 		header("location:connection");
			 	}
			?>
		</div>
	</div>
	<?php include '../includes/footer.php'; ?>
</body>
</html>