<?php
    require_once dirname( __FILE__ ) . '/' . '../../session.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$date=date("Y-m-d");
$a=$_GET['cc'];
require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
$cne=$_SESSION['cne'];
$req="INSERT INTO postuler (CNE,ID_OFFRE,STATUT,SOUMMISSION) values ('$cne','$a','postulé','$date')";
$bdd->exec($req);
header('location: postuler.php')
?>
</body>
</html>