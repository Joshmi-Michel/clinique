<?php 
  $produits = getProduit();
   $usines = getUsine();
?>
<!--
-->
<style type="text/css">

    .fm{
      min-width:1200px;
      margin-left: 10px;
    }
    #nomProd{
      width:220px;
      border:1px solid rgba(100,100,100,0.3);
      height: 35px;
      text-align: center;
      color: black;
      font-weight: bold;
    }
    #pu1{
      width:220px;
      border:1px solid rgba(100,100,100,0.3);
      height: 35px;
      text-align: center;
      color: black;
      font-weight: bold;
    }
    #qt1{
      width:220px;
      border:1px solid rgba(100,100,100,0.3);
      height: 35px;
      text-align: center;
      color: black;
      font-weight: bold;
    }
    #montant{
      width:220px;
      border:1px solid rgba(100,100,100,0.3);
      height: 35px;
      text-align: center;
      color: black;
      font-weight: bold;

    }
    .tablePanier{
       margin:auto;
       border-collapse:separate;
       text-align: center;
    }
     .number{
      width:50px;
      border:1px solid rgba(100,100,100,0.3);
      height: 35px;
      text-align: center;
      color:black;
      font-weight: bold;
    }
    .acheter{
      background-color:#69b867;
      width:120px;
      height:35px;
      border-color: transparent;
      border-radius:4px 4px 4px 4px;
      color: white;
      font-weight: bold;
    }

    .acheter:hover{
      background-color:#26a123;
        cursor: pointer;
    }

    .vider{
      background-color:#e66262;
      height:35px;
      width:130px;
      color: white;
      border:none;
      border-radius:4px 4px 4px 4px;
      float: right;
      font-size:12px;
      font-weight: bold;
    }
    .vider:hover{
      background-color:red;
    }
   .tot{
      margin-right:50px;
      float: right;
    }
    .select{
      margin-left:750px;
    }
    .ch{
      color:#63756d;
    }
    .ajouter{
        width:100px;
        height:30px;
        background-color:#477bd2;
        border: none;
        border-radius:4px 4px 4px 4px;
        color: white;
        font-size:13px;
        margin-left:40px;
    }
    .ajouter:hover{
      background-color: blue;
    }
    .del{
      width:50px;
      height:30px;
      background-color: #bd2c2c;
      color: white;
      font-size: 20px;
    }
    </style>
    <script type="text/javascript">
        function calculmontant(frm){
          var a=parseInt(document.getElementById("pu1").value);
          var b=parseInt(document.getElementById("qt1").value);
          var c = a*b;
          document.getElementById("montant").value=c;
        }
        function ControlStock(frm){
          var a=parseInt(document.getElementById("stock").value);
          var b=parseInt(document.getElementById("qt1").value);
         if(a<b){
            alert("le stock est insuffisant");
            return false;
          }
        }
    </script>
<!--
-->
<!-- page content -->
   <div id="headerPrint" style="display: none">
    <h4>liste produit </h4>
  </div>
  <div class="right_col" role="main">
    <div class="">           
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

          <?php if (!empty($_SESSION['flash'])):?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?= $_SESSION['flash']['message'] ?>
