<?php
    require_once dirname( __FILE__ ) . '/' . '../../session.php';
    require_once dirname( __FILE__ ) . '/' . '../../connexion.php';

?>

<?php 
    if(isset($_FILES["image"]["name"])){
      $id = $_POST["id"];
      $name = $_POST["id"];
    
      $imageName = $_FILES["image"]["name"];
      $imageSize = $_FILES["image"]["size"];
      $tmpName = $_FILES["image"]["tmp_name"];
    
      // Image validation
      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $imageName);
      $imageExtension = strtolower(end($imageExtension));
      if (!in_array($imageExtension, $validImageExtension)){
        echo
        "
        <script>
          alert('Invalid Image Extension');
          window.location.href='modifier.php';
        </script>
        ";
        
  
        exit();
      }
      elseif ($imageSize > 1200000){
        echo
        "
        <script>
          alert('Image Size Is Too Large');
          window.location.href='modifier.php';             
          </script>
        ";
      }
      else{
        $newImageName = $name; // Generate new image name
        $newImageName .= '.' . $imageExtension;
        $bdd->exec("UPDATE etudiant SET PHOTO = '$newImageName' WHERE CNE = '$id'");
        
        move_uploaded_file($tmpName,  '../img/ETUDIMG/'  . $newImageName);
        
      header('location:modifier.php');
      }
    }
  

$test;
    if($_SERVER['REQUEST_METHOD']=='POST')
    {  $t;
        $cne=$_SESSION['cne'];
        $PASS=$_POST['PASS'];
        $PASSS=$_POST['PASSS'];
        $PASS1=$_POST['PASS1'];
        $PASS2=$_POST['PASS2'];
        $test1=$_POST['test1'];
        $ADD=$_POST['ADRESSE'];
        $TEL=$_POST['TEL'];
        if(!empty($ADD)):
            $req="UPDATE etudiant set ADR='$ADD' WHERE cne='$cne'";
            $bdd->exec($req); 
        endif;
        if(!empty($TEL)):
            $req="UPDATE etudiant set PHONE='$TEL' WHERE cne='$cne'";
            $bdd->exec($req); 
        endif;     
        if($PASS===$PASSS):
          if(!empty($PASS1)):
            if($test1==2):
             if($PASS1==$PASS2):
          $req="UPDATE etudiant set PASS='$PASS2' WHERE cne='$cne'";
            $bdd->exec($req); 
            $t=1;
            endif;
          endif;
        endif;
        endif;



        
        $cv_nom=$_FILES['CV']['name'];
        $file_tmp_name=$_FILES['CV']['tmp_name'];
        move_uploaded_file($file_tmp_name,"cv/$cv_nom");


 if(!empty($cv_nom)):
          $req="UPDATE etudiant set CV='$cv_nom' WHERE cne='$cne'";
          $bdd->exec($req); 
      endif; 
      header('location:modifier.php');
    }
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

<link rel="icon" href="../../Interface/img/logosite.png">
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
  <?php require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>
<?php 
    $cne=$_SESSION['cne'];
    $annee=date("Y");
    $req="SELECT * from etudiant,appartient,niveau,formation where etudiant.cne=appartient.cne AND appartient.NIVEAU=niveau.NIVEAU AND niveau.ID_FORMATION=formation.ID_FORMATION AND etudiant.cne='$cne' AND  appartient.DATEtu like '$annee%' ";
    $res=$bdd->query($req);
    $V=$res->fetch(2); 
    ?>




<
<article style="margin-top:16%;">

   
<!-----form 1----->
<div class="main-content">
<div class="container-fluid mt--7">
<form id ="form"  enctype="multipart/form-data" method="POST">
<div class="row">
<div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
    <div class="card card-profile shadow">
        <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
               <center>
                 <div class="upload">
                        <?php  
                         $image = $V["PHOTO"];
                        ?>
                                <img src="../../EspaceEtu/img/ETUDIMG/<?php echo $image ?>" class="rounded-circle" title="<?php echo $image; ?>">
                                <div class="round">
                                <input type="hidden" name="id" value="<?php echo $V['CNE']; ?>">
                                <input type="hidden" name="name" value="<?php echo $V['NOM']; ?>">
                                <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
                                <i class = "fa fa-camera" style = "color: #fff;"></i>
                                </div>
                 </div>                    
              </div>
        </div>
    </div>
        <div class="card-body pt-0 pt-md-4" style="margin-top:23%;">
            <div class="row">
                <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center mt-md-2">
                        <div>                      
                        <b class="description"> <?php echo $V['NOM'].("<br> ").$V['PRENOM']?></b>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
        

