
<body id="pageGestionProduits" class="bodyCommon">
    <div id="js__mainContent">
        <h1 class="titlePage">Gestion des produits</h1>
        <main class="part">
            <h2 class="title-chap ombre">Ajout Produit</h2>
            <form class="form-box ombre" action="">
                <div class="form-group-haut-bas">
                    <label class="legend-form" for="name-product">Nom Du Produit</label>
                    <input class="form-champ" type="text" name="name-product" id="name-product" pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required />
                </div>
    
                <div class="form-group">
                    <label class="legend-form" for="category-product">Catégorie Du Produit</label>
                    <select name="category-product" id="category-product" class="form-champ" required>
                        <option>Choisissez une catégorie</option>
                        <option value="">spécialité</option>
                        <option value="">assortiment</option>
                        <option value="">sucrerie</option>
                    </select>
                </div>
    
                <div class="form-group">
                    <label class="legend-form" for="size-product">Taille Du Produit</label>
                    <input class="form-champ" type="text" name="size-product" id="size-product" pattern="[0-9]{3,20}" required />
                </div>
    
                <div class="form-group">
                    <label class="legend-form" for="prixUnitaire">Prix Unitaire Du Produit</label>
                    <input class="form-champ" type="text" name="prixUnitaire" id="prixUnitaire" pattern="[0-9]{3,20}" required />
                </div>
    
                <div class="form-group-haut-bas form-group-bas">
                    <label class="legend-form" for="description-product">Description Du Produit (max 250 caractères)</label>
                    <textarea name="description-product" id="description-product" cols="50" rows="15" maxlength="250" wrap="hard" required></textarea>
                </div>
                
                <button class="btn btn-white btn-add" title="Ajout nouveau produit">ajout produit</button>
            </form>
        </main>
        <aside class="part">
            <h2 class="title-chap ombre">Gestion Produits</h2>
            <article class="content-part ombre">
                <h3 class="title-part title-article ombre majDbutMot">Spécialités</h3>
                <details class="box-produit">
                    <summary class="title-part menu-part ombre majDbutMot">
                        Les Picantins
                    </summary>
                    <p id="js__descriptionProduit-prod-0" class="description-part">
                        3 noisettes grillées délicatement enrobées de chocolat et de nougatine.
                    </p>
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
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/picantin.jpg" alt="photo picantin">
                                </td>
                                <td id="js__nomProduit-prod-0_poids-0" class="table-column gras majDbutMot">
                                    picantins
                                </td>
                                <td id="js__poidsProduit-prod-0_poids-0" class="table-column">
                                    100g
                                </td>
                                <td id="js__prixProduit-prod-0_poids-0" class="table-column">
                                    6€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-0_poids-0" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/picantin.jpg" alt="photo picantin">
                                </td>
                                <td id="js__nomProduit-prod-0_poids-1" class="table-column gras majDbutMot">
                                    picantins
                                </td>
                                <td id="js__poidsProduit-prod-0_poids-1" class="table-column">
                                    200g
                                </td>
                                <td id="js__prixProduit-prod-0_poids-1" class="table-column">
                                    12€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-0_poids-1" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/picantin.jpg" alt="photo picantin">
                                </td>
                                <td id="js__nomProduit-prod-0_poids-2" class="table-column gras majDbutMot">
                                    picantins
                                </td>
                                <td id="js__poidsProduit-prod-0_poids-2" class="table-column">
                                    300g
                                </td>
                                <td id="js__prixProduit-prod-0_poids-2" class="table-column">
                                    18€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-0_poids-2" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/picantin.jpg" alt="photo picantin">
                                </td>
                                <td id="js__nomProduit-prod-0_poids-3" class="table-column gras majDbutMot">
                                    picantins
                                </td>
                                <td id="js__poidsProduit-prod-0_poids-3" class="table-column">
                                    400g
                                </td>
                                <td id="js__prixProduit-prod-0_poids-3" class="table-column">
                                    24€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-0_poids-3" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/picantin.jpg" alt="photo picantin">
                                </td>
                                <td id="js__nomProduit-prod-0_poids-4" class="table-column gras majDbutMot">
                                    picantins
                                </td>
                                <td id="js__poidsProduit-prod-0_poids-4" class="table-column">
                                    500g
                                </td>
                                <td id="js__prixProduit-prod-0_poids-4" class="table-column">
                                    30€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-0_poids-4" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/picantin.jpg" alt="photo picantin">
                                </td>
                                <td id="js__nomProduit-prod-0_poids-5" class="table-column gras majDbutMot">
                                    picantins
                                </td>
                                <td id="js__poidsProduit-prod-0_poids-5" class="table-column">
                                    750g
                                </td>
                                <td id="js__prixProduit-prod-0_poids-5" class="table-column">
                                    45€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-0_poids-5" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </details>
                <hr class="seprator">
                <details class="box-produit">
                    <summary class="title-part menu-part ombre majDbutMot">
                        Les Rochers Compiégnois
                    </summary>
                    <p id="js__descriptionProduit-prod-1" class="description-part">
                        Des pralinés feuilletés avec du riz soufflé.
                    </p>
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
                                <th class="table-column invisible">
                                    modifier
                                </th>
                                <th class="table-column invisible">
                                    supprimer
                                </th>
                            </tr>
                        </thead>
        
                        <tbody class="table-box">
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/rocher.jpg" alt="photo rocher compiégnois">
                                </td>
                                <td id="js__nomProduit-prod-1_poids-0" class="table-column gras majDbutMot">
                                    rochers Compiégnois
                                </td>
                                <td id="js__poidsProduit-prod-1_poids-0" class="table-column">
                                    100g
                                </td>
                                <td id="js__prixProduit-prod-1_poids-0" class="table-column">
                                    7€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-1_poids-0" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/rocher.jpg" alt="photo rocher compiégnois">
                                </td>
                                <td id="js__nomProduit-prod-1_poids-1" class="table-column gras majDbutMot">
                                    rochers Compiégnois
                                </td>
                                <td id="js__poidsProduit-prod-1_poids-1" class="table-column">
                                    200g
                                </td>
                                <td id="js__prixProduit-prod-1_poids-1" class="table-column">
                                    14€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-1_poids-1" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/rocher.jpg" alt="photo rocher compiégnois">
                                </td>
                                <td id="js__nomProduit-prod-1_poids-2" class="table-column gras majDbutMot">
                                    rochers Compiégnois
                                </td>
                                <td id="js__poidsProduit-prod-1_poids-2" class="table-column">
                                    300g
                                </td>
                                <td id="js__prixProduit-prod-1_poids-2" class="table-column">
                                    21€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-1_poids-2" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/rocher.jpg" alt="photo rocher compiégnois">
                                </td>
                                <td id="js__nomProduit-prod-1_poids-3" class="table-column gras majDbutMot">
                                    rochers Compiégnois
                                </td>
                                <td id="js__poidsProduit-prod-1_poids-3" class="table-column">
                                    400g
                                </td>
                                <td id="js__prixProduit-prod-1_poids-3" class="table-column">
                                    28€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-1_poids-3" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </details>
                <hr class="seprator">
                <details class="box-produit">
                    <summary class="title-part menu-part ombre majDbutMot">
                        Les Marjories
                    </summary>
                    <p id="js__descriptionProduit-prod-2" class="description-part">
                        Une ganache au chocolat noir parfumé aux écorces d’orange confite.
                    </p>
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
                                <th class="table-column invisible">
                                    modifier
                                </th>
                                <th class="table-column invisible">
                                    supprimer
                                </th>
                            </tr>
                        </thead>
        
                        <tbody class="table-box">
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/marjorie.jpg" alt="photo marjorie">
                                </td>
                                <td id="js__nomProduit-prod-2_poids-0" class="table-column gras majDbutMot">
                                    marjorie
                                </td>
                                <td id="js__poidsProduit-prod-2_poids-0" class="table-column">
                                    100g
                                </td>
                                <td id="js__prixProduit-prod-2_poids-0" class="table-column">
                                    7€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-2_poids-0" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/marjorie.jpg" alt="photo marjorie">
                                </td>
                                <td id="js__nomProduit-prod-2_poids-1" class="table-column gras majDbutMot">
                                    marjorie
                                </td>
                                <td id="js__poidsProduit-prod-2_poids-1" class="table-column">
                                    200g
                                </td>
                                <td id="js__prixProduit-prod-2_poids-1" class="table-column">
                                    14€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-2_poids-1" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/marjorie.jpg" alt="photo marjorie">
                                </td>
                                <td id="js__nomProduit-prod-2_poids-2" class="table-column gras majDbutMot">
                                    marjorie
                                </td>
                                <td id="js__poidsProduit-prod-2_poids-2" class="table-column">
                                    300g
                                </td>
                                <td id="js__prixProduit-prod-2_poids-2" class="table-column">
                                    21€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-2_poids-2" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/marjorie.jpg" alt="photo marjorie">
                                </td>
                                <td id="js__nomProduit-prod-2_poids-3" class="table-column gras majDbutMot">
                                    marjorie
                                </td>
                                <td id="js__poidsProduit-prod-2_poids-3" class="table-column">
                                    400g
                                </td>
                                <td id="js__prixProduit-prod-2_poids-3" class="table-column">
                                    28€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-2_poids-3" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </details>
            </article>
            <article class="content-part ombre">
                <h3 class="title-part title-article ombre majDbutMot">Confiseries</h3>
                <details class="box-produit">
                    <summary class="title-part menu-part ombre majDbutMot">
                        Les Marrons-glacée
                    </summary>
                    <p id="js__descriptionProduit-prod-3" class="description-part">
                        Marrons en provenance de Turin en Italie.
                    </p>
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
                                <th class="table-column invisible">
                                    modifier
                                </th>
                                <th class="table-column invisible">
                                    supprimer
                                </th>
                            </tr>
                        </thead>
        
                        <tbody class="table-box">
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/marron-glace.jpg" alt="photo marron-glace">
                                </td>
                                <td id="js__nomProduit-prod-3_poids-0" class="table-column gras majDbutMot">
                                    marron glacée
                                </td>
                                <td id="js__poidsProduit-prod-3_poids-0" class="table-column">
                                    Unité
                                </td>
                                <td id="js__prixProduit-prod-3_poids-0" class="table-column">
                                    2.5€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-3_poids-0" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </details>
            </article>
            <article class="content-part ombre">
                <details class="box-produit">
                    <summary class="title-part menu-part ombre majDbutMot">
                        Les Assortiments
                    </summary>
                    <p id="js__descriptionProduit-prod-4" class="description-part">
                        Un assortiment de nos spécialités.
                    </p>
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
                                <th class="table-column invisible">
                                    modifier
                                </th>
                                <th class="table-column invisible">
                                    supprimer
                                </th>
                            </tr>
                        </thead>
        
                        <tbody class="table-box">
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/assortiment.jpg" alt="photo assortiment">
                                </td>
                                <td id="js__nomProduit-prod-4_poids-0" class="table-column gras majDbutMot">
                                    assortiments
                                </td>
                                <td id="js__poidsProduit-prod-4_poids-0" class="table-column">
                                    100g
                                </td>
                                <td id="js__prixProduit-prod-4_poids-0" class="table-column">
                                    5.70€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-4_poids-0" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/assortiment.jpg" alt="photo assortiment">
                                </td>
                                <td id="js__nomProduit-prod-4_poids-1" class="table-column gras majDbutMot">
                                    assortiments
                                </td>
                                <td id="js__poidsProduit-prod-4_poids-1" class="table-column">
                                    200g
                                </td>
                                <td id="js__prixProduit-prod-4_poids-1" class="table-column">
                                    11.40€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-4_poids-1" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/assortiment.jpg" alt="photo assortiment">
                                </td>
                                <td id="js__nomProduit-prod-4_poids-2" class="table-column gras majDbutMot">
                                    assortiments
                                </td>
                                <td id="js__poidsProduit-prod-4_poids-2" class="table-column">
                                    300g
                                </td>
                                <td id="js__prixProduit-prod-4_poids-2" class="table-column">
                                    17.10€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-4_poids-2" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/assortiment.jpg" alt="photo assortiment">
                                </td>
                                <td id="js__nomProduit-prod-4_poids-3" class="table-column gras majDbutMot">
                                    assortiments
                                </td>
                                <td id="js__poidsProduit-prod-4_poids-3" class="table-column">
                                    400g
                                </td>
                                <td id="js__prixProduit-prod-4_poids-3" class="table-column">
                                    22.80€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-4_poids-3" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="table-column img-responsive">
                                    <img class="img-product" src="asset/img/produit/assortiment.jpg" alt="photo assortiment">
                                </td>
                                <td id="js__nomProduit-prod-4_poids-4" class="table-column gras majDbutMot">
                                    assortiments
                                </td>
                                <td id="js__poidsProduit-prod-4_poids-4" class="table-column">
                                    500g
                                </td>
                                <td id="js__prixProduit-prod-4_poids-4" class="table-column">
                                    28.50€
                                </td>
                                <td class="table-column">
                                    <button id="js__btnModif-prod-4_poids-4" class="btn btn-brown btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                        modifier
                                    </button>
                                </td>
                                <td class="table-column">
                                    <button class="btn btn-brown" title="Spprimer produit">
                                        supprimer
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </details>
            </article>
        </aside>
    </div>
    <aside class="aside-modification" id="js__modalWindow" role="dialog" aria-labelledby="dialog-title" aria-describedby="dialog-desc" aria-modal="true" aria-hidden="true" tabindex="-1">
        <div role="document" class="modale__box">
            <button id="js__btnClose" class="btn btn-white btn-connexion" type="button" aria-label="Fermer" title="Fermer cette fenêtre modale" data-dismiss="dialog">ferner</button>
            <form class="form-modification"  method="get">
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="infoProduit-nom">Nom </label>
                    <input class="zone-text" type="text" name="infoProduit-nom" id="infoProduit-nom" placeholder="nom"  pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="infoProduit-poids">Poids</label>
                    <input class="zone-text" type="text" name="infoProduit-poids" id="infoProduit-poids" placeholder="poids" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="infoProduit-prix">Prix</label>
                    <input class="zone-text" type="number" name="infoProduit-prix" id="infoProduit-prix" placeholder="prix" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="infoProduit-description">Description Du Produit</label>
                    <textarea class="zone-text"  name="infoProduit-description" id="infoProduit-description" cols="50" rows="5" maxlength="250" wrap="hard" required></textarea>
                </div>
                <button class="btn btn-white">modification</button>
            </form>
        </div>
    </aside>
    <script src="asset/script/scriptCommonModal.js" defer></script>
    <script src="asset/script/scriptGestionProduits.js" defer></script>
</body>