<?php
   

    if(isset($_GET['qte']) AND isset($_GET['idProPan'])){
       try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $bdd21= new PDO('mysql: host=localhost ; dbname=gynecare','root','',$pdo_options);
        $req2 = $bdd21->prepare('UPDATE produit set qte=(qte+?) WHERE refProd=? ');
        $req2->execute(array($_GET['qte'],$_GET['idProPan'] ) );
      }catch(Exceptin $e){
          die('ERREUR : '.$e->getMessage());
      }
    }
?>
<?php
    if(isset($_GET['id'])){
       try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $bd= new PDO('mysql: host=localhost ; dbname=gynecare','root','',$pdo_options);
        $del = $bd->prepare('DELETE  from panier WHERE id=? ');
        $del->execute(array($_GET['id'] ) );
      }catch(Exceptin $e){
          die('ERREUR : '.$e->getMessage());
      }
    }
?>

<?php
    if(isset($_GET['date'])){
       try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $db= new PDO('mysql: host=localhost ; dbname=gynecare','root','',$pdo_options);
        $drop = $db->prepare('DELETE  from panier2 WHERE dateP2=? ');
        $drop->execute(array($_GET['date'] ) );
      }catch(Exceptin $e){
          die('ERREUR : '.$e->getMessage());
      }
    }
    header("Location:../clinique/?page=achat");
?>