</div>
</div>
</form>
<div class="col-xl-8 order-xl-2">
    <div class="card bg-secondary shadow">
<form method="POST" enctype="multipart/form-data" >
<div class="card-header bg-white border-0">

<div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Modifier Etudiant</h3>
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
            <label class="form-control-label" for="input-username">CNE</label>
            <input type="text" class="form-control form-control-alternative" value="<?php echo $V['CNE'] ?>" readonly="readonly" >
            </div>
            </div>
            <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">FORMATION</label>
                        <input type="text"  class="form-control form-control-alternative" value="<?php echo $V['LIBELLE']; ?> " readonly="readonly" >
                      </div>
                    </div>                   
                  </div>
                  <div class="row">
            <div class="col-lg-6">
            <div class="form-group focused">
            <label class="form-control-label" for="input-username">Niveau</label>
            <input type="text" class="form-control form-control-alternative" value="<?php echo $V['parcour'] ?>" readonly="readonly" >
            </div>
            </div>
            <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">EMAIL</label>
                        <input type="email"  class="form-control form-control-alternative" value="<?php echo $V['EMAIL']; ?> " readonly="readonly" >
                      </div>
                    </div>                   
                  </div>

                  <div class="row">
            <div class="col-lg-6">
            <div class="form-group focused">
            <label class="form-control-label" for="input-username">ADRESSE</label>
            <input type="text" name="ADRESSE" class="form-control form-control-alternative" value="<?php echo $V['ADR'] ?>" >
            </div>
            </div>
            <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">TELEPHONE</label>
                        <input type="text"  name="TEL"  class="form-control form-control-alternative" value="<?php echo $V['PHONE']; ?> " >
                      </div>
                    </div>                   
                  </div>
                  <!------>
    
 
  <div class="custom-file">
            <input type="file" class="custom-file-input"  id="validatedCustomFile" value="<?php echo $V['CV']?>" name="CV">
            <label class="custom-file-label" for="validatedCustomFile">Choose CV...</label>
          </div>
          <!------>
          <div class="row">
            <div class="col-lg-6" id="c1">
            <div class="form-group focused">
            <label class="form-control-label" for="input-username">PASSWORD</label>
            <div style="display:flex">
            <input type="password" name="PASS" class="form-control form-control-alternative" value="<?php echo $V['PASS'] ?>" readonly="readonly" >
            <a id="mod" ><i style="margin-top:-10px" class="bi bi-pencil-square" ></i></a>
            </div>
          </div>
            </div>
            </div>
            <div id="c2">
            <div class="row">
            <div class="col-lg-6" >
            <div class="form-group focused">
            <input type="password"  placeholder="entrer votre mot de passe" name="PASSS" class="form-control form-control-alternative">
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-6" >
            <div class="form-group focused">
            <input type="password" placeholder="entrer nouveau mot de passe" name="PASS1" id="pass" class="form-control form-control-alternative" >
            <div id="MsgV" style="font-size:10px"></div>
          <div id="princ" style="font-size:10px">
            <div id="va"></div>
            <div id="va2"></div>
            <div id="va3"></div>
            <div id="va4"></div>
            <div id="va5"></div>
            <div id="va6"></div>
          </div>
          </div>
            </div>
            </div>


            <div class="row">
            <div class="col-lg-6" >
            <div class="form-group focused">
              <div style="display:flex">
            <input type="password" class="form-control form-control-alternative" placeholder="confirmer password" name="PASS2" id="pass1">
            <a id="back" onclick="hidee()"> <i class="bi bi-arrow-return-left"></i></a>
            <input type="hidden" value="1" id="test1" name="test1">

          </div>
          </div>
          </div>
            </div>
            <div id="va1" style="font-size:10px"></div>
            
            </div>




          
          
   
        </div>

      </form>
    </div>
   </div>

