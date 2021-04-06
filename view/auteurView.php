<table id="tabAuteur" class="table my-3">
    <thead class="table-dark">
        <tr>
            <th>
                <strong>nom </strong>
            </th>
            <th>
                <strong>prenom </strong>
            </th>
            <th>
                <strong>date de naissance </strong>
            </th>
            <th>
                <strong>identifiant Pays </strong>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php echo $author->nom_a(); ?>
            </td>
            <td>
                <?php echo $author->prenom_a(); ?>
            </td>
            <td>
                <?php echo $author->date_naissance_a(); ?>
            </td>
            <td>
                <?php echo $author->id_p(); ?>
            </td>
        </tr>
    </tbody>      
</table>
<div class="row">
    <div class="col-2"></div>
    <a href="index.php?action=listAuteur" class="btn btn-outline-warning col-3">retour</a>
    <div class="col-2"></div>  
    <button id="book" class="btn btn-outline-success col-3" data-id="<?php echo $author->id_a(); ?>">Voir la liste de ses livres</button>
    <div class="col-2"></div>
</div>
<!--    tableau caché qui sera visible apres avoir cliquer sur le boutton   -->
<table id="tabBook" class="table hide my-3">
    <thead class="table-info">
        <tr>
            <th>titre</th>
            <th>année</th>
            <th>résumé</th>
        </tr>
    </thead>
    <tbody id="tabListBook">
                <!-- completer par ajax.js -->
     </tbody>      
</table>
