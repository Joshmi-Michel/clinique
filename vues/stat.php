<?php 
  $lecteurDays = getInsertedDay('lecteur','created_at');
  $livreDays = getInsertedDay('livre','created_at');
  $pretDays = getInsertedDay('pret','datePret');
  $backPretDays = getInsertedDay('pret','dateRetour');


  $Leclundi = $Lecmardi = $Lecmardi = $Lecmercredi = $Lecjeudi = $Lecvendredi = $Lecsamedi = $Lecdimanche = 0;
  $Livlundi = $Livmardi = $Livmardi = $Livmercredi = $Livjeudi = $Livvendredi = $Livsamedi = $Livdimanche = 0;
  $Pretlundi = $Pretmardi = $Pretmardi = $Pretmercredi = $Pretjeudi = $Pretvendredi = $Pretsamedi = $Pretdimanche = 0;
  $Backlundi = $Backmardi = $Backmardi = $Backmercredi = $Backjeudi = $Backvendredi = $Backsamedi = $Backdimanche = 0;

  foreach ($lecteurDays as $lecteurDay) {
    if(strftime("%A",strtotime($lecteurDay->created_at)) == 'lundi'){
      $Leclundi += 1;
    }
    if(strftime("%A",strtotime($lecteurDay->created_at)) == 'mardi'){
      $Lecmardi += 1;
    }
    if(strftime("%A",strtotime($lecteurDay->created_at)) == 'mercredi'){
      $Lecmercredi += 1;
    }
    if(strftime("%A",strtotime($lecteurDay->created_at)) == 'jeudi'){
      $Lecjeudi += 1;
    }
    if(strftime("%A",strtotime($lecteurDay->created_at)) == 'vendredi'){
      $Lecvendredi += 1;
    }
    if(strftime("%A",strtotime($lecteurDay->created_at)) == 'samedi'){
      $Lecsamedi += 1;
    }
    if(strftime("%A",strtotime($lecteurDay->created_at)) == 'dimanche'){
      $Lecdimanche += 1;
    }
  }

  foreach ($livreDays as $livreDay) {
    if(strftime("%A",strtotime($livreDay->created_at)) == 'lundi'){
      $Livlundi += 1;
    }
    if(strftime("%A",strtotime($livreDay->created_at)) == 'mardi'){
      $Livmardi += 1;
    }
    if(strftime("%A",strtotime($livreDay->created_at)) == 'mercredi'){
      $Livmercredi += 1;
    }
    if(strftime("%A",strtotime($livreDay->created_at)) == 'jeudi'){
      $Livjeudi += 1;
    }
    if(strftime("%A",strtotime($livreDay->created_at)) == 'vendredi'){
      $Livvendredi += 1;
    }
    if(strftime("%A",strtotime($livreDay->created_at)) == 'samedi'){
      $Livsamedi += 1;
    }
    if(strftime("%A",strtotime($livreDay->created_at)) == 'dimanche'){
      $Livdimanche += 1;
    }
  }

  foreach ($pretDays as $pretDay) {
    if(strftime("%A",strtotime($pretDay->datePret)) == 'lundi'){
      $Pretlundi += 1;
    }
    if(strftime("%A",strtotime($pretDay->datePret)) == 'mardi'){
      $Pretmardi += 1;
    }
    if(strftime("%A",strtotime($pretDay->datePret)) == 'mercredi'){
      $Pretmercredi += 1;
    }
    if(strftime("%A",strtotime($pretDay->datePret)) == 'jeudi'){
      $Pretjeudi += 1;
    }
    if(strftime("%A",strtotime($pretDay->datePret)) == 'vendredi'){
      $Pretvendredi += 1;
    }
    if(strftime("%A",strtotime($pretDay->datePret)) == 'samedi'){
      $Pretsamedi += 1;
    }
    if(strftime("%A",strtotime($pretDay->datePret)) == 'dimanche'){
      $Pretdimanche += 1;
    }
  }

  foreach ($backPretDays as $backPretDay) {
    if(strftime("%A",strtotime($backPretDay->dateRetour)) == 'lundi'){
      $Backlundi += 1;
    }
    if(strftime("%A",strtotime($backPretDay->dateRetour)) == 'mardi'){
      $Backmardi += 1;
    }
    if(strftime("%A",strtotime($backPretDay->dateRetour)) == 'mercredi'){
      $Backmercredi += 1;
    }
    if(strftime("%A",strtotime($backPretDay->dateRetour)) == 'jeudi'){
      $Backjeudi += 1;
    }
    if(strftime("%A",strtotime($backPretDay->dateRetour)) == 'vendredi'){
      $Backvendredi += 1;
    }
    if(strftime("%A",strtotime($backPretDay->dateRetour)) == 'samedi'){
      $Backsamedi += 1;
    }
    if(strftime("%A",strtotime($backPretDay->dateRetour)) == 'dimanche'){
      $Backdimanche += 1;
    }
  }
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">           
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Statistique <small class="badge">En une semaine</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>                      
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">              
          <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
              <div class="x_panel">                
                <div class="x_content">
            <div id="echart_line" style="height:350px;"></div>
          </div>
        </div>
      </div>
          </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->