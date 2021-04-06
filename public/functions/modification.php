<?php
    require '../functions/bdd.php';
    require '../class/user-class.php';
    $id=$_GET['id'];
    $userManager = new UserManager($bdd);
    $myUser=$userManager->get($id);

        if(isset($_POST['submit'])){
            //On verifie que les champs soit remplies et non null
            if($_POST['nom']!=''){
                if($_POST['prenom']!=''){
                    if($_POST['mail']!=''){
                        if(($_POST['oldPassword']!='')&&($_POST['password']!='')&&($_POST['verifPassword']!='')){
                            //si l'ancien mot de passe n'est pas identique à celui de la base de donnée
                            if(password_verify($_POST['oldPassword'],$myUser->password_u())){
                                if(empty($_POST['password'])||($_POST['password']==$_POST['verifPassword'])){
                                    $myUser->setPassword_u(password_hash($_POST['password'],PASSWORD_BCRYPT,['cost'=>12]));
                                    $myUser->setNom_u($_POST['nom']);
                                    $myUser->setPrenom_u($_POST['prenom']);
                                    $myUser->setMail_u($_POST['mail']);
                                    $myUser->setDate_naissance_u($_POST['anniv']);
                                    $userManager->update($myUser);
                                    header('Location: http://localhost/mvc/index.php?action=listUser');
                                }else{
                                    header("Location: http://localhost/mvc/index.php?action=formModif&err=1&id=".$_GET['id']);
                                }
                            }else{
                                header("Location: http://localhost/mvc/index.php?action=formModif&err=2&id=".$_GET['id']);
                            }
                        }else{
                            header("Location: http://localhost/mvc/index.php?action=formModif&err=3&id=".$_GET['id']);
                        }
                    }else{
                        header("Location: http://localhost/mvc/index.php?action=formModif&err=4&id=".$_GET['id']);
                    }
                }else{
                    header("Location: http://localhost/mvc/index.php?action=formModif&err=5&id=".$_GET['id']);
                }
            }else{
                header("Location: http://localhost/mvc/index.php?action=formModif&err=6&id=".$_GET['id']);
            }
            
        }
    ?>