</article>
</section> 
<!-- Script  -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script type="text/javascript">
 
  function hidee()
  {
            $("#c2").hide();
            $("#c1").show()

          };
      $(document).ready(function(){        $("#c2").hide();
        $("#mod").click(function(){
            $("#c2").show();
            $("#c1").hide();
        
          });
          
          
    
        $("#pass").keyup(function(){
      
      
          if(validatepass()){
            $("#test1").val("2");
        $("#princ").hide();
            // Si le mdp est valide
            $("#pass").css("border","3px solid green");
            $("#MsgV").html("mot de passe valide");
            $("#MsgV").css("color","green");
            $("#MsgV").css("font-style","italic");  
      $(document).ready(function(){
        $("#pass1").keyup(function(){
            if($("#pass1").val()== $("#pass").val()){            
              $("#va1").html("mot de passe compatible");
              $("#va1").css("color","green");
            $("#va1").css("font-style","italic");
            }
            else { 
              $("#va1").html("mot de passe incompatible");
              $("#va1").css("color","red");
            $("#va1").css("font-style","italic");
            }
          });
        });  
          }else{
                 $("#MsgV").html("");  
                   $("#princ").show();
       
            $("#pass").css("border","3px solid red");
            if(!valuppercase()){
            $("#va").css("color","red");
            $("#va").css("font-style","italic");
            $("#va").html("uppercase letter");
            }
            else {
            
              $("#va").css("color","green");
              $("#va").css("font-style","italic");
              $("#va").html("uppercase letter");
            }
          if(!vallowercase()){
            $("#va2").css("color","red");
            $("#va2").css("font-style","italic");
            $("#va2").html("lowercase letter");
          }
          else {
            
            $("#va2").css("font-style","italic");
            $("#va2").html("lowercase letter");
            $("#va2").css("color","green");
          }
          if(!valspecial()){
            $("#va3").css("color","red");
            $("#va3").css("font-style","italic");
            $("#va3").html("special character");
          }
            else{
              $("#va3").css("color","green");
              $("#va3").css("font-style","italic");
              $("#va3").html("special character");
            }
            if(!valnumber()){
            $("#va4").css("color","red");
            $("#va4").css("font-style","italic");
            $("#va4").html("number");
            }
            else {  
            $("#va4").css("font-style","italic");
            $("#va4").html("number");
            $("#va4").css("color","green");
            }
            if($("#pass").val().length<8){
            $("#va5").css("color","red");
            $("#va5").css("font-style","italic");
            $("#va5").html("Min 8 characters");
            }else {
           
            $("#va5").css("color","green");
            }
          }
        });  
      });
      
      var c;
      c=0;
      //////////////////////////////////////////////////////////validation de mdp
      function valuppercase()
      {
        var mdp3=$("#pass").val();
          // use reular expression
           var reg = new RegExp('[A-Z]');
           if(reg.test(mdp3)){
            return true;
           }else{
            return false;
           }
      }
      function vallowercase()
      {
        var mdp3=$("#pass").val();
          // use reular expression
           var reg = new RegExp('[a-z]');
           if(reg.test(mdp3)){
            return true;
           }else{
            return false;
           }
      }
      function valspecial()
      {
        var mdp3=$("#pass").val();
           var reg = /[ !"#$%&'()*+,-./:;<=>?@[\\\]^_`{|}~]/g;
           if(reg.test(mdp3)){
            return true;
           }else{
            return false;
           }
      }
      function valnumber()
      {
        var mdp3=$("#pass").val();
          // use reular expression
           var reg = new RegExp('[0-9]');
           if(reg.test(mdp3)){
            return true;
           }else{
            return false;
           }
      }
      
      function validatepass(){
        var mdp3=$("#pass").val();
         var reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/gi ;
         if(reg.test(mdp3)){
          return true;
         }else{
          return false;
         }
        };
</script>


<script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("form").submit();
      };
    </script>
  

</body>
</html>



