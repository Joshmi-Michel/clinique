<?php  $donnees = getPan2();?>
<style type="text/css">
    .tot{
      color:black;
      font-weight: bold;
    }
    .ch{
      color: red;
      font-size: 15px;
    }

</style>
<!-- page content -->
   <div id="headerPrint" style="display: none">
    <h4>liste transaction </h4>
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
              <h2> les transactions Achats</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>                      
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>

         

              <div class="x_content">        
                
                <table  class="table table-striped table-condensed table-bordered dt-responsive nowrap bulk_action" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <!-- <th>
                        <input type="checkbox" id="check-all" class="flat">
                      </th> -->
                      <th>Numero</th>
                      <th>Produit</th>
                      <th>P.U</th>
                      <th>Qte Commande</th>
                      <th>Montant</th>
                      <th>Jour de l'Achat</th>                          
                    </tr>
                  </thead>

                  <tbody>
                        <?php
                          try{
                              $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                              $bdd = new PDO('mysql:host=localhost;dbname=gynecare', 'root', '',
                              $pdo_options);
                              $reponse = $bdd->query('SELECT * FROM panier2');
                              $i=0;
                              while ($donnees=$reponse->fetch())
                              {
                                $i++;
                                ?>
                                    <tr>
                                        <th><?php echo $i?></th>
                                        <th><?php echo $donnees['nomP']?></th>
                                        <th><?php echo $donnees['prixP']?></th>
                                        <th><?php echo $donnees['qte']?></th>
                                        <th><?php echo $donnees['montant']?></th>
                                        <th> <?=date('d-m-Y à H:i:s',strtotime($donnees['dateP2'])) ?></th>

                                    <tr>
                                <?php
                              }
                              
                          }
                              catch(Exception $e)
                              {
                               die('Erreur : '.$e->getMessage());
                          }
                      ?>

                  </tbody>
                  <tfoot> <?php
                 
                      try{
                          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                          $bdd = new PDO('mysql:host=localhost;dbname=gynecare', 'root', '',
                          $pdo_options);
                          $reponse = $bdd->query('SELECT sum(montant) FROM panier2');
                         
                          $donnees=$reponse->fetch();
                          
                          if(empty($donnees['sum(montant)'])){
                            echo'<div><strong>SOMME TRANSACTION ACHAT:  <span class="ch">0 Ariary</span></strong></div>';;
                          }else{
                               echo'<div><strong >SOMME TRANSACTION ACHAT: <span class="ch">'.$donnees['sum(montant)'].' Ariary</span></strong></div>';
                          }
                         
                          
                      }
                          catch(Exception $e)
                          {
                           die('Erreur : '.$e->getMessage());
                      }
                   



                        ?>
                    
                  </tfoot>
                </table>
                <div align="right"><?php echo $i  ?> Transaction ahat</div>
                <div class="col-md-12 col-sm-12">
                    <a href="supprimerPan2.php"><button type="button" onclick="return confirm('Voulez vous remettre a zero la transaction?')" class="btn btn-primary" data-toggle="modal" >Remettre  le cash a Zero</button>
                    </a>
                  </div>
             </div>
          </div>
           <!--recherche
              SELECT aprov.idAp , aprov.dateAp , aprov.qteAp , produit.refProd , produit.pu FROM aprov JOIN produit ON aprov.prodAprov=produit.refProd;
           -->
           <div class="x_panel">
              <div class="x_title">
                <h2>Depense d' approvisionnement</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">   
                  <table  class="table table-striped table-condensed table-bordered dt-responsive nowrap bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                          <th>Date</th>
                          <th>Produit </th>
                          <th>Nb Approvision</th>
                          <th>PU</th>
                          <th>montant</th>
                      <tr>
                    </thead>
                      <tbody>
                        <?php
                          try{
                              $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                              $bdd = new PDO('mysql:host=localhost;dbname=gynecare', 'root', '',
                              $pdo_options);
                              $reponse = $bdd->query('SELECT aprov.idAp , aprov.dateAp , aprov.qteAp , produit.refProd , produit.design ,produit.pu FROM aprov  JOIN produit ON aprov.prodAprov=produit.refProd ORDER BY idAp DESC');
                              $tot=0;
                              $i=0;
                              while ($donnees=$reponse->fetch())
                              {
                                $i++;
                                $qt=$donnees['qteAp'];
                                $pu=$donnees['pu'];
                                $montant=$qt*$pu;
                                $tot=$tot+$montant;
                                ?>
                                    <tr>
                                        <th> <?=date('d-m-Y à H:i:s',strtotime($donnees['dateAp'])) ?></th>
                                        <th><?php echo $donnees['design']?></th>
                                        <th><span class="badge"><?php echo $donnees['qteAp']?></span></th>
                                        <th><?php echo $donnees['pu']?></th>
                                        <th><?php echo $montant ?></th>
                                    <tr>
                                <?php
                              }

                              
                          }
                              catch(Exception $e)
                              {
                               die('Erreur : '.$e->getMessage());
                          }
                      ?>
                      <tfoot><div><strong>DEPENSE APROVISIONNEMENT :<span class="ch"> <?php echo $tot  ?> Ariary</span></strong></div></tfoot>
                  </tbody>
                  </table>
                  <div align="right"><?php echo $i  ?> aprovisionnement</div>
                  <div class="col-md-12 col-sm-12">
                    <a href="supprimerReaprov.php"><button type="button" onclick="return confirm('Remetre a zero l \' aprovisionnement?')" class="btn btn-primary" data-toggle="modal" >Remettre  le cash a Zero</button>
                    </a>
                  </div>
                  
            </div>
          </div>
          <!--recherche-->
    
           <div class="x_panel">
              <div class="x_title">
                <h2>Verification des Produits </h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">   
                  <table  class="table table-striped table-condensed table-bordered dt-responsive nowrap bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                          <th>Date</th>
                          <th>Produit </th>
                          <th>Nb Approvision</th>
                          <th>PU</th>
                          <th>montant</th>
                      <tr>
                    </thead>
                      <tbody>
                        <?php
                          try{
                              $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                              $bdd = new PDO('mysql:host=localhost;dbname=gynecare', 'root', '',
                              $pdo_options);
                              $reponse = $bdd->query('SELECT aprov.idAp , aprov.dateAp , aprov.qteAp , produit.refProd , produit.design ,produit.pu FROM aprov  JOIN produit ON aprov.prodAprov=produit.refProd ORDER BY idAp DESC');
                              $tot=0;
                              $i=0;
                              while ($donnees=$reponse->fetch())
                              {
                                $i++;
                                $qt=$donnees['qteAp'];
                                $pu=$donnees['pu'];
                                $montant=$qt*$pu;
                                $tot=$tot+$montant;
                                ?>
                                    <tr>
                                        <th> <?=date('d-m-Y à H:i:s',strtotime($donnees['dateAp'])) ?></th>
                                        <th><?php echo $donnees['design']?></th>
                                        <th><span class="badge"><?php echo $donnees['qteAp']?></span></th>
                                        <th><?php echo $donnees['pu']?></th>
                                        <th><?php echo $montant ?></th>
                                    <tr>
                                <?php
                              }

                              
                          }
                              catch(Exception $e)
                              {
                               die('Erreur : '.$e->getMessage());
                          }
                      ?>
                      <tfoot><div><strong>DEPENSE APROVISIONNEMENT :<span class="ch"> <?php echo $tot  ?> Ariary</span></strong></div></tfoot>
                  </tbody>
                  </table>
                  <div align="right"><?php echo $i  ?> aprovisionnement</div>
                        
            </div>
          </div>
        
        </div>
      </div>
    </div>
  </div>  

            
