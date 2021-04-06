<?php
     // j'initialise un variable $bdd avec un l'objet PDO qui me permet de me connecter
     $bdd= new PDO('mysql:host=localhost;dbname=livre;charset=utf8','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $req= $bdd->prepare(    "   SELECT titre_l, annee_l, resume_l, id_a
                                FROM livre, rediger
                                WHERE livre.id_l=rediger.id_l
                                AND rediger.id_a= ?"
                        );
    $req->execute(array($_GET['id']));

    $tab=[];
    while($donnees=$req->fetch(PDO::FETCH_ASSOC)){
        $tab[]=$donnees;
    }
    header('Content-Type: application/json');
    echo json_encode($tab);
    exit;
?>