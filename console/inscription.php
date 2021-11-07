<form method="post">
	<input type="text" name="pseudo" id="pseudo" placeholder="pseudo" required="">
	<input type="password" name="password" id="password" placeholder="mot de passe" required="">
	<input type="password" name="cpassword" id="cpassword" placeholder="repetez le mot de passe" required="">
	<input type="submit" name="inscription" id="formsend" value="inscription" required="">
</form>
<?php 
	if (isset($_POST['inscription'])) {
		extract($_POST);
		if (!empty($pseudo) && !empty($password) && !empty($cpassword)) {
			if ($password == $cpassword) {
				$options = [
				    'cost' => 12,
				];
				$hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

				$c = $db->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
				$c->execute(['pseudo' => $pseudo]);
				$result = $c->rowCount();
				
				if ($result == 0 ) {
					$q = $db->prepare("INSERT INTO users(pseudo, password) VALUES(:pseudo, :password) ");
					$q->execute([
						'pseudo' => $pseudo,
						'password' => $hashpass
					]); ?>
						<div class="success"> <p>Le compte a était créé avec succes!</p> </div>
					<?php 					
				}
				else{ ?>
			<div class="error"> <p>Le pseudo existe déjà!</p> </div>
			<?php }
			}
			else{ ?>
			<div class="error"> <p>La confirmation du mot de passe ne corespond pas à celui-ci!</p> </div>
			<?php }
		}
		else { ?>
			<div class="error"> <p>veuillez completez tous les champs!</p> </div>
		<?php } 
	}
 ?>