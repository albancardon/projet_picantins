
<?php 
$modifBdd = isset($_SESSION['modif'])?$_SESSION['modif']:'';
if (isset($modifBdd)&& $modifBdd == "ok"){
    echo'
        <script language=javascript>
            alert(\'Action effectuer.\');
        </script> ';
}elseif(isset($modifBdd)&& $modifBdd == "no"){
    echo'
        <script language=javascript>
            alert(\'Action non effectuer!\');
        </script> ';
    
}elseif(isset($modifBdd)&& $modifBdd == "errorKey"){
    echo'
        <script language=javascript>
            alert(\'Suppression impossible: element non vide!\');
        </script> ';
    
}elseif(isset($modifBdd)&& $modifBdd == "noCatAbs"){
    echo'
        <script language=javascript>
            alert(\'Erreur: nom de catégorie absent!\');
        </script> ';
    
}
?>
<body id="pageGestionProduits" class="bodyCommon">
    <div id="js__mainContent">
        <h1 class="titlePage">Gestion des produits</h1>
        <main class="part">
            <h2 class="title-chap ombre">Ajout Produit</h2>
            <form class="form-box ombre" action="produitBdd"
            enctype="multipart/form-data" method="post">
                <div class="form-group-haut-bas">
                    <label class="legend-form" for="name-product">Nom Du Produit</label>
                    <select name="name-product" id="choose-product" class="form-champ majDbutMot visible" required>
                        <option value="">Choisissez un produit</option>
                        <?php foreach ($contenuTab['produit'] as $produit): ?>
                            <option value="cat-<?= $produit->getCategorie_idCategorie()?>-prod-<?= $produit->getIdProduit()?>-<?= $produit->getNomProduit()?>-poids-">
                                <?= $produit->getNomProduit()?>
                            </option>
                        <?php endforeach; ?>
                        <option class="form-modif-categorie" value="modif">
                            nouveau produit
                        </option>
                    </select>
                    <input class="form-champ hidden" type="text" id="name-product"
                    placeholder="Entrer nom du nouveau produit" pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}"/>
                </div>
    
                <div class="form-group">
                    <label class="legend-form" for="category-product">Catégorie Du Produit</label>
                    <select name="category-product" id="category-product" class="form-champ majDbutMot" required>
                        <option value="">Choisissez une catégorie</option>
                        <?php foreach ($contenuTab['categorie'] as $categorie): ?>
                            <option id="<?= $categorie->getIdCategorie()?>" 
                            value="<?= $categorie->getIdCategorie()?>-<?= $categorie->getNomCategorie()?>">
                                <?= $categorie->getNomCategorie()?>
                            </option>
                        <?php endforeach; ?>
                        <option class="form-modif-categorie" value="modif">
                            ajout/modification catégorie
                        </option>
                    </select>
                </div>
    
                <div class="form-group">
                    <label class="legend-form" for="size-product">Taille Du Produit</label>
                    <input class="form-champ" type="text" name="size-product" id="size-product" pattern="[0-9]{3,20}" required value=""/>
                </div>
    
                <div class="form-group">
                    <label class="legend-form" for="prixUnitaire-product">Prix Unitaire Du Produit*</label>
                    <input class="form-champ" type="text" name="prixUnitaire-product" id="prixUnitaire-product" pattern="[A-Za-z0-9\u00c0-\u00ff]{1,20}" required value=""/>
                </div>
    
                <div class="form-group-haut-bas form-group-bas">
                    <label class="legend-form" for="description-product">Description Du Produit (max 250 caractères)*</label>
                    <textarea name="description-product" id="description-product" cols="50" rows="15" maxlength="250" wrap="hard"></textarea>
                </div>
    
                <div class="form-group-haut-bas form-group-bas">
                    <label class="legend-form" for="img-product">Image Du Produit*</label>
                    <input class="form-img" type="file" name="img-product" id="img-product"/>
                </div>
    
                <div class="form-box-btn">
                    <button type="submit" value="ajout" name="ajout" class="btn btn-white btn-add" title="Ajout nouveau produit">ajout produit</button>
                    <p class="legende">* champs optionnel</p>
                </div>
            </form>
        </main>

        <aside class="aside-modification mask" id="js__boxModifCategorie">
            <div role="document" class="categorie_box">
                <button id="js__btnCloseBoxModif" class="btn btn-white btn-connexion" type="button" aria-label="Fermer" title="Fermer cette fenêtre modale" data-dismiss="dialog">fermer</button>
                <form class="form-categorie" action="produitBdd" method="post">
                    <div class="champ-modification">
                        <label class="legend-form" for="name-category">Nom de la catégorie à supprimer ou nouveau nom de la catégorie</label>
                        <input class="form-champ" type="text" name="name-category" id="name-category" pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required />
                    </div>
                    <div class="champ-modification">
                        <label class="legend-form" for="name-categoryOld">Ancien nom de la catégorie*</label>
                        <input class="form-champ" type="text" name="name-categoryOld" id="name-categoryOld" pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}"/>
                    </div>
                    <div class="form-box-btn">
                        <button type="submit" value="ajoutCat" name="ajoutCat" class="btn btn-white btn-categorie" title="Mofdifier ou ajouter categorie">modification</button>
                        <button type="submit" value="suppCat" name="suppCat" class="btn btn-white btn-categorie" title="Mofdifier ou ajouter categorie">supprimer</button>
                        <p class="legende">* champs optionnel si nouvelle catégorie ou si suppression de la catégorie</p>
                    </div>
                </form>
            </div>
        </aside>


        <aside class="part">
            <h2 class="title-chap ombre">Gestion Produits</h2>

            <?php foreach ($contenuTab['categorie'] as $categorie): ?>

                <article class="content-part ombre">
                    <h3 class="title-part title-article ombre majDbutMot"><?= $categorie->getNomCategorie()?></h3>

                    <?php
                    foreach ($contenuTab['produit'] as $produit):
                    if($categorie->getIdCategorie() == $produit->getCategorie_idCategorie()) :
                    ?>

                        <details class="box-produit">
                            <summary class="title-part menu-part ombre majDbutMot">
                                Les <?= $produit->getNomProduit()?>
                            </summary>
                            <p id="js__descriptionProduit-prod-<?= $produit->getIdProduit()?>" class="description-part">
                                <?= $produit->getDescriptionProduit()?>
                            </p>
                            <div action="" class="box-supp-produit">
                                <button id="cat-<?= $produit->getCategorie_idCategorie()?>-prod-<?= $produit->getIdProduit()?>-<?= $produit->getNomProduit()?>"
                                class="btn btn-brown js__btn-supp-produit" title="Supprimer produit">
                                    supprimer le produit
                                </button>
                            </div>

                            <table class="table-product">
                                <thead class="table-box">
                                    <tr class="table-row">
                                        <th class="table-column invisible img-responsive">
                                            image
                                        </th>
                                        <th class="table-column  gras majDbutMot">
                                            nom produit
                                        </th>
                                        <th class="table-column  gras majDbutMot">
                                            poids
                                        </th>
                                        <th class="table-column  gras majDbutMot">
                                            prix produit
                                        </th>
                                        <th class="table-column invisible" title="Modifier produit">
                                            modifier
                                        </th>
                                        <th class="table-column invisible">
                                            supprimer
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="table-box">

                                <?php
                                foreach ($contenuTab['formatproduit'] as $formatproduit):
                                if ($produit->getIdProduit() == $formatproduit->getProduit_idProduit()):
                                ?>

                                    <tr class="table-row">
                                        <td class="table-column img-responsive">
                                            <img class="img-product" src="asset/img/produit/<?= $produit->getNomProduit()?>.jpg" alt="photo <?= $produit->getNomProduit()?>">
                                        </td>
                                        <td id="js__nomProduit-cat-<?= $produit->getCategorie_idCategorie()?>-prod-<?= $produit->getIdProduit()?>-<?= $produit->getNomProduit()?>-idPoids-<?= $formatproduit->getIdFormatProduit()?>" 
                                        class="table-column gras majDbutMot">
                                            <?= $produit->getNomProduit()?>
                                        </td>
                                        <td id="js__poidsProduit-cat-<?= $produit->getCategorie_idCategorie()?>-prod-<?= $produit->getIdProduit()?>-<?= $produit->getNomProduit()?>-idPoids-<?= $formatproduit->getIdFormatProduit()?>"  
                                        class="table-column">
                                            <?php if (!empty($formatproduit->getPoids())) {echo $formatproduit->getPoids()."g";}else{echo "Vendu à l'unité";}?>
                                        </td>
                                        <td id="js__prixProduit-cat-<?= $produit->getCategorie_idCategorie()?>-prod-<?= $produit->getIdProduit()?>-<?= $produit->getNomProduit()?>-idPoids-<?= $formatproduit->getIdFormatProduit()?>"  
                                        class="table-column">
                                            <?= $formatproduit->getPrixUnitaire()?>€
                                        </td>
                                        <td class="table-column">
                                            <button id="js__btnModif-cat-<?= $produit->getCategorie_idCategorie()?>-prod-<?= $produit->getIdProduit()?>-<?= $produit->getNomProduit()?>-idPoids-<?= $formatproduit->getIdFormatProduit()?>" 
                                            class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" 
                                            aria-controls="dialog" title="Modifier produit">
                                                modifier
                                            </button>
                                        </td>
                                        <td class="table-column">
                                            <button id="cat-<?= $produit->getCategorie_idCategorie()?>-prod-<?= $produit->getIdProduit()?>-<?= $produit->getNomProduit()?>-idPoids-<?= $formatproduit->getIdFormatProduit()?>"
                                        class="btn btn-brown js__btn-supp-format" title="Supprimer produit">
                                                supprimer
                                            </button>
                                        </td>
                                    </tr>

                                    <?php
                                    endif;
                                    endforeach; 
                                    ?>

                                </tbody>

                            </table>
                        </details>

                    <?php
                    endif;
                    endforeach; 
                    ?>

                </article>

            <?php endforeach; ?>
            <article id="js__box-validation" class="hidden">
                <form class="form-suppr" action="produitBdd" method="post">
                    <div class="hidden">
                        <input type="text" name="name-product" id="infoSupp-id"/>
                    </div>
                    <p>Voulez-vous supprimer ce format de produit?</p>
                    <div class="box-oui-non">
                    <button type="submit" value="supprimer" name="supprimer" class="btn btn-white" title="Valider demande de suppresion du format du produit">
                        oui
                    </button>
                    <button id="js__btnRefusSupp" class="btn btn-white" title="Ne pas supprimer le format du produit">
                        non
                    </button>
                    </div>
                </form>
            </article>
            <article id="js__box-validation-suppProduit" class="hidden">
                <form class="form-suppr" action="produitBdd" method="post">
                    <div class="hidden">
                        <input type="text" name="name-product" id="infoSuppProd-id"/>
                    </div>
                    <p>Voulez-vous supprimer ce produit, ainsi que tous les formats du produit?</p>
                    <div class="box-oui-non">
                    <button type="submit" value="suppProd" name="suppProd" class="btn btn-white" title="Valider demande de supression du produit">
                        oui
                    </button>
                    <button id="js__btnRefusSuppProd" class="btn btn-white" title="Ne pas supprimer produit">
                        non
                    </button>
                    </div>
                </form>
            </article>
        </aside>
    </div> 

    <aside class="aside-modification" id="js__modalWindow" role="dialog" aria-labelledby="dialog-title" aria-describedby="dialog-desc" aria-modal="true" aria-hidden="true" tabindex="-1">
        <div role="document" class="modale__box">
            <button id="js__btnClose" class="btn btn-white btn-connexion" type="button" aria-label="Fermer" title="Fermer cette fenêtre modale" data-dismiss="dialog">fermer</button>
            <form class="form-modification" action="produitBdd" method="post">
                <div class="hidden">
                    <input type="text" name="name-product" id="referenceProduit"/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="infoProduit-nom">Nom </label>
                    <input class="zone-text" type="text" id="infoProduit-nom" placeholder="nom"  pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="infoProduit-poids">Poids</label>
                    <input class="zone-text" type="text" name="size-product" id="infoProduit-poids" placeholder="poids" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="infoProduit-prix">Prix</label>
                    <input class="zone-text" type="number" name="prixUnitaire-product" id="infoProduit-prix" placeholder="prix" required/>
                </div>
                <button type="submit" value="ajout" name="ajout" class="btn btn-white">modification</button>
            </form>
        </div>
    </aside>

    <script src="asset/script/scriptCommonModal.js" defer></script>
    <?php
        $_SESSION['modif']="?"
    ?>
</body>