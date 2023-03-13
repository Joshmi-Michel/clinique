<?php 
  $years = [
    '2010' => '2010',
    '2011' => '2011',
    '2012' => '2012',
    '2013' => '2013',
    '2014' => '2014',
    '2015' => '2015',
    '2016' => '2016',
    '2017' => '2017'
  ];

  $months = [
    '1' => 'Janvier',
    '2' => 'Février',
    '3' => 'Mars',
    '4' => 'Avril',
    '5' => 'Mai',
    '6' => 'Juin',
    '7' => 'Juillet',
    '8' => 'Août',
    '9' => 'Septembre',
    '10' => 'Octobre',
    '11' => 'Novembre',
    '12' => 'Décembre'
  ];
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php 
          if (!empty($errors)) {
            foreach ($errors as $error) {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?= $error ?>
            </div>
            <?php
            }
          } 
         ?>
         <?php if (!empty($_SESSION['flash'])):?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <?= $_SESSION['flash']['message'] ?>
</div>
            <?php unset($_SESSION['flash']) ?>
          <?php endif; ?>
        <div class="x_panel">
          <div class="x_title">
            <h2>Prêt | Recherche avancée</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>              
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <a class="btn btn-warning pull-right" href="?page=pret"><i class="fa fa-share">&nbsp;</i>Retour a la liste</a>
            <a class="btn btn-default pull-right" href="?page=recherchePret"><i class="fa fa-refresh">&nbsp;</i>Actualiser</a>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-md-2">
                <span>Sélectionner un option de Recherche <i class="fa fa-hand-o-right">&nbsp;</i></span>
              </div>
              <div class="col-md-2">
              <form method="post" id="searchForm">
                <select class="form-control" id="rechercheOpt" name="rechercheOpt">
                  <option selected disabled>---- Entre ----</option>
                  <option value="year">Entre deux année</option>
                  <option value="month">Entre deux mois</option>
                  <option value="custom">Personnaliser</option>
                </select>
              </div>
                <div id="result">
                  <div class="year" style="display: none;">
                    <div class='col-md-3'>
                      <select class='form-control' id='debutAnnee' name="debutAnnee">
                        <option selected disabled>----- Année debut --------</option>
                        <?php foreach($years as $y=>$year): ?>
                          <option value="<?= $y ?>"><?= $year ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class='col-md-3'>
                      <select class='form-control' id='finAnnee' name="finAnnee">
                        <option selected disabled>----- Année fin --------</option>
                        <?php foreach($years as $y=>$year): ?>
                          <option id="<?= $y ?>" value="<?= $y ?>"><?= $year ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="month" style="display: none;">
                    <div class='col-md-3'>
                      <select class='form-control' id='debutMois' name="debutMois">
                        <option selected disabled>----- Mois debut --------</option>
                        <?php foreach($months as $m=>$month): ?>
                          <option value="<?= $m ?>"><?= $month ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class='col-md-3'>
                      <select class='form-control' id='finMois' name="finMois">
                        <option selected disabled>----- Mois fin --------</option>
                        <?php foreach($months as $m=>$month): ?>
                          <option id="<?= $m ?>" value="<?= $m ?>"><?= $month ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="custom" style="display: none;">
                    <div class='col-md-3'>                      
                      <input class="form-control has-feedback-left debut" id="single_cal3" placeholder="First Name" name="debutCustom" aria-describedby="inputSuccess2Status3" type="text">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                    </div>  
                    <div class='col-md-3'>                      
                      <input class="form-control has-feedback-left fin" id="single_cal4" placeholder="First Name" name="finCustom" aria-describedby="inputSuccess2Status3" type="text">
                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                    </div>    
                  </div>
                </div>
                
              <div class="col-md-2">
                <button class="btn btn-info" id="search" name="search" type="submit" style="display: none">Rechecher</button>
              </div>             
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
          <?php if ($results != 1 && $results == true){?>
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NumLec</th>
                  <th>Lecteur</th>
                  <th>Livre</th>
                  <th>Auteur</th>
                  <th>Date Edition</th>
                  <th>Date Prêt</th>
                  
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($results as $result):?>
                    <div id="headerPrint" style="display: none;">
                      <?php if($_POST['rechercheOpt'] == 'year') :?>
                        <h4>Pret entre l'année <?= $_POST['debutAnnee'] ?> et l'année <?= $_POST['finAnnee'] ?></h4> 
                      <?php endif; ?> 
                      <?php if($_POST['rechercheOpt'] == 'custom') :?>
                        <h4>Pret entre la date <?= date('d-m-Y',strtotime($_POST['debutCustom'] ))?> et la date <?= date('d-m-Y',strtotime($_POST['finCustom'] ))?></h4> 
                      <?php endif; ?>
                      <?php if($_POST['rechercheOpt'] == 'month') :?>
                        <h4>Pret entre le mois de 
                          <?= convertMonth($_POST['debutMois'])?>
                          et le mois de
                          <?= convertMonth($_POST['finMois'])?>                   
                        </h4>
                      <?php endif; ?>                    
                    </div>
                    <tr>
                      <td><?= $result->numPret ?></td>
                      <td><?= $result->numLecteur ?></td>
                      <td><?= ucwords($result->nomLecteur) ?></td>
                      <td><?= ucwords($result->titre) ?></td>
                      <td><?= ucwords($result->auteur) ?></td>
                      <td><?= date('d-m-Y',strtotime($result->dateEdition)) ?></td>
                      <td><?= date('d-m-Y',strtotime($result->dateEdition)) ?></td>
                      
                      <td>
                        <div class="btn-group" role="group" aria-label="...">
                          <button type="button" id="<?= $result->numPret ?>" data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm editPret"><i class="glyphicon glyphicon-pencil"></i></button>
                          <button type="button" data-toggle="modal" data-target="#delete" id="<?= $result->numPret ?>" value="<?= $result->numLivre ?>" val="<?= $result->numLecteur ?>" class="btn btn-danger btn-sm delete"><i class="glyphicon glyphicon-trash"></i></button>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  
              </tbody>
            </table>
          <?php }elseif(empty($results)){?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              Aucun résultat trouvé
            </div>
          <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

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