<?php
   

    try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $bdd=new PDO('mysql:host=localhost; dbname=gynecare', 'root','',$pdo_options);
        $bdd->exec('DELETE FROM aprov');
      
        
    }catch(Exception $e){
        die('ERREUR : '.$e->getMessage());
    }



    header("Location:../clinique/?page=client");
?>