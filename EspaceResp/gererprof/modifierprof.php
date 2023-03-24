<?php 
 require_once dirname( __FILE__ ) . '/' . '../../session.php';
 require_once dirname( __FILE__ ) . '/' . '../../connexion.php';

 if(isset($_GET['id'])) 
 $_SESSION['test']=$_GET['id'];
 $cne=$_SESSION['test'];


 if(isset($_POST['add']))
 { 
    
     $add=$_POST['add'];
     $tel=$_POST['tel'];
     $nomm=$_POST['nomm'];
         $req="UPDATE enseignant set ADRESSE='$add',TEL='$tel',nomination='$nomm' WHERE ID_PROF='$cne'";
         $bdd->exec($req); 
         header('location:modifierprof.php');
 }
 $req="SELECT * from enseignant where ID_PROF='$cne'";
 $res=$bdd->query($req);
 $row5=$res->fetch(2); 
 
  ?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Détail</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Signika:400,600'>
  
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'><link rel="stylesheet" href="../menu/style.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

     <!-- Bootstrap -->
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css"
  rel="stylesheet"/>
  
 <!--------- For select modal ----->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


<link rel="stylesheet" href="styleDetail.css">
<style type="text/css">
  .bootstrap-select {
width: 100% !important;
}
</style>
  


</head>
<body>
  
<header>
  <span class="menu"><i class="material-icons">menu</i></span>
  <div style="float : right; padding-right: 7%;">
  </div>
  
  <?php require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>


<article style="margin-top:16%">
<center>
<div class="main-content">
<div class="container-fluid mt--7">

<div class="col-xl-8 order-xl-2">
    <div class="card bg-secondary shadow">
            <form action="" method="POST"> 
            <div class="card-header bg-white border-0">

              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Modifier Enseignant</h3>
                </div>

                <div class="col-4 text-right">
                  <button type="submit"  class="btn btn-sm btn-primary"> Enregistrer</button> 
                </div>
              </div>
            </div>
            <div class="card-body">

              
    
                <div class="pl-lg-4">

                  <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">NOM</label>
                        <input type="text" name="nom" class="form-control form-control-alternative" readonly="readonly" value="<?php echo $row5['NOM']; ?>">
                      </div>
                      </div>
                      <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">PRENOM</label>
                        <input type="text" name="prenom" class="form-control form-control-alternative" readonly="readonly" value="<?php echo $row5['PRENOM']; ?>" >
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">EMAIL</label>
                        <input type="text" name="email" class="form-control form-control-alternative" readonly="readonly" value="<?php echo $row5['EMAIL']; ?>" >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Nommination</label>
                        <input type="date" name="nomm" class="form-control form-control-alternative" readonly="readonly" value="<?php echo $row5['nomination']; ?>" >
                      </div>
                    </div>
                    
                  <div class="row">      
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">TELEPHONE</label>
                        <input type="text" name="tel"class="form-control form-control-alternative" value="<?php echo $row5['TEL']; ?>" >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">ADRESSE</label>
                        <input type="text" name="add"class="form-control form-control-alternative" value="<?php echo $row5['ADRESSE']; ?>" >
                      </div>
                    </div>
                  </div>
                  </div>              
            </div>
          </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  </center>
       
  </article >
</section>

<!-- partial -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>


<!--------- For select modal ----->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

</body>
</html>




