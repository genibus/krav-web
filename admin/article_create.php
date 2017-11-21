<?php 
include_once 'asset/lib/include.php';

$ajout_btn = '<input type="submit" value="Ajouter un article" class="waves-effect waves-light btn green accent-3">';

// requete SELECT vers la table categories pour récupérer les informations en base de données
$requete_categorie = $db->query('SELECT * FROM categories');

if($_POST) // Si le formulaire est valide
{
	$nom = $_POST['work_name'];
	$url = $_POST['work_url'];
	$contenu = $_POST['content'];
	$meta_description = $_POST['meta_description'];
	$categorie = $_POST['category'];
	
		// si l'un des champs est vide 
	if(empty($nom) || empty($url) || empty($contenu)) // on affiche un message d'erreur
	{
		setFlash('Erreur de saisie, tous les champs doivent être remplis pour ajouter un article', 'red');
		header('Location:article_create.php');
		die();
	}
			// TRAITEMENT POUR AJOUTER UN ARTICLE
			// on ajoute les données dans la table works

	$req = $db->prepare('INSERT INTO works SET work_name = :work_name, work_url = :work_url, content = :content , meta_description = :meta_description,  id_category = :id_category');
		// les élements suivants
	$req->bindParam(':work_name', $nom, PDO::PARAM_STR); 
	$req->bindParam(':work_url', $url, PDO::PARAM_STR);
	$req->bindParam(':content', $contenu, PDO::PARAM_STR);
	$req->bindParam(':meta_description', $meta_description, PDO::PARAM_STR);
	$req->bindParam(':id_category', $categorie, PDO::PARAM_INT);
	$db->beginTransaction();
	if(!empty($_FILES['image']['tmp_name'])) 
	{ 
		$req->execute() or die(print_r($db->errorInfo()));			
		$id_work = $db->lastInsertId();
		// insertion du traitement de l'ajout de l'image
		include_once 'asset/lib/upload_file.php';
		$db->commit();
		header('Location:index.php');	
		setFlash('L\'article <b>' . $nom . '</b> a été ajoutée', 'green');
		die();
	}
	else
	{
		header('Location:article_create.php');	
		setFlash('Une image est obligatoire pour ajouter un article', 'orange');
		die();
	}		
}

// On inclut le fichier header.php
include_once 'asset/part/header.php'; ?> 
<div class="container">
	<h1>Gestion de vos articles</h1>


	<!-- Affichage du formulaire -->		
	<form action="" method="post" enctype="multipart/form-data" class="col s12">

		<div class="row">
			<div class="input-field col s12">	
				<?= baliseForm('work_name', 'Nom de l\'article', 'input', 'text');?>
			</div>
		</div>
		<div class="row">
			<label for="category">Nom catégorie</label>

			<select name="category" class='browser-default' id="category" value="" selected="">
			<option value="" disabled selected>Choisissez la catégorie</option>
				<?php 
				foreach($requete_categorie as $nom_categorie): ?>
				<!-- On récupère la variable définit au début de la page pour ajouter la value et le contenu de la balise option de façon dynamique -->
				<option value="<?= $nom_categorie['id_category']; ?>"> <?= $nom_categorie['category_name']; ?> </option>
			<?php endforeach ;?>
		</select>
	</div>

	<!-- Récupération de la fonction baliseForm -->
	<div class="row">
		<div class="input-field col s12">
			<?= baliseForm('work_url', 'Url de l\'article', 'input', 'text'); ?>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<?= baliseForm('content', 'Contenu de l\'article', 'textarea'); ?>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<?= baliseForm('meta_description', 'meta description de l\'article', 'input', 'text'); ?>
		</div>
	</div>

	<div class="file-field input-field">
		<div class="btn waves-effect waves-light btn orange accent-5">
			<span>Upload d'image</span>
			<input type="file" name="image">
			
		</div>
	</div>
	
	<div class="row">
		<div class="input-field col s12">
			<?= baliseForm('alt', 'descriptif de l\'image', 'input', 'text'); ?>
		</div>
	</div>

	<div class="row">
		<div class="input-field col s12">
			<?= $ajout_btn; ?>
		</div>
	</div>
</form>
</div>	
<?php include_once 'asset/part/footer_article.php'; 
