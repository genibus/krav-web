<?php 
require_once 'admin/asset/lib/db.php';
if(isset($_GET['slug'])){
$slug = $db->quote($_GET['slug']);
$req = $db->query("SELECT * FROM works 
					LEFT JOIN images ON images.id_work = works.id_work
					WHERE work_url=$slug");
$requete_article = $req->fetchAll();
if($req->rowCount()==0){
	header('location:article.php');
	die();
}

}else{
	header('location:article.php');
	die();
}
include 'asset/partie/header_meta.php';
foreach ($requete_article as $article):
$title = $article['work_name'];
$description = $article['meta_description'];
include 'asset/partie/header.php';
?>
<section class="main-contenu">
<article id="my-work" style="background-image: url(<?= RACINE ?>asset/img/imageUpload/<?= $article['nom_image']; ?>);">
</article>
	<article class="contenu-article">
			<div class="container">
			    <?= $article['content']; ?>   
			</div>
	</article>
<?php endforeach; ?>
</section>
<?php 
include 'asset/partie/form.php';
include 'asset/partie/footer.php';