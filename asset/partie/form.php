<section class="bg-light py-5">
	<article class="container">
		<!-- <i class="fa fa-times fa-2x close-contact" aria-hidden="true"></i> -->
		<form action="<?= RACINE ?>asset/partie/post_contact.php" method="POST">
			<input type="text" name="name" id="input_last_name" class="form-control mb-3" value="<?= isset($_SESSION['inputs']['name']) ? $_SESSION['inputs']['name'] : ''; ?>" placeholder="Nom et Prénom" required>
			<input type="email" name="email" id="input_mail" class="form-control mb-3" value="<?= isset($_SESSION['inputs']['email']) ? $_SESSION['inputs']['email'] : ''; ?>" placeholder="Email" required>
			<input type="text" name="sujet" class="form-control mb-3" value="<?= isset($_SESSION['inputs']['sujet']) ? $_SESSION['inputs']['sujet'] : ''; ?>" placeholder="Sujet" required>
			<textarea name="message" id="input_message" rows="3" class="form-control" placeholder="Votre message" required><?= isset($_SESSION['inputs']['message']) ? $_SESSION['inputs']['message'] : '' ;?></textarea>
			<!-- Notre boite de vérification -->
			<div class="content-captcha">
		    <div class="g-recaptcha" data-theme="dark" data-callback="recaptchaCallback" data-sitekey="6LcAXzYUAAAAAI3TaMRyoGCFY1WOeSYQt-E1Zd2c" data-size="compact"></div>
	    </div>
			<input type="submit" class="btn btn-primary" class="send" value="Envoyer" disabled>
		</form>
	</article>
</section>
<?php
		unset($_SESSION['inputs']);
		unset($_SESSION['errors']);
		unset($_SESSION['sent_mail']);
?>
