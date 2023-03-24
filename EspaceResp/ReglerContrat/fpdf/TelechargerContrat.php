
<?php
require_once dirname( __FILE__ ) . '/' . '../../../session.php';
require_once dirname( __FILE__ ) . '/' . '../../../connexion.php'; ;



    $NumStage = $_GET['idd'];

   $reqEtud="SELECT * from stage,etudiant where stage.CNE=etudiant.CNE and NUM=' $NumStage'";
   $resETud=$bdd->query($reqEtud); 
   $tab1=$resETud->fetch();

   $reqEntre="SELECT * from stage,entreprise where  NUM=' $NumStage' AND stage.ID=entreprise.ID";
   $resENTRE=$bdd->query($reqEntre); 
   $tab2=$resENTRE->fetch();

   $reqEnseing="SELECT * from stage,enseignant where NUM=' $NumStage' AND stage.ID_PROF=enseignant.ID_PROF";
   $resENseign=$bdd->query($reqEnseing); 
   $tab3=$resENseign->fetch();

   $reqInfoEtud="SELECT * from appartient,niveau,formation where CNE='$tab1[CNE]' 
   and appartient.NIVEAU=niveau.NIVEAU and niveau.ID_FORMATION=formation.ID_FORMATION";
   $resINFOETU=$bdd->query($reqInfoEtud); 
   $tab4=$resINFOETU->fetch();
   
require('fpdf184/fpdf.php');
$pdf = new FPDF('P', 'mm', 'A5');


//Ajouter une nouvelle page
$pdf->AddPage();
$pdf->SetFont('Helvetica','',11);
$pdf->SetTextColor(0);

// entete
$pdf->Image('fstm.jpg', 10, 5, 50, 20);
$pdf->Image('../../../EspaceEtu/img/LOGOENTRE/'.$tab2["LOGO"], 90, 5, 50, 20);

// Saut de ligne
$pdf->Ln(15);


// Police Arial gras 16
$pdf->SetFont('Arial', 'B', 11);
// Titre

$pdf->SetTextColor(128,0,0);
$pdf->Cell(0, 10, 'CONTRAT DE STAGE DE FORMATION AU SEIN DE L\'ENTREPRISE ', 'LTRB', 1, 'C');
$pdf->SetTextColor(0,0, 0);
$pdf->Cell(0, 10, 'Num:'.$tab1['NUM'], 0, 1, 'C');

// Saut de ligne
$pdf->Ln(1);

$pdf->SetFont('Arial', '', 10);
$h = 7;
$retrait = "      ";
$txt = iconv('utf-8', 'cp1252', "Je soussigné, Directeur de l'entreprise ");
 $pdf->Write($h, $txt);
 $pdf->SetFont('', 'BIU',11);
 $pdf->SetTextColor(255,0, 0);
$pdf->Write($h, iconv('utf-8', 'cp1252',$tab2['NOM']));
$pdf->SetTextColor(0,0, 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Write($h, '  (ICE: '.$tab2['ID'].' )');
$pdf->SetFont('Arial', '', 10);
$pdf->Write($h, ' Certifie que :'. "\n");
$pdf->Write($h, $retrait .iconv('utf-8', 'cp1252', "L'étudiant: "));
$pdf->SetFont('Arial', 'BU','11');
$pdf->SetTextColor(32,178,170);
$pdf->Write($h, $tab1['NOM'].' '.$tab1['PRENOM'] . "\n");
$pdf->SetTextColor(0,0, 0);
$pdf->SetFont('', '');

$pdf->Write($h, $retrait . iconv('utf-8', 'cp1252',"Né (e) Le : ") .  $tab1['NAISSANCE']."\n"); 
$pdf->Write($h, $retrait .iconv('utf-8', 'cp1252', "Adresse : ") .$tab1['ADR']  . "\n");
$pdf->Write($h, $retrait . iconv('utf-8', 'cp1252',"CNE N° : ") . $tab1['CNE']. " \n");
$pdf->Write($h, $retrait . iconv('utf-8', 'cp1252',"N° de tél : ") . $tab1['PHONE']. " \n");

 $pdf->Write($h, $retrait . iconv('utf-8', 'cp1252',"Filière :  " ). $tab4['LIBELLE']. " \n");

$pdf->Write($h, $retrait . "Niveau de formation :  " .$tab4['parcour'] . "  \n");

$pdf->Write($h, $retrait . iconv('utf-8', 'cp1252',"Année de formation :  ") .date('Y',strtotime(date('Y').' - 1 Year'))
.' / ' . date('Y'). "  \n");
$pdf->Write($h, $retrait . iconv('utf-8', 'cp1252',"L'encadrant (FSTM) :  ") . $tab3['NOM'].' '.$tab3['PRENOM'] ."  \n");
$pdf->Write($h, $retrait . iconv('utf-8', 'cp1252',"Date Début du stage :  ") . $tab3['DATE_DEBUT'] ."  \n");
$pdf->Write($h, $retrait . iconv('utf-8', 'cp1252',"Date Fin du stage :  ") . $tab3['DATE_FIN']."  \n");
$pdf->Write($h, $retrait . iconv('utf-8', 'cp1252',"Sujet du stage :  ".$tab3['SUJET']) ."  \n");

$pdf->SetFont('', 'U', 12);
$pdf->Write($h, "admet pour passer une stage de formation." . "\n");

$pdf->SetFont('', '', 10);
$pdf->Cell(0, 5, iconv('utf-8', 'cp1252','Fait à Mohammedia Le : ' ) . date('d/m/Y'), 0, 1, 'C');

// Décalage de 20 mm à droite
$pdf->Ln(1);
$pdf->SetFont('Times', 'B', 11);
$pdf->Cell(130, 5, "signature", 1, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Times', 'U', 8);
$pdf->Cell(65, 15, iconv('utf-8', 'cp1252',"Le directeur de l'entreprise :"), 1, 0, 'L');
$pdf->Cell(65, 15, " Le Stagaitre :", 1, 1, 'L');


//Afficher le pdf
$pdf->Output($tab1['NOM'].'_'.$tab1['PRENOM'].'.pdf', 'I');
$pdf->Output(F,'CNT/'.$tab1['NOM'].'_'.$tab1['PRENOM'].'_'.$tab1['CNE'].'.pdf'); 


$pdf->Output();
?>

