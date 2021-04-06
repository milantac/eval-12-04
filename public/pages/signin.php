<?php
    require 'public/functions/bdd.php';
    require 'public/class/user-class.php';

    $userManager = new UserManager($bdd);
?>
<section class='container-fluid text-center my-5'>
<h1>Identification</h1>
    <form action="" method="post">
        <label for="">email</label>
        <input type="text" name="mail">
        <label for="">mdp</label>
        <input type="password" name="password"> 
        <button type="submit" name="submit">Submit</button>
    </form>
<?php
    if(isset($_POST['submit'])&& isset($_POST['mail'])){
        $user=$userManager->login($_POST['mail']);
        if(!$user){
            echo '<h2>Mauvaise adresse mail</h2>';
        }else{
            echo $user->password_u();
            if (password_verify($_POST['password'],$user->password_u())){
                $_SESSION['mail_u']=$user->mail_u();
                $_SESSION['id_user']=$user->id_user();
                header('Location: http://localhost/mvc/index.php');
            }else{     
                    echo '<h2>Mauvais Mot De Passe</h2>';
            }
        }
    }
?>
</section>
