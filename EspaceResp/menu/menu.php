<!-- partial:index.partial.html -->
<section class="main">
  <aside class="keep">
    <ul style="padding: 0px !important;">
      <li>
        <a href="../Offres/offre.php">
          <span><i class="material-icons">addchart_rounded_icon</i></span>
           Gérer Offres 
        </a>
      </li> 
      <li>
        <a href="../gereretu/etudiant.php">
          <span><i class="material-icons">people_outline_icon</i></span>
           Gérer  
        </a>
      </li>
      <li>
        <a href="../gererent/entreprise.php">
          <span><i class="material-icons">apartment_icon</i></span>
           Gérer  
        </a>
      </li>
      <li>
        <a href="../VerifierStage/VerifStages.php">
          <span><i class="material-icons">check_circle_outline_icon</i></span>
           Valider Stage
          
            <?php 
        require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
       
       $resp=$_SESSION['cne'];
       $r="SELECT * FROM responsable WHERE USERNAME='$resp' ";
       $Smt1=$bdd->query($r); 
       $ro=$Smt1->fetch(PDO::FETCH_ASSOC);
      $f=$ro['ID_FORMATION'];

        $req="SELECT * FROM stage WHERE stage.GENRE='2' AND stage.CNE in (SELECT appartient.CNE from appartient,niveau where appartient.NIVEAU=niveau.NIVEAU and niveau.ID_FORMATION='$f');"; 
          $Smt=$bdd->query($req); 
        $rows=$Smt->fetchAll(PDO::FETCH_ASSOC); 
           echo count($rows);
          ?> 

          </span>
        </a>
      </li> 
      <li>
        <a href="../ReglerContrat/Contrat.php">
        <span><i class="material-icons">assignment</i></span>
           Generer Contrat
           </a>
      </li> 
      <li>
        <a href="../AffectJury/JuryAndRapp.php">
          <span>    <i class="fa fa-users"></i></span>
          L'affectation du Jury  

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