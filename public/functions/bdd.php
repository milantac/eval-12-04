<?php
    //La structure try catch permet de tester si la connexion a bien eu lieu
    try{
        // j'initialise un variable $bdd avec un l'objet PDO qui me permet de me connecter
        $bdd= new PDO('mysql:host=localhost; dbname=livre;charset=utf8','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        /*                     |               |               |                    |=>array le tableau contenant l'option des erreurs 
                               |               |               |=>encryptage chartset=utf8
                               |               |=>dbnam = nom de la base
                               |=> host = l'hôte */

    }catch(Execption $e){
        die('Erreur : '.$e->getMessage());
    /*   |=> permet d'afficher un message et de terminer le script  */
    }
?>