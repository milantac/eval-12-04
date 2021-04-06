<?php
    require '../functions/bdd.php';
    require '../class/user-class.php';
    $id=$_GET['id'];

    //Initialisation des variables nécessaire
    $statusMsg='';  //affiche le statut du transfert
    $dir='../images/upload/'; //dossier de sauvegarde des images


    if(isset($_POST['submitAvatar']) && !empty($_FILES['img']['name'])){
        //tableau des types de fichiers autourisés
            $allowTypes=array('jpg','png','jpeg','gif','pdf');
        // basename retourne le nom du ficher débarassé du chemin
            $fileName=basename($_FILES['img']['name']);
            $target = $dir.$fileName;
        //retourne l'extension du fichier
            $type = pathinfo($target,PATHINFO_EXTENSION);
            
            if(in_array($type,$allowTypes)){
                if(move_uploaded_file($_FILES['img']['tmp_name'],$target)){
                    $req = $bdd->prepare("UPDATE utilisateur SET avatar=? WHERE id_user=".$id);
                    $req->execute(array($fileName));
                    if($req){
                        header('Location: http://localhost/mvc/index.php?action=listUser&statMsg=1');
                        
                    }else{
                        header('Location: http://localhost/mvc/index.php?action=listUser&statMsg=2');
                        
                    }
                }else{
                    header('Location: http://localhost/mvc/index.php?action=listUser&statMsg=3');
                    
                }
            }else{
                header('Location: http://localhost/mvc/index.php?action=listUser&statMsg=4');
                
            }
    }else{
        header('Location: http://localhost/mvc/index.php?action=listUser&statMsg=5');
        
    }
?>