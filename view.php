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
<section class="bg-dark py-5">
</section>
<section class="bg-light">
	<article class="container py-5">
		<div class="row justify-content-center py-2">
		<div class="col-12 text-center">	
		<?php foreach ($requete_article as $article): ?>
			<div class="card-body" style="background-image: url(<?= RACINE ?>asset/img/upload/<?= $article['nom_image']; ?>);"></div>
			<article class="row justify-content-center">
				<div class="col-12 col-md-10">
					<?= $article['content']; ?>   
				</div>
			</article>
		</div>
<?php endforeach; ?>
	</article>
</section>
<?php 
include 'asset/partie/footer.php';