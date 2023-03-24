<?php require_once dirname( __FILE__ ) . '/' . '../../session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <title>Affecter Les Notes</title>

    <link href="Style/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="Style/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="Style/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="Style/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link href="Style/css/main.css" rel="stylesheet" media="all">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Signika:400,600'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'><link rel="stylesheet" href="../menu/style.css">
     <link rel='Icons' href='../../Interface/img/logosite.png'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css"rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
</head>

<body >
<header>
  <span class="menu"><i class="material-icons">menu</i></span>
  <?php   require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>

<?php require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 
  $NumStage = $_GET['idd'];

  $resp=$_SESSION['cne'];
         ?>
<article style="margin-left:30%;width:600px; justify-content: center;
    align-items: center;" > 

<div class="page-wrapper p-t-45 p-b-50" style="margin-top:0%;" >
        <div class="wrapper wrapper--w790">
            <div class="card card-5">

                <div class="card-heading">
                    <h6 class="title">Les Notes...</h6>
                </div>
                
                <div class="card-body">
                    <form method="post" action="AffectNote.php" >

                    <div class="form-row">
                            <div class="name">Note Entreprise</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number"
                                    min="0" max="20" step="0.01" name="ENTNOTE" required>
                                </div>
                            </div>
                        </div>
                          <?php 
                   
                        $req="SELECT * FROM 
                        enseignant,juger WHERE enseignant.ID_PROF=juger.ID_PROF and NUM='$NumStage'";
                        $res=$bdd->query($req);
                        while($tab=$res->fetch()){
                       
                        ?>
                   <input type="hidden" name="numStage" value="<?php echo $NumStage;?>">

                        <div class="form-row">
                            <div class="name"><?php echo mb_strtoupper($tab['NOM'],
                            'UTF-8').' '.mb_strtoupper($tab['PRENOM'],'UTF-8'); ?></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" 
                                    min="0" max="20" step="0.01" name="<?php echo $tab['ID_PROF'] ?>"
                                    required>

                                </div>
                            </div>
                        </div>

                            <?php }?>
                        
                            <div>
                            <button class="btn btn--radius-2 btn--red  btn-success" type="submit">Enregistrer</button>
                            <button class="btn btn--radius-2 btn--red  btn-danger" type="reset">Annuler</button>
                        </div>
                      

                    </form>

                </div>
            </div>
        </div>
    </div>
    </article>

    <!-- Jquery JS-->
    <script src="Style/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="Style/vendor/select2/select2.min.js"></script>
    <script src="Style/vendor/datepicker/moment.min.js"></script>
    <script src="Style/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="Style/js/global.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>

 

</body>
</html>

