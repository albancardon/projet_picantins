
<body class="bodyCommon">
    <main>
        <h1 class="titlePage">Nos produits</h1>
    </main>

    <aside class="part-categorie">
        
        <?php
        foreach ($contenuTab['categorie'] as $categorie):
        ?>
            <h2 class="title-chap ombre majDbutMot">Nos <?php echo $categorie->getNomCategorie()?></h2>
            <div class="produit">
                
            <?php
            foreach ($contenuTab['produit'] as $produit):
            if($categorie->getIdCategorie() == $produit->getCategorie_idCategorie()) :
            ?>
                <article class="produit-group">
                    <section id="js__boxProduit-<?php echo $produit->getIdProduit()?>" class="produit-description-box 
                    <?php if($produit->getIdProduit()%2 == 0){echo "produit-inverse";}?> ombre js__boxDescriptifProduit" tabindex="0">
                        <h3 class="title-produit ombre">
                            Les <span id="js__produit-<?php echo $produit->getIdProduit()?>" class="spanInline"><?php echo $produit->getNomProduit()?></span>
                        </h3>
                        <div class="produit-descriptif">
                            <?php if($produit->getIdProduit()%2 == 0):?>
                                <img id="js__imageProduit-<?php echo $produit->getIdProduit()?>" class="img-produit ombre" src="asset/img/produit/<?php echo 
                                $produit->getNomProduit()?>.jpg" alt="image des <?php echo $produit->getNomProduit()?>">
                                <p id="js__descriptionProduit-<?php echo $produit->getIdProduit()?>" class="produit-legende gras">
                                    <?php echo $produit->getDescriptionProduit()?>
                                </p>
                            <?php else:?>
                                
                                <p id="js__descriptionProduit-<?php echo $produit->getIdProduit()?>" class="produit-legende gras">
                                    <?php echo $produit->getDescriptionProduit()?>
                                </p>
                                <img id="js__imageProduit-<?php echo $produit->getIdProduit()?>" class="img-produit ombre" src="asset/img/produit/<?php echo 
                                $produit->getNomProduit()?>.jpg" alt="image des <?php echo $produit->getNomProduit()?>">
                            <?php endif?>
                        </div>
                        <p class="texte-ouvrir">
                            Cliquer pour ouvrir
                        </p>
                    </section>
                    <section id="js__choixPoids-<?php echo $produit->getIdProduit()?>" class="produit-box-choix ombre js__produitChoix mask">
                        <div class="texte-fermer">
                            <img id="js__btnFermetureBox-<?php echo $produit->getIdProduit()?>" src="asset/icon/x.svg" alt="fermer" class="croix-fermeture">
                        </div>
                        <?php
                        foreach ($contenuTab['formatproduit'] as $formatproduit):
                        if ($produit->getIdProduit() == $formatproduit->getProduit_idProduit()):
                        ?>
                            <form class="group-choix-taille">
                                    <img class="img-miniature ombre" src="asset/img/produit/<?php echo $produit->getNomProduit()?>.jpg" alt="image de <?php echo $produit->getNomProduit()?>">
                                    <p id="js__produit-<?php echo $formatproduit->getProduit_idProduit()?>-poids-<?php echo $formatproduit->getIdFormatProduit()?>">
                                        <?php if (!empty($formatproduit->getPoids())) {echo $formatproduit->getPoids()."g";}else{echo "Vendu à l'unité";}?>
                                    </p>
                                    <p id="js__produit-<?php echo $formatproduit->getProduit_idProduit()?>-prix-<?php echo $formatproduit->getIdFormatProduit()?>">
                                        <?php echo $formatproduit->getPrixUnitaire()?>€
                                    </p>
                                <div class="produit-quantite">
                                    <img id="js__choixPoids-<?php echo $formatproduit->getProduit_idProduit()?>-btnMoinsChoix-<?php echo $formatproduit->getIdFormatProduit()?>
                                    " class="icon-quantity js__btnMoins" src="asset/icon/quantité-moins.svg" 
                                    alt="icon moins">
                                    <input id="js__choixPoids-<?php echo $formatproduit->getProduit_idProduit()?>-quantite-<?php echo $formatproduit->getIdFormatProduit()?>" 
                                    class="champ_quantity" type="number" value="0"
                                    name="choixPoids-<?php echo $formatproduit->getProduit_idProduit()?>-quantite-<?php echo $formatproduit->getIdFormatProduit()?>" 
                                    min="0" max="99" pattern="[0-9]{1,2}"/>
                                    <img id="js__choixPoids-<?php echo $formatproduit->getProduit_idProduit()?>-btnPlusChoix-<?php echo $formatproduit->getIdFormatProduit()?>" 
                                    class="icon-quantity js__btnPlus" src="asset/icon/quantité-plus.svg" 
                                    alt="icon plus">
                                </div>
                                <button id="js__btnAjoutProduit-<?php echo $formatproduit->getProduit_idProduit()?>-quantite-<?php echo $formatproduit->getIdFormatProduit()?>" 
                                class="btn btn-grey js__btnAjoutPanier" title="Ajouter au panier">
                                    ajouter au panier
                                </button>
                            </form>
                        <?php
                        endif;
                        endforeach; 
                        ?>
                    </section>
                </article>
            <?php 
            endif; 
            endforeach; 
            ?>
            </div>
        <?php endforeach; ?>
    </aside>

</body>