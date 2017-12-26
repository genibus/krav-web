<?php
require_once 'admin/asset/lib/db.php';
if(isset($_GET['slug'])){
$slug = $db->quote($_GET['slug']);
$req = $db->query("SELECT * FROM works
					LEFT JOIN images ON images.id_work = works.id_work
					WHERE work_url=$slug");
$requete_article = $req->fetchAll();
	if($req->rowCount()==0){
		header('location:index.php#portfolio');
		die();
	}
}
include 'asset/partie/header_meta.php';
foreach ($requete_article as $article):
$title = $article['work_name'];
$description = $article['meta_description'];
endforeach;
include 'asset/partie/header.php';
?>
<section class="bg-light">
	<?php foreach ($requete_article as $article): ?>
		<div class="" style="background-image: url(<?= RACINE ?>asset/img/upload/<?= $article['nom_image']; ?>); background-size: cover; background-position:center; height:500px;"></div>
		<article class="container bg-white py-5">
			<?= $article['content']; ?>
		</article>
	<?php endforeach; ?>
</section>
<?php
include 'asset/partie/footer.php';
