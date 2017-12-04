<?php
session_start();
require_once('reCaptcha/autoload.php');
// création d'un tableau vide, pour vérifier si il y a des erreurs
$errors = [];

if(!empty($_POST))
{
	// Secret Key
	$recaptcha = new \ReCaptcha\ReCaptcha('6LfOXCYUAAAAALUmcAN9hcJEZhwpwaqDID0rnACI');
	$resp = $recaptcha->verify($_POST['g-recaptcha-response']);
	if ($resp->isSuccess()){
	   if(isset($_POST['g-recaptcha-response'])){
			// condition dans le cas ou l'un des champs du formulaire est vide ->''
			if(!array_key_exists('name', $_POST) || $_POST['name'] == ''){
				$errors['name'] = "Merci de renseignez votre nom et prénom";
			}
			if(!array_key_exists('email', $_POST) || $_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){// filter_var avec en second paramètre FILTER_VALIDATE_EMAIL est une fonction prédéfini de PHP qui permet de vérifié l'intégrité de la variable $_POST['email']
				$errors['email'] = "Votre adresse email n'est pas valide";
			}
			if(!array_key_exists('message', $_POST) || $_POST['message'] == ''){
				$errors['message'] = "Le contenu de votre message est vide";
			}
			// si il y a une erreur, on renvoie vers la page contact.php
			if(!empty($errors)){
				$_SESSION['errors'] = $errors;	
				$_SESSION['inputs'] = $_POST;
				header('Location:../../contact.php');
				die();
			}else{
				$_SESSION['sent_mail'] = 1;
				// récupération du contenu du message dans une variable
				$message = $_POST['message'];
				$to = 'tgenibus@gmail.com';
				$name = htmlspecialchars($_POST['name']);
				$email =  $_POST['email'];
				$message =  htmlspecialchars($_POST['message']);
				// Ajout d'un en-tête dans l'email
				$headers = 'De : ' . $email . "\r\n";
				mail($to, $message, $headers);
				header('Location:../../');
				setFlash('Votre message a bien été envoyé, vous allez recevoir une confirmation sur l\'adresse mail que vous avez renseigné', 'info');
				die();
			}	
		}
	}else{
		header('Location:../../index.php');
		die();
	}
}