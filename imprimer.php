<!DOCTYPE html>
<htlm>
  <head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="cachet.css">
    <script type="text/javascript">
    function validation(frm){
      var txt = document.frm.val.value;
      if(txt!="OK"){
        alert("vous pouvez pas continuer l'inscription");

      }

    }
    function printContent(el){
      var restorepage=document.body.innerHTML;
      var printContent=document.getElementById(el).innerHTML;
      document.body.innerHTML=printContent;
      window.print();
      document.body.innerHTML=restorepage;
    }
      
    </script>
  </head>

<style type="text/css">
  .imprim{
      background-color:green;
      width:120px;
      height:35px;
      border-color: transparent;
      border-radius: 5px 5px 5px 5px;
      color: white;
      margin-left:50px;
      font-weight: bold;
  }
  .imprim:hover{
    background-color:#125510;
    cursor: pointer;
  }
.retour{
      background-color:green;
      width:120px;
      height:35px;
      border-color: transparent;
      border-radius: 5px 5px 5px 5px;
      color: white;
      margin-left:05px;
  }
  td{
    text-align: center;
  }
  .retour:hover{
    background-color:#125510;
    cursor: pointer;
  }
.tot{
  margin-right:100px;
}
  #div1{
    width:900px;
    margin: auto;
    font-family: monospace;
    align:center;
  }
  .bordure{
    width: 1000px;
    margin:auto;
    border:1px solid black;
  }

  .th{
    text-align: center;
    position: fixed;
  }
 
</style>

  <body>


    <div class="bordure"> 
        <div id="div1">
          
            <h2 align="left" font-family="monoscape">CLINIQUE  </br> NIF 5001 493 291</br> Stat: 8601 12 2014 00062 </br> Tel: 033 15 465 44 </h2>
            <h1 align="center">FACTURE</h1>

            <h2 >Dat&eacute; le .....................</br> 
                Doit: .......................</h2>
                  <table width="95%" border="1px">
                  <thead>
                    <tr>
                      <!-- <th>
                        <input type="checkbox" id="check-all" class="flat">
                      </th> -->
                      <th>Quantit&eacute; </th>
                      <th>D&eacute;signation</th>                    
                      <th>PU</th>
                      <th>Montant</th>                          
                    </tr>
                  </thead>

                  <tbody>

                  
                  <?php
                      try{
                          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                          $bdd = new PDO('mysql:host=localhost;dbname=gynecare', 'root', '',
                          $pdo_options);
                          $reponse = $bdd->query('SELECT * FROM panier');
                         
                          while ($donnees=$reponse->fetch())
                          {
                            ?>
                              <tr>
                                  <th><?php echo $donnees['qteAchete'] ?></th>
                                  <th><?php echo $donnees['design'] ?></th>
                                  <th><?php echo $donnees['pu'] ?></th>
                                  <th><?php echo $donnees['montant'] ?></th>
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
                 <?php
                 
                      try{
                          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                          $bdd = new PDO('mysql:host=localhost;dbname=gynecare', 'root', '',
                          $pdo_options);
                          $reponse = $bdd->query('SELECT sum(montant) FROM panier');
                         
                          $donnees=$reponse->fetch();
                          echo'<div  class="tot">TOTAL: <strong>'.$donnees['sum(montant)'].' Ariary</strong></div>';
                          
                      }
                          catch(Exception $e)
                          {
                           die('Erreur : '.$e->getMessage());
                      }
            
                ?>
              <?php 
                  require_once 'vues/chiffreEnLettre.php'; 
                  $conversion  = new ChiffreEnLettre();
                  $data = $donnees['sum(montant)'];
                ?>
            <h4>Arret&eacute; cette pr&eacute;sence facture &agrave; la somme de: &nbsp; <?php echo  '<i class="lettre">'.$conversion->conversion($data).'</i>';?> Ariary
            </h4>
      </div>

      <button onclick="printContent('div1')" class="imprim">Imprimer</button> <a href="javascript:history.back()"><button class="retour" >Annuler</button></a><br><br>
    </div>
  </body>




    
   
