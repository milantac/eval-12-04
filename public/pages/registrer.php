<?php
    require 'public/functions/bdd.php';
    require 'public/class/user-class.php';

    $userManager = new UserManager($bdd);
?>
<div class="corps">
    <a href="http://localhost/mvc/index.php">Accueil</a>
    <h1>Identification</h1>
    <form action=""  method="post" class="row">
        <div class="col-sm-12 col-md-6 my-2">
            <label for="pseudo">nom</label>
            <input type="text" name="name"> </input>
        </div>
        <div class="col-sm-12 col-md-6 my-2">
            <label for="pseudo">prénom</label>
            <input type="text" name="surname"> </input>
        </div>
        <div class="col-sm-12 col-md-6 my-2">
            <label for="mail">email</label>
            <input type="mail" name="mail"> </input>
        </div>
        <div class="col-sm-12 col-md-6 my-2">
            <label for="date">date d'anniversaire</label>
            <input type="date" name="date"> </input>
        </div>
        <div class="col-sm-12 col-md-6 my-2">
            <label for="password">Mot de passe</label>
            <input type="password" name="password"> </input>
            </div>
        <div class="col-sm-12 col-md-6 my-2">
            <label for="verifPassword">Confirmer votre mot de passe</label>
            <input type="password" name="verifPassword"> </input>
        </div>
        <div class="col-sm-12 my-2">
            <button type="submit" name="submit">Envoyer</button>
        </div>
    </form>
    <?php
        if(isset($_POST['submit'])){
            if($_POST['password']!=''){
                if(($_POST['password']==$_POST['verifPassword'])){
                    $post=  [   'nom_u'=>$_POST['name'],
                                'prenom_u'=>$_POST['surname'],
                                'mail_u'=>$_POST['mail'],
                                'avatar_u'=>NULL,
                                'date_naissance_u'=>$_POST['date'],
                                'password_u'=>password_hash($_POST['password'],PASSWORD_BCRYPT)
                            ];
                    $user=new USER();
                    $user->hydrate($post);
            
                    $userManager->add($user);
                    $_SESSION['mail_u']=$user->mail_u();
                    $_SESSION['id_user']=$user->id_user();
                    header("Location: http://localhost/mvc/public/pages/deconnexion.php");
                }else{
                    echo '<h2>Les mot de passe ne correspondent pas</h2>';
                }
            }else{
                echo '<h2>Vous avez oublié le mot de passe</h2>';
            }
        }
    ?>
</div>