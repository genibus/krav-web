<?php
session_start();
if(!isset($auth))
{
	if(!isset($_SESSION['auth']))
	{
		header('Location:login.php');
	}

}
