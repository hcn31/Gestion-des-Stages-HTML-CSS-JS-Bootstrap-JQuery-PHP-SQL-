
<section class="main">
  <aside class="keep">
    <ul style="padding: 0px !important;">
      <li id="img">
        <center>
        <?php require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
         $cne=$_SESSION['cne'];
         $req="SELECT PHOTO FROM etudiant WHERE `CNE`='$cne'"; 
         $Smt=$bdd->query($req); 
       $rows=$Smt->fetch(PDO::FETCH_ASSOC); // arg: PDO::FETCH_ASSOC
       ?>
        <img src="../img/ETUDIMG/<?php echo $rows['PHOTO']?>"  class="image">
        <div style="padding : 10px">
        <?php 
        require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
        $cne=$_SESSION['cne'];
          $req="SELECT NOM,PRENOM FROM etudiant WHERE `CNE`='$cne'"; 
          $Smt=$bdd->query($req); 
        $rows=$Smt->fetch(PDO::FETCH_ASSOC); // arg: PDO::FETCH_ASSOC 
        echo "<b>".$rows['NOM']." ".$rows['PRENOM']."</b>" ;
          ?>
       </div> 
      </center> 

      </li>
      <li>
        <a href="../Postuler/postuler.php">
          <span><i class="material-icons">local_offer</i></span>
           Offres 
          <span class="notif red">
            <?php 
        require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
        $cne=$_SESSION['cne'];
        $req="SELECT * FROM offre,appartient WHERE appartient.CNE='$cne' AND appartient.NIVEAU=offre.NIVEAU"; 
          $Smt=$bdd->query($req); 
        $rows=$Smt->fetchAll(PDO::FETCH_ASSOC); 
           echo count($rows);
          ?> 
          </span>
        </a>
      </li>      
      <li>
        <a href="../VosStages/Vosstage.php">
          <span><i class="material-icons">work_outline_icon</i></span>
           Vos Stages
             <span class="notif red">
            <?php 
        require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
        $cne=$_SESSION['cne'];
        $req="SELECT * FROM postuler WHERE CNE='$cne'"; 
          $Smt=$bdd->query($req); 
        $rows=$Smt->fetchAll(PDO::FETCH_ASSOC); 
           echo count($rows);
          ?> 
          </span>
        </a>
      </li>
      <li>
        <a href="../Modifier/modifier.php">
          <span><i class="material-icons">account_circle_icon</i></span>
           Modifier Profil
        </a>
      </li> 
      <li>
        <a href="../historique/historique.php">
          <span><i class="material-icons">history_icon</i></span>
           Historique
        </a>
      </li>
      <li>
        <a href="../../Deconnexion.php">
          <span><i class="material-icons">logout_icon</i></span>
           Déconnextion
        </a>
      </li>      
     
    </ul>
  </aside>
  
