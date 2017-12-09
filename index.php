<?php
require_once 'admin/asset/lib/db.php';
require_once 'admin/asset/lib/functions.php';

$req_category = $db->query("SELECT * FROM categories");
$result_category = $req_category->fetchAll();

if(isset($_GET['filter'])){
	$id_cat = $_GET['filter'];
	$category_filtered = $db->query("SELECT * FROM categories WHERE id_category = $id_cat");
	$category_count = $category_filtered->rowCount();
	if($category_count == null ){
		header('Location:index.php#portfolio');
		die();
	}else{
		$req_articles = $db->query("SELECT * FROM works LEFT JOIN images ON works.id_work = images.id_work WHERE id_category = $id_cat");
		$result_articles = $req_articles->fetchAll();
	}
}else{
	$req_articles = $db->query('SELECT * FROM works LEFT JOIN images ON works.id_work = images.id_work');
	$result_articles = $req_articles->fetchAll();
}
include 'asset/partie/header_meta.php';
$title = "Designer Web Freelance";
$description = "Web design, Paris et Île de France, refonte de site, création de logo ou de charte graphique et référencements.";
include 'asset/partie/header.php';
?>

<section class="bg-dark py-5" style="position: relative; min-height:100vh; width:100%;">
	<article class="container">
		<div class="d-flex flex-column text-light" style="height: 670px;">
			<div class="text-center my-auto">
				<h1 class="display-4 mb-3">Ensemble poussons vos projets au maximum de leurs capacités</h1>
				<img src="asset/img/logo-krav.png" class="img-fluid mb-3" alt="logo graphiste web" style="max-width: 30%">
				<h2>Designer</h2>
				<a href="#portfolio" class="btn btn-outline-primary font-weight-bold mt-3">Voir mes créations</a>
			</div>
		</div>
	<article>
</section>
<section class="bg-dark">
	<article class="container">
		<div class="row text-center text-light py-4">
			<div class="col-12 col-md-4">
				<img src="asset/img/graphic-design.png" alt="design" class="mb-2">
				<h2 class="h3">Ergonomie</h2>
				<p>Définissons ensemble une identité visuelle qui vous ressemble.</p>
			</div>
			<div class="col-12 col-md-4">
				<img src="asset/img/vector.png" alt="sketching" class="mb-2">
				<h2 class="h3">Précision</h2>
				<p>Mettez en avant vos évenements ou votre entreprise.</p>
			</div>
			<div class="col-12 col-md-4">
				<img src="asset/img/rocket.png" alt="palette" class="mb-2">
				<h2 class="h3">Optimisation</h2>
				<p>Nous travaillons aussi bien en ligne qu'en impression.</p>
			</div>
		</div>
	</article>
</section>
<section class="bg-light" id="portfolio">
	<article class="container py-5">
		<div class="row justify-content-center py-2">
			<div class="col-12 text-center">
				<?php foreach($result_category as $category) : ?>
					<a href="?filter=<?= $category['id_category']; ?>#portfolio" class="p-2"><?= $category['category_name']; ?></a>
				<?php endforeach; ?>
				<a href="?#portfolio" class="p-2">Voir tous les articles</a>
			</div>
		</div>
		<div class="row py-3">
			<div class="col-12">
				<h1 class="text-center">My work</h1>
			</div>
		</div>
		<?php foreach($result_articles as $article) :?>
		<div class="row justify-content-center">
			<div class="col-12 col-md-10">
			<a href="view.php?slug=<?= $article['work_url']?>"> <!--LIEN VERS LA VUE -->
					<div class="card mb-4">
						<div class="card-body" style="background: url('asset/img/imageUpload/<?= $article['nom_image'] ?>')"> <!-- URL DE L'IMAGE LIE A L'ARTICLE -->
							<h2 class="text-center"><?=  $article['work_name'];?></h2>
						</div>
					</div>
				</div>
				</a>
			</div>
		</div>
		<?php endforeach; ?>
	</article>
</section>
<section class="container-fluid">
	<div class="row">
	<article class="col-12 col-md-7 p-5">
		<h2>Qui suis-je ?</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore consequuntur modi expedita ut ratione mollitia minus, perferendis beatae ipsa tenetur! Est mollitia quibusdam autem sit magnam, nesciunt nulla, nostrum magni molestias iure explicabo optio suscipit et, veritatis quo ipsum temporibus?</p>
		<a href="#" class="btn btn-outline-primary">En savoir plus</a>
	</article>
	<article class="col-12 col-md bg-primary">
		<h2 class="text-light">Random image</h2>
	</article>
	</div>
</section>

<?php
include 'asset/partie/footer.php';
?>
