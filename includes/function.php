<?php 
	function getNew($db,$nb=null, $id = null){
		if ($nb && !$id) {
			$req = $db->query('SELECT * FROM news LIMIT ' .$nb);
			$new = $req->fetchAll();
		}
		elseif ($id) {
			$req = $db->query('SELECT * FROM news WHERE id =' .$id);
			$new = $req ->fetchObject();
		}
		else
		{
			$req = $db->query('SELECT * FROM news');
			$new = $req ->fetchAll();
		}
		return $new;
	}
?>