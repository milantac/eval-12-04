<?php
    require 'public/functions/bdd.php';
    require 'public/class/user-class.php';
    $userManager = new UserManager($bdd); 
?>

<div class="corps">
    <h2>Utilisateur</h1>
    <?php
        $users=$userManager->getAll();
    ?>
    <table class="table borderPerso">
        <thead class="bg-info">
            <th>Identifiant</th>
            <th>avatar</th>
            <th>Nom - Prenom</th>
            <th>Mail</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </thead>
        <tbody class="bg-white">
            <?php
                foreach ($users as $value){
                    echo '
                        <tr>
                            <td>'.$value->id_user().'</td>
                            <td><img src="http://localhost/mvc/public/images/upload/'.$value->avatar().'" alt="avatar" class="imgAvatar"></td>
                            <td>'.$value->nom_u().' - '.$value->prenom_u().'</td>
                            <td>'.$value->mail_u().'</td>
                            <td>
                                <a href="http://localhost/mvc/index.php?action=formModif&id='.$value->id_user().'">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a href="http://localhost/mvc/index.php?action=suppr&id='.$value->id_user().'">
                                    <i class="fas fa-user-slash"></i>
                               </a>
                            </td>
                        </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
</div>
<?php

if(isset($_GET['statMsg'])){
    echo '<div class="corps">';
    switch(isset($_GET['statMsg'])){
        case '1':
            echo '<p>Le fichier a bien été chargé</p>';
        break;
        case '2':
            echo '<p>Le fichier n\'a pas été enregistré</p>';
        break;
        case '2':
            echo '<p>Erreur lors du chargement du fichier</p>';
        break;
        case '2':
            echo '<p>Types non autorisés!</p>';
        break;
        case '5':
            echo '<p>Selectionner un fichier à charger</p>';
        break;
    }
    echo '</div>';
}