</div>
            <?php unset($_SESSION['flash']) ?>
          <?php endif; ?>

          <div class="x_panel">
            <div class="x_title">
              <h2>Panier</h2>
            <a href="vider.php" onclick="return(confirm('Voulez-vous vider Panier?'))"><button class="vider">VIDER LE PANIER</button></a>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>                      
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>

            <?php if ($produits == true) {?>

              <div class="x_content">        
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                  
                  </div>
                  <table  width="98%" border="1px" class="tablePanier">
                  <thead bgcolor="yellow">
                    <tr>
                      <!-- <th>
                        <input type="checkbox" id="check-all" class="flat">
                      </th> -->
                      <td>Qté Acheté</td>
                      <td>Désignation</td>                    
                      <td>PU</td>
                      <td>montant</td>    
                      <td>Annuler</td>                        
                    </tr>
                  </thead>

                  <tbody>
                  <?php

                      try{
                          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                          $bdd = new PDO('mysql:host=localhost;dbname=gynecare', 'root', '',
                          $pdo_options);
                          $reponse = $bdd->query('SELECT * FROM panier');
                         $i=0;
                         $somme=0;
                          while ($donnees=$reponse->fetch()){
                            $i++;
                            $qte=$donnees['qteAchete'];
                            $somme=$somme+$qte;
                            ?>
                                 <tr>
                                  <td><?php echo $donnees['qteAchete'] ?> </td>
                                  <td><?php echo $donnees['design'] ?></td>
                                  <td><?php echo $donnees['pu'] ?></td>
                                  <td><?php echo $donnees['montant'] ?> 
                                </td>
                                  <td> <span class="sup"><a   onclick="return confirm('Annuler ce produit?')" href="supprimerPanier.php?id=<?php echo $donnees['id'] ?>&qte=<?php echo $donnees['qteAchete'] ?>&idProPan=<?php echo $donnees['idProPan'] ?>&date=<?php echo $donnees['dateAchat'] ?>" class="btn btn-danger btn-xs delete"><i>X</i></a></span></td>
                               </tr>
                               
                            <?php

                          }
                          
                      }
                          catch(Exception $e)
                          {
                           die('Erreur : '.$e->getMessage());
                      }

                  ?>  
                    
                   
                  </tbody>                    
                </table>
                <br>
                  <?php echo '<span class="select"><strong><span class="ch">'.$somme.'</span> produits ajoutés | </strong></span>'?>
                  <?php
                 
                      try{
                          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                          $bdd = new PDO('mysql:host=localhost;dbname=gynecare', 'root', '',
                          $pdo_options);
                          $reponse = $bdd->query('SELECT sum(montant) FROM panier');
                         
                          $donnees=$reponse->fetch();
                          if(empty($donnees['sum(montant)'])){
                          echo'<div class="tot"><strong >TOTAL : <span class="ch"> 0 Ariary</span> </strong></div><br>';

                          }else{
                          echo'<div class="tot"><strong >TOTAL : <span class="ch">'.$donnees['sum(montant)'].' Ariary</span> </strong></div>';
                          }
                      }
                          catch(Exception $e)
                          {
                           die('Erreur : '.$e->getMessage());
                      }
                        ?>

                <hr>        
          <form name="frm" method="post" action="chance.php"  onsubmit="return ControlStock()" class="fm">
            <input type="text" id="nomProd" name="design" placeholder="Produit" value="<?php if(isset($_GET['nom'])){echo $_GET['nom'] ; } ?>" />
            <input type="text" id="pu1" name="prixU" placeholder="Prix" value="<?php if(isset($_GET['prix'])){echo $_GET['prix'] ; } ?>"/>
            <input type="number" id="qt1" name="qteAchete" placeholder="Saisir Quantité" class="number" onclick="calculmontant()" onkeyup="calculmontant()" required/>
            <input type="text" id="montant" name="montant1" placeholder="Montant (Ariary)" class="number" />
            <input type="hidden" id="stock" value="<?php if(isset($_GET['qte'])){echo $_GET['qte'] ; } ?>"/>
            <input type="hidden" name="idp" id="idProd" value="<?php if(isset($_GET['idPro'])){echo $_GET['idPro'] ; } ?>"/>
            <input type="submit" value="ACHETER" class="acheter" />
                        </form>
                      <hr>        
                  </div>
                    <table id="datatable-buttons" class="table table-striped table-condensed table-bordered dt-responsive nowrap bulk_action" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <!-- <th>
                        <input type="checkbox" id="check-all" class="flat">
                      </th> -->
                      <th>Ref</th>
                      <th>Désignation</th>
                      <th>Fournisseur</th>
                      <th>Quantité en stock</th>
                      <th>Date Peremption</th>
                      <th>Prix unitaire</th>
                      <th></th>
                                               
                    </tr>
                  </thead>

                  <tbody>

                  <?php

                      try{
                          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                          $bdd = new PDO('mysql:host=localhost;dbname=gynecare', 'root', '',
                          $pdo_options);
                          $reponse= $bdd->query('SELECT 
                          produit.refProd,
                          produit.design,
                          produit.qte,
                          produit.peremption,
                          produit.pu,
                          produit.dateEntrer,
                          usine.numU,
                          usine.nomU
                        FROM produit
                        JOIN usine
                        ON produit.numU = usine.numU');
                          $i=0;
                          while ($produits=$reponse->fetch())
                          {
                            $i++;
                            ?>
                                                                 <tr>
                                  <td><?php echo $i ?></td>                     
                                  <td><?php echo $produits['design'] ?></td> 
                                   <td><?php echo $produits['nomU'] ?></td>                                 
                                  <td><span class="badge"><?php echo $produits['qte'] ?></span></td>
                                  <td><?php echo $produits['peremption'] ?></td> 
                                  <td><?php echo $produits['pu'] ?></td>                                     
                                  <td>
 <a href="?page=achat&nom=<?php echo $produits['design'] ?>&prix=<?php echo $produits['pu'] ?>&qte=<?php echo $produits['qte'] ?>&idPro=<?php echo $produits['refProd'] ?>"><button class="btn btn-primary" >Ajouter</button></a>
                                  </td>                
                               </tr>

                            <?php

                          }
                          
                      }
                          catch(Exception $e)
                          {
                           die('Erreur : '.$e->getMessage());
                      }
                  ?>  

                  </tbody>
                </table>
              
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

            <?php }else{ ?>
              <div class="x_content">        
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      Aucun enregistrement pour le moment
                    </div>
                  </div>
                </div>            
              </div>
            <?php } ?>

         



