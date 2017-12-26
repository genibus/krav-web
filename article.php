<?php 
require_once 'admin/asset/lib/db.php';
include 'asset/partie/header_meta.php';
$title = "Krav Webdesigner: Mes créations web et print";
$description = "Mes articles par catégories, consulter l'ensemble de mes projets en ligne, contactez-moi pour de plus amples informations";
include 'asset/partie/header.php';
$req = $db->query('SELECT * FROM works LEFT JOIN images ON works.id_work = images.id_work');
$requete_article = $req->fetchAll();
?>
<!-- Slideshow 4 -->
<article id="intro-work">
  <h1 class="txtcenter">Mes projets</h1>
  <h2 class="txtcenter">Découvrez l'ensemble de mes réalisations, logo, charte graphique et design d'interface</h2>  
</article>
<div class="flex-container grid-2 gallery">
<?php foreach ($requete_article as $article):?>
	<article class="container-article" style="background-image: url(asset/img/upload/<?= $article['nom_image']; ?>)">
		<a href="realisation/<?= $article['work_url']; ?>">
		<div class="overlay">
		    	<h3 class="txtcenter"> <?= $article['work_name'] ;?> </h3>
	    </div>
	    </a>
	</article>
<?php endforeach; ?>
</div>

<?php
include 'asset/partie/form.php';
include 'asset/partie/footer.php';