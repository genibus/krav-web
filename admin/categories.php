<?php include_once 'asset/lib/include.php';

$liste_categories = $db->query('SELECT * FROM categories');
if($_POST) // Si le formulaire est validé
{
	$name = htmlspecialchars($_POST['category_name']);
	$url = htmlspecialchars($_POST['category_url']);	
		// si l'un des deux champs est vide 
	if(empty($name) || (empty($url))) // on affiche un message d'erreur selon le champ vide
	{
		setFlash('Erreur de saisie, tous les champs doivent être remplis pour ajouter une catégorie', 'red');
		header('Location:categories.php');
		die();
	}
	else
	{
			// TRAITEMENT POUR MODIFIER UNE CATEGORIE
		if(isset($_GET['modifier']))
		{
			$id_category = $_GET['modifier'];
			$requete_modifier = $db->prepare("UPDATE categories SET category_name = :category_name, category_url = :category_url WHERE id_category = :id_category");
			$requete_modifier->bindParam(':id_category', $id_category, PDO::PARAM_INT);
			$requete_modifier->bindParam(':category_name', $name, PDO::PARAM_STR);
			$requete_modifier->bindParam(':category_url', $url, PDO::PARAM_STR);
			$requete_modifier->execute() or die(print_r($db->errorInfo()));
			header('Location:categories.php?afficher');		
			setFlash('La catégorie a été modifiée', 'blue lighten-2');
			die();	

		}
		else
		{	
			// TRAITEMENT POUR AJOUTER UNE CATEGORIE
			// on ajoute les données dans la table categories			
			$req = $db->prepare('INSERT INTO categories SET category_name = :category_name, category_url = :category_url'); 
			$req->bindParam(':category_name', $name, PDO::PARAM_STR); // les élements suivants
			$req->bindParam(':category_url', $url, PDO::PARAM_STR);
			$req->execute() or die(print_r($db->errorInfo()));
			header('Location:categories.php?afficher');	
			setFlash('La catégorie <b>' . $name . '</b> a été ajoutée', 'green');	
			die();					
		}
		
	}				
}



//  Traitement modification href et class de la balise <a>
if(!isset($_GET['afficher']))
{
	$affiche_btn = '<a href="?afficher">Afficher les catégories</a>';
}
else
{
	$affiche_btn ='<a href="categories.php">Masquer les catégories</a>';
}

// TRAITEMENT POUR AFFICHER LA CATEGORIE A MODIFIER DANS LES CHAMPS INPUT
if(isset($_GET['modifier']))
{

	$id_category = $_GET['modifier'];
	$categories_modifier = $db->query("SELECT * FROM categories WHERE id_category = $id_category");
	// Si la catégorie est null	
	if($categories_modifier->rowCount() == null)
	{
		setFlash('Oups, une erreur s\'est produite, l\'url saisie est incorrecte', 'red');
		header('Location:categories.php');
		die();
	}

	$_POST = $categories_modifier->fetch();
	$ajout_btn = '<input type="submit" value="Valider" class="waves-effect waves-light btn green accent-3">';

}
else
{
	$ajout_btn = '<input type="submit" value="Ajouter une catégorie" class="waves-effect waves-light btn green accent-3">';
}	


// TRAITEMENT POUR SUPPRIMER UNE CATEGORIE
if(isset($_GET['supprimer']))
{
	$id_category = $_GET['supprimer'];
	$requete_suppression = $db->prepare("DELETE FROM categories WHERE id_category = :id_category");
	$requete_suppression->bindParam(':id_category', $id_category);
	$requete_suppression->execute() or die(print_r($db->errorInfo()));	
	setFlash('La catégorie ' . $name . ' a bien été supprimée' , 'blue');
	header('Location:categories.php?afficher');
	die();
}
// On inclut le fichier header.php
include_once 'asset/part/header.php'; ?> 

<div class="container">
<h1> Gestion des catégories</h1>
	<form action="" method="post" class="col s12">
		<div class="row">
			<div class="input-field col s12">
				<?= baliseForm('category_name', 'Nom de la catégorie', 'input', 'text');?>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">			
			<?= baliseForm('category_url', 'Nom de l\'URL', 'input', 'text');?>
			</div>
		</div>
		<?= $ajout_btn; ?>
	</form>


	<?php
// TRAITEMENT POUR AFFICHER CATEGORIES
 // récupération en db
	$affiche_categories = $liste_categories->fetchAll(); 
	?>
	<div>		
		<table class="highlight bordered">
			<!-- début tableau affichage catégories -->
			<tr>
				<th>ID de la catégorie</th>
				<th>Nom de la catégorie</th>
				<th>Nom de l'url de la catégorie</th>
			</tr>
			<?php foreach($affiche_categories as $ligne_categories):?>
				<!-- on affiche toutes les données de la table catégories -->
				<tr>		
					<td><?= $ligne_categories['id_category']; ?></td>
					<td><?= $ligne_categories['category_name']; ?></td>
					<td><?= $ligne_categories['category_url']; ?></td>
					<td><a href="?modifier=<?= $ligne_categories['id_category']; ?>" class="waves-effect waves-light btn deep-orange lighten" >modifier</a></td>
					<td><a href="?supprimer=<?= $ligne_categories['id_category']; ?>" class="waves-effect waves-light btn red accent-4" onclick="return confirm('Voulez-vous supprimer cette catégorie?')">Supprimer</a></td>	
				</tr>

			<?php endforeach ;
		?>
	</table>
</div>	
</div>

<!-- fin tableau affichage catégories -->
<?php
include_once 'asset/part/footer.php'; 
