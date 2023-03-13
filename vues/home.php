<?php 
  $produits = getProduit();
  $usines = getUsine();
?>
<style type="text/css">
  .qte{
    color: red;
    font-weight: bold;
  }

  .badge1{
    width:80px;
    height: 20px;
    background-color: red;
    font-size: 20px;
    color: white;
    border-radius: 20px 20px 20px 20px;
    margin-left: 60px;
  }
</style>
<!-- page content -->
   <div id="headerPrint" style="display: none">
    <h4>liste des produits en failles</h4>
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
              <h2>Produit en Faillles</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>                      
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">        
                <br>
                <table id="datatable-buttons" class="table table-striped table-condensed table-bordered dt-responsive nowrap bulk_action" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <!-- <th>
                        <input type="checkbox" id="check-all" class="flat">
                      </th> -->
                      <th><span>Désignation</th>
                      <th>Fournisseur</th>
                      <th>Quantité Critique</th>
                      <th>Prix unitaire</th>                 
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($produits as $produit):?>
                    <tr>
                      <!-- <td class="a-center">
                        <input type="checkbox" class="flat" name="table_records">
                      </td> -->
                      <td><span class="qte"><?= ucwords($produit->design) ?></span></td>                      
                      <td><?= ucwords($produit->nomU) ?></td>                      
                      <td><span class="badge1"><?= ucwords($produit->qte) ?></span></td>      
                      <td><?= ucwords($produit->pu) ?> Fmg</td>                      
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

            