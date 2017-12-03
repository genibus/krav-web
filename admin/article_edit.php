<?php 
include_once 'asset/lib/include.php';
if($_POST){ // Si le formulaire est validé
	$nom = $_POST['work_name'];
	$url = $_POST['work_url'];
	$contenu = $_POST['content'];
	$meta_description = $_POST['meta_description'];
	$categorie = $_POST['category'];
	
		// TRAITEMENT POUR MODIFIER UNE CATEGORIE
	if(isset($_GET['modifier'])){
		// si l'un des champs est vide 
		if(empty($nom) || empty($url) || empty($contenu)){ // on affiche un message d'erreur
			setFlash('Erreur de saisie, tous les champs doivent être remplis pour ajouter un article', 'danger');
			header('Location:article_edit.php');
			die();
		}

		$id_work = $_GET['modifier'];
		$requete_modifier = $db->prepare("UPDATE works SET work_name = :work_name, work_url = :work_url, content = :content, meta_description = :meta_description,  id_category = :id_category WHERE id_work = :id_work");
		$requete_modifier->bindParam(':id_work', $id_work, PDO::PARAM_INT);
		$requete_modifier->bindParam(':work_name', $nom, PDO::PARAM_STR);
		$requete_modifier->bindParam(':work_url', $url, PDO::PARAM_STR);
		$requete_modifier->bindParam(':content', $contenu, PDO::PARAM_STR);	
		$requete_modifier->bindParam(':meta_description', $meta_description, PDO::PARAM_STR);	
		$requete_modifier->bindParam(':id_category', $categorie, PDO::PARAM_INT);
		$db->beginTransaction();			
		$requete_modifier->execute() or die(print_r($db->errorInfo()));
			// insertion du traitement de la modification de l'image
		include_once 'asset/lib/upload_file.php';		
		$db->commit();
		header('Location:index.php');
		setFlash('L\'article a été modifiée', 'info');
		die();
	}

}
// requete SELECT vers la table works joint avec la table images pour récupérer les informations en base de données
$id_work = $_GET['modifier'];
$select_articles = $db->prepare("SELECT * FROM works LEFT OUTER JOIN images ON works.id_work = images.id_work WHERE works.id_work = $id_work");
$select_articles->execute();	
$_POST = $select_articles->fetch();
$select_articles->closeCursor();
$articles = $select_articles->fetchAll();
// requete SELECT vers la table categories pour récupérer les informations en base de données
$requete = $db->query('SELECT * FROM categories ORDER BY category_name');
$requete_categorie = $requete->fetchAll();

if($select_articles->rowCount() == 0){
	setFlash('L\'url saisie n\'existe pas', 'warning');
	header('Location:article_edit.php');
	die();
}

// title et description
$title = "titre";
$description = "description";

// On inclut le fichier header.php
	include_once 'asset/part/header.php'; ?>
			<h1 class="text-center">Gestion de vos articles</h1>			
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<?= baliseForm('work_name', 'Nom de l\'article', 'input', 'text');?>
					</div>
					<div class="form-group">
						<label for="category">Nom catégorie</label>
						<select name="category" class="form-control" id="category" value="" selected="">
							<option value="" disabled selected>Choisissez la catégorie</option>
							<?php
							foreach($requete_categorie as $nom_categorie):
								$selected = '';
							
							if($nom_categorie['id_category'] == $_POST['id_category']){
								$selected = 'selected ="selected"';
							}
							?>
							<!-- On récupère la variable définit au début de la page pour ajouter la value et le contenu de la balise option de façon dynamique -->
							<option value="<?= $nom_categorie['id_category']; ?>" <?= $selected ;?> > <?= $nom_categorie['category_name'];?></option>
						<?php endforeach ;?>
						</select>
					</div>

									<!-- Récupération de la fonction input 			
									on ajoute chaque donnée dans l'input -->
					<div class="form-group">
							<?= baliseForm('work_url', 'Url de l\'article', 'input', 'text'); ?>
					</div>

					<div class="form-group">
							<?= baliseForm('content', 'Contenu de l\'article', 'textarea'); ?>
					</div>

					<div class="form-group">
							<?= baliseForm('meta_description', 'Contenu de la balise meta description de l\'article','input', 'text'); ?>
					</div> 
					<div class="row mt-5 mb-5">	
						<div class="col-4">
							<div class="form-group">		
									<img src="../asset/img/imageUpload/<?=$_POST['nom_image']; ?>" alt="<?=$_POST['alt']; ?>" width="100%" class="img-upload">						
							</div>	
						</div>		
						<div class="col-8">							
							<div class="form-group">
								<span>Upload d'image</span>
								<input type="file" name="image">
							</div>
							<div class="form-group">
								<input class="form-control" type="text" value="<?= $_POST['nom_image'];?>">
							</div>
							<div class="form-group">
								<?= baliseForm('alt', 'descriptif de l\'image', 'input', 'text'); ?>
							</div>

							</div>
					</div>
					<div class="row mt-5 mb-5">
						<div class="col-6">							
							<a href="index.php" class="btn btn-primary btn-lg btn-block">Retour aux articles</a>
						</div>
						<div class="col-6">							
							<input type="submit" value="Valider" class="btn btn-success btn-lg btn-block">
						</div>
					</div>

				</form>
		</main>
	</div>
</div>
<?php include_once 'asset/part/footer_article.php';