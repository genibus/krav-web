<?php 
session_start();
session_destroy();
echo 	"<p> Vous vous êtes déconnecter</p>";
header('Location:../index.php');
die();