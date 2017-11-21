<?php 
include_once 'asset/lib/include.php';

// Ajout de la pagination
$ajout_btn = '';
$countArticle = $db->query('SELECT COUNT(id_work) as nbArticle FROM works');
$fetchArticle = $countArticle->fetch();
$nbArticle = $fetchArticle['nbArticle'];
$perPage = 10;
$nbPage = ceil($nbArticle/$perPage);
$startPage = 1;
if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p']<=$nbPage)
{
	$startPage = $_GET['p'];
}
else
{
	$startPage = 1;
}
$liste_categorie = $db->query("SELECT * FROM works LEFT JOIN categories ON works.id_category = categories.id_category ORDER BY id_work DESC LIMIT " .(($startPage-1)*$perPage).",$perPage");
$affiche_categorie = $liste_categorie->fetchAll();




if($_POST) // Si le formulaire est validé
{
	$nom = $_POST['work_name'];
	$url = $_POST['work_url'];
	$contenu = $_POST['content'];
	$categorie = $_POST['category'];
	
		// si l'un des champs est vide 
	if(empty($nom) || empty($url) || empty($contenu)) // on affiche un message d'erreur
	{
		setFlash('Erreur de saisie, tous les champs doivent être remplis pour ajouter un article', 'orange');
		header('Location:index.php');
		die();
	}	

}
// TRAITEMENT POUR SUPPRIMER UN ARTICLE
if(isset($_GET['supprimer']))
{
	$id_work = $_GET['supprimer'];
	$requete_suppression = $db->prepare("DELETE FROM works WHERE id_work = :id_work");
	$requete_suppression->bindParam(':id_work', $id_work);
	$requete_suppression->execute() or die(print_r($db->errorInfo()));
	header('Location:index.php');
	die();
}

// On inclut le fichier header.php
include_once 'asset/part/header.php'; ?>
<div class="container">
<div>	
	<h1>Gestion de vos articles</h1>
	<a href="article_create.php" class="waves-effect waves-light btn green accent-3">Ajouter un article</a>
</div>



	<div class="row">
		<table class="highlight bordered">
			<!-- début tableau affichage des articles -->
				<tr>
					<th>ID article</th>
					<th>ID catégorie</th>
					<th>Nom de la catégorie</th>
					<th>Nom article</th>
					<th>Url</th>
					<th>Contenu de l'article</th>
					<th>Meta description</th>					
				</tr>	
			<?php foreach($affiche_categorie as $ligne_articles):?><!-- on affiche toutes les données de la table articles -->
				<tr>		
					<td><?= $ligne_articles['id_work']; ?></td>
					<td><?= $ligne_articles['id_category']; ?></td>
					<td><?= $ligne_articles['category_name']; ?></td>
					<td><?= $ligne_articles['work_name']; ?></td>
					<td><?= $ligne_articles['work_url']; ?></td>
					<td><?= htmlspecialchars(substr($ligne_articles['content'], 0, 50)); ?></td>
					<td><?= htmlspecialchars(substr($ligne_articles['meta_description'], 0, 50)); ?></td>
					<!-- Le "?" dans le href ci-dessous permet de récupérer 'supprimer' avec la méthode GET-->
					<td><a href="article_edit.php?modifier=<?= $ligne_articles['id_work']; ?>" class="waves-effect waves-light btn deep-orange lighten">Modifier</a></td>
					<td><a href="?supprimer=<?= $ligne_articles['id_work']; ?>" class="waves-effect waves-light btn red accent-4" onclick="return confirm('Êtes vous sur de bien vouloir supprimer cet article?')">Supprimer</a></td>
				</tr>	
			<?php endforeach ;?>
			<!-- fin tableau affichage articles -->
		</table>
			<ul class="pagination center ">
<?php 
	for($i = 1 ; $i <= $nbPage ; $i++ )
	{
		if($i == $startPage)
		{
			echo " <li class='waves-effect blue-grey'><a>$i</a></li>";
		}
		else
		{
			echo "<li class='waves-effect blue-grey'><a href='index.php?p=$i' class='white-text'>$i</a>";
		}
	}

?>
 </ul>
	</div>

</div>
	<?php
	include_once 'asset/part/footer_article.php'; 
