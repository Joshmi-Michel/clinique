  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="?page=home" class="site_title"><i class="fa fa-drupal"></i>&nbsp;&nbsp; <span> Vente Provande 
              </span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
          
            <!-- /menu profile quick info -->

            <br /> 

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li class="<?= ($_GET['page'] == 'home') ? 'active' : '' ?>"><a href="?page=home"><i class="fa fa-home"></i>Historique</a></li>
                  <li class="<?= ($_GET['page'] == 'usine') ? 'active' : '' ?>"><a href="?page=usine"><i class="fa fa-building"></i>Fournisseur</a></li>        
                  <li class="<?= ($_GET['page'] == 'produit') ? 'active' : '' ?>"><a href="?page=produit"><i class="fa fa-book"></i> Produit </a></li>
                  <li class="<?= ($_GET['page'] == 'stock') ? 'active' : '' ?>"><a href="?page=stock"><i class="fa fa-plus"></i> Réaprovisionement</a></li> 
                  <li class="<?= ($_GET['page'] == 'achat') ? 'active' : '' ?>"><a href="?page=achat"><i class="fa fa-money"></i> Panier</a></li>
                  <li class="<?= ($_GET['page'] == 'facture') ? 'active' : '' ?>"><a href="?page=facture"><i class="fa fa-paperclip"></i>Facture</a></li>  
                  <li class="<?= ($_GET['page'] == 'client') ? 'active' : '' ?>"><a href="?page=client"><i class="fa fa-bell"></i> Transactions </a></li>                  
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
             <!-- <a data-toggle="tooltip" data-placement="top" title="Paramètres">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Plein écran">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" href="?page=backup" data-placement="top" title="Sauvegarde">
                <span class="fa fa-database" aria-hidden="true"></span>
              </a>-->
              <a data-toggle="tooltip" data-placement="top" title="Se déconnecter" href="?page=logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Clinique</b>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="?page=logout"><i class="fa fa-sign-out pull-right"></i> Se déconnecter</a></li>
                  </ul>
                </li>               
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->