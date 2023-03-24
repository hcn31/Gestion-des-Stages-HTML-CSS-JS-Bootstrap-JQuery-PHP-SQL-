<?php

require('connexion.php');


///la creation d'une session
session_start();
//s'il y a  une erreur de connexion     
if (isset($_SESSION['error']))
	echo $_SESSION['error'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$l = $_POST['user'];
	$p = $_POST['psrwd'];
	$test = $_POST['choix'];

	if (isset($_POST['check'])) {
		setcookie('email', $l, time() + 365 * 24 * 3600, null, null, false, true);
		setcookie('Password', $p, time() + 365 * 24 * 3600, null, null, false, true);
	}

	if ($test == "1") $req = "SELECT * FROM etudiant WHERE `CNE`='$l' AND `PASS`='$p' AND `ACTIVE`='1'";
	else $req = "SELECT * FROM responsable WHERE `USERNAME`='$l' AND `PASSMOT`='$p'";

	$Smt = $bdd->query($req);
	$rows = $Smt->fetchAll(PDO::FETCH_ASSOC); // arg: PDO::FETCH_ASSOC 
	$row = $rows[0];
	if (!empty($row)) {
		$_SESSION['auth'] = $l;
		unset($_SESSION['error']);

		if (!isset($_SESSION['vers'])) {
			$_SESSION['cne'] = $_POST['user'];
			if ($test == "1") // test delai de reponse
			{
				$cne = $_SESSION['cne'];
				$verif = "SELECT postuler.ID_OFFRE from postuler,offre WHERE postuler.ID_OFFRE=offre.ID_OFFRE and postuler.CNE='$cne'  AND offre.DELAI_REPONSE < NOW() and postuler.STATUT='retenu'";
				$res = $bdd->query($verif);
				$row = $res->fetchAll(PDO::FETCH_ASSOC);
				foreach ($row as $V) :
					$idoff = $V['ID_OFFRE'];
					$bdd->exec("UPDATE postuler SET STATUT='Refuse' WHERE ID_OFFRE='$idoff' and CNE='$cne'");

				endforeach;
			} /// fin test delai de reponse 

			if ($test == "1") header("Location: EspaceEtu/Postuler/postuler.php");
			else header("Location: EspaceResp/Offres/offre.php");
		} else
			header('Location:' . $_SESSION['vers']);
	} else {

		header("Location: index.php");
	}
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>E-stage: Simple moyen de rechercher un stage</title>
	<meta name="description" content="Cardio is a free one page template made exclusively for Codrops by Luka Cvetinovic" />
	<meta name="keywords" content="html template, css, free, one page, gym, fitness, web design" />
	<meta name="author" content="Luka Cvetinovic for Codrops" />
	<meta name="msapplication-TileColor" content="#00a8ff">
	<meta name="theme-color" content="#ffffff">
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="Interface/css/bootstrap.css">
	<!-- Animate.css -->
	<link rel="stylesheet" type="text/css" href="Interface/css/animate.css">
	<!-- Main style -->
	<link rel="stylesheet" type="text/css" href="Interface/css/style.css">
</head>

<body>
	<div class="preloader">
		<img src="Interface/img/loader.gif" alt="Preloader image">
	</div>
	<nav class="navbar">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><img src="Interface/img/logosite.png" data-active-url="Interface/img/logosite.png"></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right main-nav">
					<li><a href="#intro">Accueil</a></li>
					<li><a href="#services">A propos</a></li>
					<li><a href="#team">S'identifier</a></li>

				</ul>
			</div>

		</div>
	</nav>
	<div>
		<header id="intro">
			<div class="container">
				<div class="table">
					<div class="header-text">
						<div class="row">
							<div class="col-md-12 text-center">
								<h3 class="light white">E-stage</h3>
								<h1 class="white typed">Votre chemin vers l'expérience</h1>
								<span class="typed-cursor">|</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
	</div>

	<!----FIN Section espace --->
	<section id="team" class="section">
		<div class="container">
			<div class="row title text-center">
				<h2 style="color: skyblue;">S'identifier</h2>
				<h5 class="light muted">Consulter votre espace</h5>
			</div>
			<center>
				<div class="row">

					<div class="col-md-4" style="width: 50%; ">
						<div class="team text-center">

							<img src="Interface/img/team/resp.jpeg" alt="Team Image" class="avatar">
							<div class="title">
								<h4>Espace responsable</h4>
								<h5 class="muted regular">Responsable formation</h5>
							</div>
							<a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue-fill ripple" onclick="fct2()">Se connecter </a>
						</div>
					</div>


					<div class="col-md-4" style="width: 50%;">
						<div class="team text-center">

							<img src="Interface/img/team/etudiant.jpeg" alt="Team Image" class="avatar">
							<div class="title">
								<h4>Espace étudiant</h4>
								<h5 class="muted regular">Chercheur du stage</h5>
							</div>
							<a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue-fill ripple" onclick="fct1()">Se connecter </a>
						</div>
					</div>
				</div>
			</center>
		</div>
	</section>
	<!----FIN Section espace --->

	<!---- Section about site --->
	<section id="services" class="section ">
		<div class="container">
			<div class="row services">

				<div class="col-md-4" style="width: 100%;">
					<div class="service">
						<div class="icon-holder">
							<img src="Interface/img/icons/guru-blue.png" alt="" class="icon">
						</div>
						<h4 class="heading"> A propos du site </h4>
						<p class="description"> Au cours de leur cursus scolaire, les étudiants de la FSTM
							sont amenés à réaliser des stages en entreprises,
							qui leurs posent assez de problèmes (perte de temps,
							stress des étudiants, retard des soutenances … ).
							Pour pallier à ces difficultés nous proposons dans le
							cadre du projet d’intégration, de développer une application web d’aide à la recherche de stage, a partir de connecter les entreprises & futurs stagiaires.
							Cette plateforme facilite la gestion de ces stages , afin d’offrir un historique solide.</p>
					</div>
				</div>

			</div>
		</div>
		<div class="cut cut-bottom"></div>
	</section>
	<!----Fin  Section about site --->

	<!---- Page identification --->
	<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content modal-popup ">
				<a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
				<h3 class="white">S'identifier</h3>
				<form class="popup-form" method="POST" action="index.php">
					<input name="user" type="text" class="form-control form-white" placeholder="Login" value="<?php if (isset($_COOKIE['email'])) echo $_COOKIE['email']; ?>" required>
					<input name="psrwd" type="password" class="form-control form-white" placeholder="Mot de passe" value="<?php if (isset($_COOKIE['Password'])) echo $_COOKIE['Password']; ?>" required>
					<input type="hidden" name="choix" id="hid">
					<div class="checkbox-holder text-left">
						<div class="checkbox">
							<input type="checkbox" id="squaredOne" name="check" />
							<label for="squaredOne"><span>Rappeler de moi </span></label>
						</div>
					</div>
					<button type="submit" class="btn btn-submit">Se Connecter</button>
				</form>
			</div>
		</div>
	</div>
	<!---- Fin Page identification --->

	<!-- Scripts -->
	<script src="./Interface/js/auth.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script src="./Interface/js/typewriter.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-one-page-nav/3.0.0/jquery.nav.min.js"></script>
	<script src="./Interface/js/main.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>

</html>