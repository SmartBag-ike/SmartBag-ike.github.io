	<!doctype html>
<head>
<link rel="stylesheet" type="text/css" href="contacter-form.css"/>
<link rel="icon" href="logo1.png" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=0.9">
<meta name="description" content="SmartBag-ike est un projet innovant conçu par un groupe de 3 étudiants en fillière STI2D de 2019-2020">
<meta name="keywords" content="Smart, bag, innovative, technology, sti2d, projet tech, informatique, it"> 
<title>Contactez nous</title>
</head>
	<body class="formulaire">
	<header>
	<nav>
			<ul id="menus">	
			<img id="fond-header" src="header web.png" width="1880" height="170"/>
			<a href="index.html">
			<img id="icone-home" src="home_button.png" onmouseover="this.src='home_button_animatedaf.png'" onmouseout="this.src='home_button.png'"/>
					<ul>
						<a href="presentation.html"><div class="nav-menu" id="carre1">Présentation</div></a>  
						<a href="details.html"><div class="nav-menu" id="carre2">Détails/Modèles</div></a> 
						 <a href="choix.html"><div class="nav-menu" id="carre3">Choix</div></a>
					</ul>
			</ul>
	</nav>
	</header>
	<form id="page-contact" method="post" action="contacter-form.php">
	<div class="carrebleutext">Contactez-nous ci-dessous!</div>
	<section class="inputdonne">
	<p>
					<label for="nom">Nom :</label>
					<input type="text" name="nom" id="nom" pattern="^[A-Za-z]+$" size="35" title="Nom : composé uniquement de caractères alphabétiques" value="<?PHP if (isset($_SESSION["old"])) echo $_SESSION["old"]["nom"]; ?>"/>
				</p>
				<p>
					<label for="prenom">Prenom :</label>
					<input type="text" name="prenom" id="prenom" pattern="^[A-Za-z]+$" size="35" title="Prenom : composé uniquement de caractères alphabétiques" value="<?PHP if (isset($_SESSION["old"])) echo $_SESSION["old"]["prenom"]; ?>"/>
				</p>
				<p>
				<label for="email">Mail :</label>
					<input type="mail" name="email" id="email" size= "35" placeholder="exemple@exemple.fr" title="Inserez votre mail ici" value="<?PHP if (isset($_SESSION["old"])) echo $_SESSION["old"]["mail"]; ?>"/>
					</p>
						
						</section>
					<div id="text-commentaire">Votre commentaire</div>
					<p>
					<label for="yourcomment"></label>
					<textarea name="yourcomment" id="yourcomment" rows ="10" cols="50" maxlength="350" placeholder="Ecrivez votre commentaire ici... La limite est de 350 caractères."></textarea>
		</p>
				<p>
					<input type="submit" name="valide" id="valide" value="Envoyer"/>
				</p>
	</form>
	<div class="verification"> 
	<?PHP
	function metEnForme ( $var)
	{ return ucFirst(strtolower($var)); }
	$date=date('d/m/Y');
	$heures= date('H:i');
	$non = false;
	if (empty($_POST["nom"]))
				{
				echo "<p class='messageerreur'>-Vous avez oublié votre nom.</p><br />";
				$non = true;
				}
	if (empty($_POST["prenom"]))
				{
				echo "<p class='messageerreur'>-Vous avez oublié votre prénom.</p><br />";
				$non = true;
				}
	if (empty($_POST["email"]))
				{
				echo "<p class='messageerreur'>-Vous avez oublié votre email.</p><br />";
					$non = true;
				}
		if (empty($_POST["yourcomment"]))
			{
				echo "<p class='messageerreur'>-Vous devez au moins écrire un commentaire.</p><br />";
				$non = true;
			}
	if (!empty($_POST["email"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	    echo "<p class='messageerreur'>L'adresse email" .$_POST["email"]. " n'est pas considérée comme valide.</p><br />";
		$non = true;
	}
	if ($non == true) {
		echo "<span class='alerte'>Message : Votre commentaire n'a pas pu être enregistré due à quelque(s) erreur(s)!</span><br />"; 
		
	}
	else { //SI TOUT EST JUSTE, ON AJOUTE
		$donnee = fopen("commentaires.csv", "a");
	if (!$donnee){
		die ("pb ouverture du fichier ajout");
	}
	fwrite($donnee,"\n$date $heures | Nom : {$_POST["nom"]}, Prenom : {$_POST["prenom"]}, Mail : {$_POST["email"]}.\nCommentaire : {$_POST["yourcomment"]}\n"); //AJOUT DONNE DANS FICHIER
	fclose($donnee);
	echo "<span class='confirme'>Message : Votre commentaire a été enregistré!</span><br />";
	unset($_SESSION["old"]);
	}
	?></div>
	<footer>
	<p align="center">Projet de SIN TSTI2D / SmartBag-ike ©2021r. Site par Emre Dilmac</p>
	</footer>
	&nbsp;
	</body>
	</html>