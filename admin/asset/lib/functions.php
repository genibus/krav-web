<?php

function baliseForm($id, $nomLabel, $balise, $type = "")
{
	//Si la condition est définie tu affiche $_POST['$id'] sinon rien...
	$value = isset($_POST[$id]) ? $_POST[$id] : '';	
	if($balise == 'textarea')
	{		
		return "<label for='$id'>$nomLabel</label>
				<textarea name='$id' id='$id' class='form-control'>$value</textarea>";	
	}
	elseif($balise == 'input')
	{		
		return "<label for='$id'>$nomLabel</label>
				<input type='$type' name='$id' id='$id' value='$value' class='form-control'>";	
	}
}

function flash()
{
	if(isset($_SESSION['flash']))
	{
		extract($_SESSION['flash']);
		unset($_SESSION['flash']);
		return "<div class='alert alert-$color'><p>$msg</p></div>";
	}
}

function setFlash($msg, $color = '')
{
	$_SESSION['flash']['msg'] = $msg;
	$_SESSION['flash']['color'] = $color;
}

function verification_extension_photo() 
{
	$extension = strrchr($_FILES['photo']['name'], '.'); // cette fonction prédéfinie permet de remonter une chaine en partant de la fin du fichier. Dès que la fonction trouve le caractère fourni en 2 eme argument ici le '.' cette fonction coupe la chaine et nous renvoie tout à partir du '.'
	
	$extension = strtolower($extension); // on transforme la chaine de caractère en minuscule au cas où il y aurait des majuscules.
	
	$extension = substr($extension, 1); // avec substr on coupe la chaine de caractère en enlevant le '.'
	
	$tableau_extension_valide = array('jpg', 'jpeg', 'png', 'gif');
	// on crée un tableau contenant les extensions autorisées
	
	$verif_extension = in_array($extension, $tableau_extension_valide); // in_array() vérifie si la valeur fournie en 1er argument se trouve dans une des valeurs d'un tableau array fourni en 2eme argument.
	// valeur de retour => true ou false
	
	return $verif_extension; // on renvoi donc true ou false
	
}