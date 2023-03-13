<style type="text/css">
    .tot{
      color:black;
      font-weight: bold;
    }
    .ch{
      color:red;
      font-weight: bold;
      font-size:15px;
    }
    .white{
      color: transparent;
    }
    .tablePanier{
       margin:auto;
       border-collapse:separate;
       text-align: center;
    }
    .toto{
      margin-left:10px;
    }
    
</style>
<!-- page content -->
   <div id="headerPrint" style="display: none">
    <h4>liste transaction</h4>
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
              <h2>facture</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>                      
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">        
                
               <table  width="    98%" border="1px" class="tablePanier">
                  <thead bgcolor="yellow" text-align="center">
                    <tr>
                      <!-- <th>
                        <input type="checkbox" id="check-all" class="flat">
                      </th> -->
                      <td>Qté Acheté</td>
                      <td>Désignation</td>                    
                      <td>PU</td>
                      <td>montant</td>    
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
                          while ($donnees=$reponse->fetch())
                          {
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
                  <tfoot> <?php
                      try{
                          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                          $bdd = new PDO('mysql:host=localhost;dbname=gynecare', 'root', '',
                          $pdo_options);
                          $reponse = $bdd->query('SELECT sum(montant) FROM panier');
                         
                          $donnees=$reponse->fetch();
                          if(empty($donnees['sum(montant)'])){
                          echo'<div class="toto"><strong color="black">TOTAL : <span class="ch"> 0 Ariary</span> </strong></div>';

                          }else{
                          echo'<div class="toto"><strong color="black">TOTAL : <span class="ch">'.$donnees['sum(montant)'].' Ariary</span> </strong></div>';
                          }
                      }
                          catch(Exception $e)
                          {
                           die('Erreur : '.$e->getMessage());
                      }
        
                        ?>
                  </tfoot>
                </table><br>

                <div class="col-md-12 col-sm-12">
                    <a href="imprimer.php"><button  type="button" class="btn btn-primary" data-toggle="modal" >IMPRIMER FACTURE</button>
                    </a>
                  </div>
              </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>

            

