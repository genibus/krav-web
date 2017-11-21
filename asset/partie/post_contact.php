<?php
session_start();
require_once('../../admin/asset/lib/constants.php');
require_once('reCaptcha/autoload.php');
// création d'un tableau vide, pour vérifier si il y a des erreurs
$errors = [];

if(!empty($_POST))
{
	$recaptcha = new \ReCaptcha\ReCaptcha('6LcAXzYUAAAAACEE0J3A1XNH323VduFh9-N6jVZv');
	$resp = $recaptcha->verify($_POST['g-recaptcha-response']);
	if ($resp->isSuccess()) 
	{
	   if(isset($_POST['g-recaptcha-response']))
		{
			// condition dans le cas ou l'un des champs du formulaire est vide ->''
			if(!array_key_exists('name', $_POST) || $_POST['name'] == '')
			{
				$errors['name'] = "Merci de renseignez votre nom et prénom";
			}
			if(!array_key_exists('email', $_POST) || $_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
			// filter_var avec en second paramètre FILTER_VALIDATE_EMAIL est une fonction prédéfini de PHP qui permet de vérifié l'intégrité de la variable $_POST['email']
			{
				$errors['email'] = "Votre adresse email n'est pas valide";
			}
			if(!array_key_exists('sujet', $_POST) || $_POST['sujet'] == '')
			{
				$errors['sujet'] = "Merci d'indiquer le sujet de votre message";
			}
			if(!array_key_exists('message', $_POST) || $_POST['message'] == '')
			{
				$errors['message'] = "Le contenu de votre message est vide";
			}
			// si il y a une erreur, on renvoie vers la page contact.php
			if(!empty($errors))
			{
				$_SESSION['errors'] = $errors;	
				$_SESSION['inputs'] = $_POST;	
				header('Location:../../index.php');
				die();
			}
			else
			{
				$_SESSION['sent_mail'] = 1;
				// récupération du contenu du message dans une variable
				$message = $_POST['message'];
				$to = 'tgenibus@gmail.com';
				$name = htmlspecialchars($_POST['name']);
				$subject = htmlspecialchars($_POST['sujet']);
				$email =  $_POST['email'];
				$message =  htmlspecialchars($_POST['message']);
				// Ajout d'un en-tête dans l'email
				$headers = 'De : ' . $email . "\r\n";
				mail($to, $subject, $message, $headers);
				header('Refresh:3;url=../../index.php');
				echo '<div class="msgSent">Votre message a bien été envoyé, vous allez être redirigé sur le site, merci de patienter</div>';
			}	
		}
	} 
	else
	{
		header('Location:../../index.php');
		die();
	}
}