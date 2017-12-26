<?php
if(!empty($_FILES))
{
	$img = $_FILES['image'];
	$taille_max = 5097152; // Taille maximal autorisée
	$extension = pathinfo($img['name'], PATHINFO_EXTENSION); // Récupère l'extension du fichier
	$allow_ext = ["jpg","png","gif","jpeg"]; //Extensions autorisées
	// Si la taille est inférieur à 5 Mo alors go =>
	if($img['size'] <= $taille_max){
		
		if(in_array($extension, $allow_ext))
		{
			if(isset($req))	
			{
				$img_name = $img['name'];
				$alt = $_POST['alt'];
				$insert = $db->prepare("INSERT INTO images SET nom_image=:img_name,id_work=:id_work, alt=:alt");
				$insert->bindParam(':img_name',$img_name, PDO::PARAM_STR);
				$insert->bindParam(':id_work',$id_work, PDO::PARAM_INT);
				$insert->bindParam(':alt', $alt, PDO::PARAM_STR);		
				$insert->execute() or die(print_r($db->errorInfo()));
				move_uploaded_file($img['tmp_name'], "../asset/img/upload/".$img['name']); //Déplacement renommage de l'image
				$reussi_upload = "Votre fichier à été transféré";
			}
			elseif(isset($requete_modifier))
			{
				$img_name = $img['name'];
				$alt = $_POST['alt'];
				$insert = $db->prepare("UPDATE images SET nom_image=:img_name, alt=:alt WHERE id_work = :id_work");
				$insert->bindParam(':img_name',$img_name, PDO::PARAM_STR);
				$insert->bindParam(':alt', $alt, PDO::PARAM_STR);		
				$insert->bindParam(':id_work', $id_work, PDO::PARAM_INT);		
				$insert->execute() or die(print_r($db->errorInfo()));
				move_uploaded_file($img['tmp_name'], "../asset/img/upload/".$img['name']); //Déplacement renommage de l'image
				$reussi_upload = "Votre fichier à été transféré";
			}		
		}
		else 
		{ 
			$erreur_upload ="Votre fichier n'est pas une image"; 
		}
		
	}
	else
	{ 
		echo "Votre image doit faire au maximum 5Mo"; 
	}

}

if(isset($erreur_upload))
{
	echo $erreur_upload; // Si erreur lors de l'upload affiche, on affiche l'affiche
}
if(isset($reussi_upload))
{
	echo $reussi_upload;
}
