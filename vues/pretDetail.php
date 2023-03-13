<?php if(!empty($_GET['numLecteur'])){ ?>
<?php 
  $numLecteur = htmlspecialchars(trim(intval($_GET['numLecteur'])));
  $prets = getPretDetail($numLecteur);
  $nbPrets = getNbPret($numLecteur);
  foreach ($nbPrets as $nbPret) {}
?>

<!-- page content -->    
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
          <div class="notifAjax"></div>
          <div class="x_panel">
            <div class="x_title">
              <h2>Détails du Prêt du Lecteur
              </h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>                      
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <a class="btn btn-warning pull-right" href="?page=pret"><i class="fa fa-share">&nbsp;</i>Retour a la liste</a>
              <div class="clearfix"></div>
            </div>

            <?php if ($prets == true) {?>

              <div class="x_content">        
                <div class="row">
                  <div class="col-md-12 col-sm-12 well">
                  <?php foreach ($prets as $pret) {} ?>
                      <p class=""><span><b>Numero :</b>&nbsp;&nbsp;</span><?= ucwords($pret->numLecteur) ?>&nbsp;</p>
                      <p class=""><span><b>Nom :</b>&nbsp;&nbsp;</span><?= ucwords($pret->nomLecteur) ?>&nbsp;</p>
                      <p class=""><span><b>Nombre de livre Prêté :</b>&nbsp;&nbsp;</span><?= ucwords($nbPret->nbPret) ?>&nbsp;</p>
                  </div>
                </div>
                <table id="datatable-buttons" class="table table-striped table-condensed table-bordered dt-responsive nowrap bulk_action" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <!-- <th>
                        <input type="checkbox" id="check-all" class="flat">
                      </th> -->
                      <th>NumPret</th>
                      <th>Livre</th>
                      <th>Auteur</th>
                      <th>Date Edition</th>
                      <th>Date Prêt</th>
                      <th></th>                          
                    </tr>
                  </thead>

                  <tbody>

                  <?php foreach ($prets as $pret):?>
                      <div id="headerPrint" style="display: none;">
                        <h4>Situation d'un Prêt</h4>
                        <p>N°Lecteur<span>:&nbsp;&nbsp;</span><?= $pret->numLecteur ?></p>
                        <p>Nom Lecteur<span>:&nbsp;&nbsp;</span><?= ucwords($pret->nomLecteur) ?></p>
                        <p>Nombre de Livre Prêté<span>:&nbsp;&nbsp;</span><?= ucwords($nbPret->nbPret) ?></p>
                      </div>
                    <tr>
                      <!-- <td class="a-center">
                        <input type="checkbox" class="flat" name="table_records">
                      </td> -->
                      <td><?= $pret->numPret ?></td>                        
                      <td><?= ucwords($pret->titre) ?></td>                         
                      <td><?= ucwords($pret->auteur) ?></td>                         
                      <td><?= date('d-m-Y',strtotime($pret->dateEdition)) ?></td>                     
                      <td><?= date('d-m-Y',strtotime($pret->datePret)) ?></td>                         
                      <td>
                        <div class="btn-group" role="group" aria-label="...">
                          <button type="button" id="<?= $pret->numPret ?>" data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm editPret"><i class="glyphicon glyphicon-pencil"></i></button>
                          <button type="button" data-toggle="modal" data-target="#delete" id="<?= $pret->numPret ?>" value="<?= $pret->numLivre ?>" val="<?= $pret->numLecteur ?>" class="btn btn-danger btn-sm delete"><i class="glyphicon glyphicon-trash"></i></button>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNew">Ajouter nouveau Prêt</button>
                    <hr>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      Aucun enregistrement pour le moment
                    </div>
                  </div>
                </div>            
              </div>
            <?php } ?>



<!-- Edit modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edition d'un Prêt</h4>
      </div>
      <div class="modal-body">
        <div class="notifUpdate"></div>
        <p>Modifier la valeur du champ pour editer un Prêt</p>
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
        <h4 class="modal-title" id="myModalLabel">Suppression d'un Prêt</h4>
      </div>
      <div class="modal-body">
        <div class="notifDel"></div>
        <p>Vous voulez vraiment supprimer cette enregistrement !</p>          
      </div>
      <div class="modal-footer">
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Non</button>
            <button type="button" id="deleteConfirm" data-dismiss="modal" class="btn btn-primary btn-sm">Oui</button>          
        </div>
      </div>

    </div>
  </div>
</div>


<!-- Details modal -->
<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <div class="notifDetail"></div>          
      </div>
    </div>
  </div>
</div>

<?php }else{
    ?>
    <script type="text/javascript">
      window.location.replace('?page=pret');
    </script>
    <?php
    die();
    } ?>