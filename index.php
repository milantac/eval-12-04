<?php
    
//inclure le fichier d'entête
	include("header.php");
?>
    <section class='container-fluid text-center my-5'>
<?php
    require 'controller/controller.auteur.php';
    if(isset($_GET['action'])){
        $action=$_GET['action'];
        switch ($action){
            case 'signin':
                include("public/pages/signin.php");
            break;
            case 'listAuteur':
                listAuthors();
            break;
            case 'auteur':{
                if(isset($_GET['id'])){
                    author();
                }else{
                    echo 'pas d\'identifiant selectionné';
                }
            break;
            }
            case 'listUser':
                include("public/pages/users.php");
            break;
            case 'formModif':
                include("public/pages/formModif.php");
            break;
            case 'registrer':
                include("public/pages/registrer.php");
            break;
            case 'suppr':
                include("public/pages/suppression.php");
            break;
            case 'formEmail':
                include("public/pages/formEmail.php");
            break;
            default:
                echo'Error: Unknown value of action';
            break;
        }
    }else{
        if(isset($_SESSION['id_user'])){
            echo '  
                <div class="row">
                    <h2 class="col-12">
                        Bienvenu
                    </h2>
                </div>
            ';
        }else{
            echo '  
                    <div class="row">
                        <h2 class="col-12">
                            Bienvenu
                        </h2>
                        <hr>
                        <h3>
                            Veuillez-vous connecter
                            <br>
                            ou
                            <br>
                            vous Enregistrer
                        </h3>
                    </div>
                ';
        }
    }
?>  
    </section>      
<?php
//inclure le fichier d'entête
	include("footer.php");
?>