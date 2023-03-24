<?php

require_once dirname(__FILE__) . '/' . '../../session.php';
require_once dirname(__FILE__) . '/' . '../../connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $logo_nom = $_FILES['logo']['name'];
    $file_tmp_name = $_FILES['logo']['tmp_name'];

    $cne1 = $_POST['cne1'];
    $daten1 = $_POST['naissane1'];
    $nom1 = $_POST['nom1'];
    $prenom1 = $_POST['prenom1'];
    $niveau1 = $_POST['niv1'];
    $dates1 = $_POST['dates1'];
    $add1 = $_POST['add1'];
    $tel1 = $_POST['tel1'];
    $email1 = $_POST['email1'];
    $pass1 = $_POST['pass'];
    if (!empty($logo_nom))
        move_uploaded_file($file_tmp_name, "../../EspaceEtu/img/ETUDIMG/$logo_nom");
    else $logo_nom = "def.jpg";
    $req11 = "INSERT INTO etudiant (CNE,PASS,NOM,PRENOM,ACTIVE,EMAIL,NAISSANCE,PHOTO,PHONE,ADR) value('$cne1','$pass1','$nom1','$prenom1','1','$email1','$daten1','$logo_nom','$tel1','$add1')";
    $bdd->exec($req11);

    $req1 = "INSERT INTO appartient (CNE,NIVEAU,DATEtu) value('$cne1','$niveau1','$dates1')";
    $bdd->exec($req1);
    header('location:etudiant.php');
}
$resp = $_SESSION['cne'];
$r = "SELECT * FROM responsable WHERE USERNAME='$resp' ";
$Smt1 = $bdd->query($r);
$ro = $Smt1->fetch(PDO::FETCH_ASSOC);
$f = $ro['ID_FORMATION'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gérer etudiants</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Signika:400,600'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
    <link rel="stylesheet" href="../menu/style.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <style>
        .box {
            display: flex;
            flex-wrap: wrap;
        }

        .box>* {
            flex: 1 1 50px;
        }
    </style>

</head>

<body>

    <header>
        <span class="menu"><i class="material-icons">menu</i></span>
        <div style="float : right; padding-right: 7%;">
            <a href="" type="button" class="btn btn-outline-primary btn-rounded " data-mdb-ripple-color="dark" data-bs-target="#myModal" data-bs-toggle="modal" style="margin-right: 40px;"><i class="fas fa-plus"></i>
                Etudiant</a>
        </div>
        <?php require_once dirname(__FILE__) . '/' . '../menu/menu.php'; ?>
    </header>


    <article style="margin:80px 0 0 100px;">
        <div>
            <a href="etudiant.php">
                <button style="background-color:white;color:black" type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
                    Gestion des etudiants
                </button>
            </a>
            <a href="../gererprof/prof.php">
                <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
                    Gestion des Enseignant
                </button>
            </a>
        </div>

        <div class="row" align="center">
            <div class="col-12 mt-3 mb-1">
                <h5 class="text-uppercase">Gestion Des Etudiants</h5>
                <p>
                    <?php
                    $e = $bdd->query("SELECT * from formation where ID_FORMATION='$f'");
                    $m = $e->fetch(PDO::FETCH_ASSOC);

                    echo $m['LIBELLE'];

                    ?></p>
            </div>
        </div>


        <div class='class="col-12 mt-3 mb-1"'>
            <?php
            $annee = date("Y");
            $req = "SELECT * from etudiant where cne  in(select etudiant.cne from etudiant,appartient,niveau where etudiant.cne=appartient.cne AND appartient.NIVEAU=niveau.NIVEAU  AND niveau.id_formation='$f' AND appartient.DATEtu like '$annee%')";
            $d = $bdd->query($req);
            $row = $d->fetchAll(2); ?>

            <div class="container my-5" style="margin-left: 5%; width :80% !important; margin-top: 10px !important;">
                <div class="shadow-4 rounded-5" style="width:100%">

                    <table id="example" class="table align-middle mb-0 bg-white table table-striped">

                        <thead class='bg-light'>
                            <tr>
                                <center>
                                    <th>Cne</th>
                                    <th>Nom et Prenom</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>parcour</th>
                                    <th></th>
                                </center>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($row as $V) :
                            ?>

                                <tr>
                                    <td align="center">
                                        <div class="d-flex ">
                                            <img src="../../EspaceEtu/img/ETUDIMG/<?php echo $V['PHOTO'] ?>" alt="photo d'etu" style="width: 45px; height: 45px" class="rounded-circle" />
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1"><?php echo $V['CNE'] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td align="center">
                                        <p class="text-muted mb-0"><?php echo $V['NOM'] ?><?php echo $V['PRENOM'] ?></p>
                                    </td>
                                    <td align="center">
                                        <span class="badge badge-info rounded-pill"><?php echo $V['EMAIL'] ?></span>
                                    </td>
                                    <td align="center">
                                        <span class="badge badge-info rounded-pill"><?php echo $V['PHONE'] ?></span>
                                    </td>


                                    <td align="center">


                                        <?php
                                        $cne2 = $V['CNE'];
                                        $req2 = "SELECT * from appartient,niveau where appartient.NIVEAU=niveau.NIVEAU and appartient.cne='$cne2'";
                                        $d2 = $bdd->query($req2);
                                        $row2 = $d2->fetchAll(2);
                                        foreach ($row2 as $V2) :
                                            $date = date_parse($V2['DATEtu']);
                                            echo "<span class='badge badge-info rounded-pill'>" .
                                                $V2['parcour'] . "</span>" . (" ") .
                                                "<span class='badge badge-info rounded-pill'>"
                                                . $date['year'] . "-" . ($date['year'] + 1) . "</span>" . "<br>";
                                        endforeach;
                                        ?>
                                    </td>
                                    <td>
                                        <div style="float:left">
                                            <?php $d = $V['CNE'] ?>

                                            <a href="modifieretu.php?cne=<?php echo $V['CNE']; ?>"><i class="bi bi-pencil-square"></i></a><br>
                                            <a data-bs-toggle="collapse" href="#<?php echo ("f") . $d ?>" role="button" aria-expanded="false" aria-controls="<?php echo ("f") . $d ?>"> <i class="bi bi-info-circle"></i></a>
                                            <br><?php if ($V['ACTIVE'] == '1') { ?>
                                                <a href="supp.php?cne=<?php echo $V['CNE'] ?>"><i style="color:red" class="bi bi-person-dash-fill"></i></a>
                                            <?php } else { ?>
                                                <a href="supp.php?cne=<?php echo $V['CNE'] ?>"><i class="bi bi-person-plus-fill"></i></a></a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border:none;" colspan="6">
                                        <div class="collapse" id="<?php echo ("f") . $d ?>">
                                            <center>
                                                <?php
                                                $req3 = "SELECT * from postuler,offre,entreprise where postuler.ID_OFFRE=offre.ID_OFFRE AND offre.ID=entreprise.ID AND postuler.CNE='$d'";
                                                $d3 = $bdd->query($req3);
                                                $row3 = $d3->fetchAll(2);
                                                if (empty($row3)) {
                                                    echo "<h6> aucun offre</h6>";
                                                } else echo " <h6> offre postulé</h6>"
                                                ?>


                                                <div class="box">
                                                    <?php
                                                    foreach ($row3 as $V3) :
                                                    ?>
                                                        <div class="container bcontent" style="margin-bottom:5px">
                                                            <div class="card" style="width: 300px;height: auto ;">
                                                                <div style="display:flex;margin:10px 0 0 10px">
                                                                    <img class="card-img" src="../../EspaceEtu/img/LOGOENTRE/<?php echo $V3['LOGO'] ?>" style="height:50px;width:50px" alt="entreprise">
                                                                    <div style="margin-left:10px;">
                                                                        <b>
                                                                            <h6><?php echo $V3['NOM'] ?></h6>
                                                                        </b>
                                                                        <p style="font-size: small;margin-top: -10px;"><?php echo $V3['SUJET'] ?></p>
                                                                        <p style="margin-top: -20px;font-size: small;"><?php echo $V3['STATUT'] ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php endforeach; ?>
                                                </div>
                                            </center>
                                        </div>
                </div>
                </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
            </table>

            </div>
        </div>
        <?php require_once dirname(__FILE__) . '/' . 'AjouterEtu.php'; ?>
        </div>

        <!-- partial -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script src="../menu/script.js"></script>



</body>

</html>