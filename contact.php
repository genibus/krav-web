<?php
include 'asset/partie/header_meta.php';
$title = "Designer Web Freelance";
$description = "Web design, Paris et Île de France, refonte de site, création de logo ou de charte graphique et référencements.";
include 'asset/partie/header.php'; ?>

<section class="bg-dark text-light py-5">
	<article class="container py-5">
		<div class="row justify-content-center">
			<div class="col-12 col-md-7">
				<h2 class="display-4 font-weight-bold mb-4">Besoin d'un designer pour votre site web ?</h2>
				<p class="h4 mb-4">Pas de problème je réponds à toutes vos questions !</p>
				<!-- <i class="fa fa-times fa-2x close-contact" aria-hidden="true"></i> -->
				<!-- start form -->
				<form action="<?= RACINE ?>asset/partie/post_contact.php" method="POST">
					<input type="text" name="name" id="input_last_name" class="form-control mb-3" value="<?= isset($_SESSION['inputs']['name']) ? $_SESSION['inputs']['name'] : ''; ?>" placeholder="Nom" required>
					<input type="email" name="email" id="input_mail" class="form-control mb-3" value="<?= isset($_SESSION['inputs']['email']) ? $_SESSION['inputs']['email'] : ''; ?>" placeholder="Email" required>
					<textarea name="message" id="input_message" rows="3" class="form-control" placeholder="Votre message" required><?= isset($_SESSION['inputs']['message']) ? $_SESSION['inputs']['message'] : '' ;?></textarea>
					<!-- Notre boite de vérification -->
					<div class="content-captcha">
						<!-- Site key -->
						<div class="g-recaptcha col-6 mx-auto pt-3" data-theme="dark" data-callback="recaptchaCallback" data-sitekey="6LfOXCYUAAAAAAqXCWmQPWJL9xezoLpPF-TVjEhu"></div>
					</div>
					<input type="submit" id="submitBtn" class="btn btn-block btn-primary mt-3" value="Envoyer" disabled>
				</form>
				<!-- end form -->
			</div>
		</div>
		<div class="row pt-3">
      <div class="col-12 text-center">
        <a href="<?= RACINE ?>" >Retour à la page d'accueil</a>
   		</div>
		</div>
	</article>
</section>
<style media="screen">
	body {
		background-color: #343a40;
	}
</style>
<script src='asset/js/app.js'></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
<?php
unset($_SESSION['inputs']);
unset($_SESSION['errors']);
unset($_SESSION['sent_mail']);
