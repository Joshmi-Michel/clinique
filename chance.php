<?php
   if(isset($_POST['design']) AND isset($_POST['qteAchete']) AND isset($_POST['prixU']) AND isset($_POST['montant1']) AND isset($_POST['idp'])){
       try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $bdd= new PDO('mysql: host=localhost ; dbname=gynecare','root','',$pdo_options);
        $req = $bdd->prepare('INSERT INTO panier(   design , qteAchete ,  pu , montant  ,   dateAchat , idProPan) VALUES(?,
        ?, ?, ?, NOW() , ?)');
        $req->execute(array($_POST['design'] ,$_POST['qteAchete'], $_POST['prixU'] , $_POST['montant1'], $_POST['idp'] ) );
      }catch(Exceptin $e){
          die('ERREUR : '.$e->getMessage());
      }
    }
?>

<?php
   

    if(isset($_POST['qteAchete']) AND isset($_POST['idp'])){
       try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $bdd2= new PDO('mysql: host=localhost ; dbname=gynecare','root','',$pdo_options);
        $req2 = $bdd2->prepare('UPDATE produit set qte=(qte-?) WHERE refProd=? ');
        $req2->execute(array($_POST['qteAchete'],$_POST['idp'] ) );
      }catch(Exceptin $e){
          die('ERREUR : '.$e->getMessage());
      }
    }

?>



<?php
   if(isset($_POST['design']) AND isset($_POST['qteAchete']) AND isset($_POST['prixU']) AND isset($_POST['montant1'])){
       try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $bdd= new PDO('mysql: host=localhost ; dbname=gynecare','root','',$pdo_options);
        $req = $bdd->prepare('INSERT INTO panier2 ( nomP , prixP  , qte ,  montant ,  dateP2 ) VALUES(?,
        ?, ?, ?, NOW())');
        $req->execute(array($_POST['design'] ,$_POST['qteAchete'], $_POST['prixU'] , $_POST['montant1'] ) );
      }catch(Exceptin $e){
          die('ERREUR : '.$e->getMessage());
      }
    }

     header("Location:../clinique/?page=achat");
?>