<?php 
  $produits = getProduit();
  $usines = getUsine();
?>
<style type="text/css">
  .white{
    color: transparent;
  }
</style>
<!-- page content -->
   <div id="headerPrint" style="display: none">
    <h4>Liste des produits </h4>
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
              <h2>Produits</h2>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNew">Ajouter nouveau produit</button>
                  </div>
                </div>
                <hr>
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
                      <th>Actions</th>
                                               
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
                                        <div class="btn-group" role="group" aria-label="...">                         
                                            <button type="button" id="<?php echo $produits['refProd'] ?>" data-toggle="modal" data-target="#edit" class="btn btn-info btn-xs editLec"><i class="glyphicon glyphicon-pencil"></i></button>
                                            <button type="button" data-toggle="modal" data-target="#delete" id="<?php echo $produits['refProd'] ?>" class="btn btn-danger btn-xs delete"><i class="glyphicon glyphicon-trash"></i></button>
                                       </div>  
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNew">Ajouter nouveau produit</button>
                    <hr>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      Aucun enregistrement pour le moment
                    </div>
                  </div>
                </div>            
              </div>
            <?php } ?>


<!-- Add new modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Ajout d'un nouveau produit</h4>
      </div>
      <div class="modal-body">
        <div class="notifAdd"></div>
        <p>Veuillez remplir ce champ pour ajouter un produit</p>

        <form id="produitForm" method="post"> 
          <div class="form-group">
            <select id="numU" class="form-control">
              <option selected disabled>---- Séléctionner le fournisseur ----</option>
              <?php foreach ($usines as $usine):?>
                <option value="<?= $usine->numU ?>"><?= ucwords($usine->nomU) ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" name="design" class="form-control" id="design" placeholder="Désignation">
          </div>
          <div class="form-group">
            <input type="number" name="qte" class="form-control" id="qte" placeholder="Quantité">
          </div>
          <div class="form-group">
            <input type="text" name="peremption" class="form-control" id="peremption" placeholder="Date peremption des produits">
          </div>
          <div class="form-group">
            <input type="text" name="pu" class="form-control" id="pu" placeholder="Prix unitaire (Ariary)">
          </div>          
          </div>
          <div class="modal-footer">
            <div class="btn-group">
              <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary">Ajouter</button>          
            </div>
          </div>
        </form>

    </div>
  </div>
</div>


<!-- Edit modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edition d'un produit</h4>
      </div>
      <div class="modal-body">
        <div class="notifUpdate"></div>          
        <h4>Modifier la valeur du champ pour editer un produit</h4>
        <form id="editForm" method="post"> 
          <div class="notifEdit"></div>          
      </div>
      <div class="modal-footer">
        <div class="btn-group">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Valider</button>          
        </div>
      </div>
        </form>

    </div>
  </div>
</div>

<!-- Delete modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Suppression d'un produit</h4>
      </div>
      <div class="modal-body">
        <div class="notifDel"></div>
        <h4>Vous voulez vraiment supprimer cette enregistrement !</h4>          
      </div>
      <div class="modal-footer">
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Non</button>
            <button type="button" id="deleteConfirm" class="btn btn-primary btn-sm">Oui</button>          
        </div>
      </div>

    </div>
  </div>
</div>
