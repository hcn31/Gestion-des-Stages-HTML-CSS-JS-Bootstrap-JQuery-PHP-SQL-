<?php
    require_once dirname( __FILE__ ) . '/' . '../../session.php';


require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
$cne=$_SESSION['cne'];


if($_SERVER['REQUEST_METHOD']=='POST') 
{
    $mo=$_POST['mot'];
    $mot= explode(" ",$mo);

 $req="SELECT * FROM entreprise,stage WHERE entreprise.ID=stage.ID and stage.RAPPORT IS NOT NULL AND stage.CONTRAT IS NOT NULL and stage.CNE in (SELECT stage.CNE FROM stage,appartient WHERE stage.CNE=appartient.CNE and appartient.NIVEAU in (SELECT NIVEAU FROM appartient  WHERE appartient.CNE='$cne'))";
 for ($i=0; $i < count($mot); $i++) 
{   
    if($i==0) $req=$req." and stage.MOTS in ( select stage.MOTS  from stage where ";
    $req=$req."stage.MOTS LIKE '%".$mot[$i]."%' ";
    if($i!=count($mot)-1) $req=$req." or ";
   
}
$req=$req.");";

}else 
{
 $req="SELECT * FROM entreprise,stage WHERE entreprise.ID=stage.ID and stage.RAPPORT IS NOT NULL AND stage.CONTRAT IS NOT NULL and stage.CNE in (SELECT stage.CNE FROM stage,appartient WHERE stage.CNE=appartient.CNE and appartient.NIVEAU in (SELECT NIVEAU FROM appartient a WHERE a.CNE='$cne'));";   
}
 $res=$bdd->query($req);
$row=$res->fetchAll(PDO::FETCH_ASSOC);


$i=0;
   
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8"> 
  <title> Historique </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Signika:400,600'>
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
<link rel="stylesheet" href="../menu/style.css">
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- zyada pour icone -->
<link href="http://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="icon" href="../../Interface/img/logosite.png">

</head>
<body>

<header>
  <span class="menu"><i class="material-icons">menu</i></span>

  <?php require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>

</header>

<article style="margin-top:50px !important">  


        <div >     
            <div class="details">
            <div class="recentCustomers">
      <div class="row" align="center">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase">Historique Des Stages</h5>
        
      </div>
    </div>


               <table>
                        <thead>
                          <tr >
            <div style="display: flex; justify-content:center;">
                <div class="search" >
                    <label>
                        <form method="POST">
                        <div class="custom-search">
  <input type="text" class="custom-search-input" placeholder="Mots clés" name="mot">
  <button class="custom-search-botton" type="submit">Rechercher</button>  
</div>

                         </form>
                    </label>
                </div>
            </div>
         </tr>
                      <tr >
                                <td colspan="2" >Entreprise</td>
                                <td>Sujet</td>
                                <td>Année</td>
                                <td >Rapport</td>
                            </tr>
                        </thead>
<?php  foreach($row as $V): 
     $i++;
    ?>                 
      
                        <tbody>
                             <tr>
                            <td width="40px">
                                <div class="imgBx"><img src="../img/LOGOENTRE/<?php echo $V['LOGO']?>" alt=""></div>
                            </td>
                                <td>
                                   <div class="ms-3">
                                      <p class="fw-bold mb-1"> <?php echo $V['NOM'] ?> </p>
                                      <p class="text-muted mb-0"><?php echo $V['ADRESSE'] ?></p>
              
                                   </div>
                            </td>
                                <td><?php echo $V['SUJET'] ?></td>
                                <td>
                                    <?php  $dd=date_parse($V['DATE_FIN']); 

                                    echo ($dd['year']-1); echo "-".$dd['year'];

                                    ?>
                                    
                                </td>
                                <td><a href="<?php echo "./rapport/".$V['RAPPORT'];
                            
                            ?>" type="button" class="btn btn-outline-primary btn-rounded " open='Rapport' class="download-btn" target="_blank">Download
                                     <i class="fa fa-download"></i>
                                 </a></td>
                            </tr> 
 <?php endforeach; ?>                          
                        </tbody>
                    </table>
                </div>

                
            </div>
        </div>
   

    <!-- =========== Scripts =========  -->
 

    <!-- ====== ionicons ======= -->
   

</article>
</section>

<!-- Script  -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>

