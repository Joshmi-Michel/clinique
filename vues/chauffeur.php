<?php 
  $chaufs = getChauf();
?>
<!-- page content -->
   <div id="headerPrint" style="display: none">
    <h4>Liste des Voitures </h4>
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
              <h2>Voitures</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>                      
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <?php if ($chaufs == true) {?>
              <div class="x_content">        
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNew">Ajouter nouvelle voiture</button>
                  </div>
                </div>
                <hr>
                <table id="datatable-buttons" class="table table-striped table-condensed table-bordered dt-responsive nowrap bulk_action" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <!-- <th>
                        <input type="checkbox" id="check-all" class="flat">
                      </th> -->
                      <th>Numero</th>
                      <th>Nom Chauffeur</th>
                      <th>Imm Voiture</th>
                      <th>Disponible</th>
                      <th></th>                          
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($chaufs as $chauffeur):?>
                    <tr>
                      <!-- <td class="a-center">
                        <input type="checkbox" class="flat" name="table_records">
                      </td> -->
                      <td><?= $chauffeur->numChauf ?></td>
                      <td><?= ucwords($chauffeur->nomChauf) ?></td>                   
                      <td><?= ucwords($chauffeur->immVtr) ?></td>                      
                      <td><span class="badge"><?= ($chauffeur->dispo == 1) ? 'Oui' : 'Non' ?></span></td>                                        
                      <td>
                         <div class="btn-group" role="group" aria-label="...">                         
                          <button type="button" id="<?= $chauffeur->numChauf ?>" data-toggle="modal" data-target="#edit" class="btn btn-info btn-xs editLec"><i class="glyphicon glyphicon-pencil"></i></button>
                          <button type="button" data-toggle="modal" data-target="#delete" id="<?= $chauffeur->numChauf ?>" class="btn btn-danger btn-xs delete"><i class="glyphicon glyphicon-trash"></i></button>
                        </div>  
                      </td>
                    </tr>  

                  <?php endforeach; ?>   

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNew">Ajouter nouvelle voiture</button>
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
        <h4 class="modal-title" id="myModalLabel">Ajout d'une nouvelle voiture</h4>
      </div>
      <div class="modal-body">
        <div class="notifAdd"></div>
        <p>Veuillez remplir ce champ pour ajouter une voiture</p>

        <form id="chauffeurForm" method="post"> 
          <div class="form-group">
            <input type="text" class="form-control" id="nomChauf" placeholder="Nom Chauffeur">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="immVtr" placeholder="Immatricule voiture">
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
        <h4 class="modal-title" id="myModalLabel">Edition d'une voiture</h4>
      </div>
      <div class="modal-body">
        <div class="notifUpdate"></div>          
        <p>Modifier la valeur du champ pour editer une voiture</p>
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
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Suppression d'un chauffeur</h4>
      </div>
      <div class="modal-body">
        <div class="notifDel"></div>
        <p>Vous voulez vraiment supprimer cette enregistrement !</p>          
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
