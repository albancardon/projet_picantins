
<?php 
$modifBdd = isset($_SESSION['modifCompte'])?$_SESSION['modifCompte']:'';
if (isset($modifBdd)&& $modifBdd == "ok"){
    echo'
        <script language=javascript>
            alert(\'Modification effectuer.\');
        </script> ';
}elseif(isset($modifBdd)&& $modifBdd == "no"){
    echo'
        <script language=javascript>
            alert(\'Modification non effectuer!\');
        </script> ';
    
}
echo "contenuTab<pre>";
var_dump($contenuTab['compte']);
echo "</pre>";
?>
<body id="pageGestionComptes" class="bodyCommon">
    <main id="js__mainContent" class="part">
        <h1 class="titlePage">Gestion des comptes</h1>
        <h2 class="title-chap">Liste des Comptes des Clients</h2>
        <table>
            <thead class="table-box">
                <tr class="table-row">
                    <th class="table-column gras majDbutMot">
                        Actif
                    </th>
                    <th class="table-column gras majDbutMot">
                        Nom
                    </th>
                    <th class="table-column gras majDbutMot">
                        Prénom
                    </th>
                    <th class="table-column mail-responsive">
                        E-mail
                    </th>
                    <th class="table-column mail-responsive">
                        Adresse
                    </th>
                    <th class="table-column mail-responsive">
                        Téléphone
                    </th>
                    <th class="table-column invisible">
                        modifier
                    </th>
                </tr>
            </thead>

            <?php 
                $tabChunkCompte= (array_chunk($contenuTab['compte'], 5));
                foreach ($tabChunkCompte as $tabCompte): 
            ?>
            <tbody class="table-box js__tableClient_page inactive">

                <?php foreach ($tabCompte as $compte): ?>
                    <tr id="js__compte-<?= $compte->getIdCompte()?>" class="table-row">
                        <td class="table-column">
                            <input id="js__active-<?= $compte->getIdCompte()?>" type="checkbox" <?php if($compte->getActive()== 1){echo"checked";}?>>
                        </td>
                        <td id="js__nomCompte-<?= $compte->getIdCompte()?>" class="table-column gras majDbutMot">
                            <?= $compte->getNom()?>
                        </td>
                        <td id="js__prénomCompte-<?= $compte->getIdCompte()?>" class="table-column gras majDbutMot">
                            <?= $compte->getPrenom()?>
                        </td>
                        <td class="table-column mail-responsive">
                            <details>
                                <summary>
                                    E-mail
                                </summary>
                                <p id="js__mailCompte-<?= $compte->getIdCompte()?>" class="details-paragraph">
                                    <?= $compte->getMail()?>
                                </p>
                            </details>
                        </td>
                        <td class="table-column mail-responsive">
                            <details>
                                <summary>
                                    Adresse
                                </summary>
                                <p id="js__adresseCompte-<?= $compte->getIdCompte()?>" class="details-paragraph">
                                    <?= $compte->getAdresse()?>
                                </p>
                            </details>
                        </td>
                        <td class="table-column mail-responsive">
                            <details>
                                <summary>
                                    Tel
                                </summary>
                                <p id="js__telcompte-<?= $compte->getIdCompte()?>" class="details-paragraph">
                                    <?= $compte->getTelephone()?>
                                </p>
                            </details>
                        </td>
                        <td class="table-column gras majDbutMot">
                            <button id="js__btnModif-<?= $compte->getIdCompte()?>" class="btn btn-grey btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" aria-controls="dialog" title="Modifier compte">
                                modifier
                            </button>
                        </td>
                    </tr>
                <?php endforeach;
                endforeach; ?>

        </table>
        <ul id="js__navCarouselClient" class="nav-carousel">
        </ul>
    </main>

    <aside class="aside-modification" id="js__modalWindow" role="dialog" aria-labelledby="dialog-title" aria-describedby="dialog-desc" aria-modal="true" aria-hidden="true" tabindex="-1">
        <div role="document" class="modale__box">
            <button id="js__btnClose" class="btn btn-white btn-connexion" type="button" aria-label="Fermer" title="Fermer cette fenêtre modale" data-dismiss="dialog">fermer</button>
            <form class="form-modification" action="loginBdd" method="post">
                <div class="hidden">
                    <input class="zone-text" type="text" name="idCompte" id="idCompte" placeholder="e-mail" value="" required/>
                </div>
                <div class="champ-identiter">
                    <p class="champ-modification">
                        <label class="label-modification majDbutMot" for="compte-nom">Nom </label>
                        <input class="zone-text-nom" type="text" name="compte-nom" id="infoCompte-nom" placeholder="nom"  pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required/>
                    </p>
                    <p class="champ-modification">
                        <label class="label-modification majDbutMot" for="compte-prenom" >Prénom </label>
                        <input class="zone-text-nom" type="text" name="compte-prenom" id="infoCompte-prenom" placeholder="prénom"  pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required/>
                    </p>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="mailLogin">adresse e-mail</label>
                    <input class="zone-text" type="email" name="mailLogin" id="infoCompte-mail" placeholder="e-mail" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="infoCompte-adresse">Adresse</label>
                    <input class="zone-text" type="text" name="compte-adresse" id="infoCompte-adresse" placeholder="adresse" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="compte-tel">Numero de téléphone</label>
                    <input class="zone-text" type="text" name="compte-tel" id="infoCompte-tel" placeholder="numero de téléphone" pattern="[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}" maxlength="14" required/>
                </div>
                <div class="champ-modification">
                    <div class="box-compteActif">
                        <p class="label-modification majDbutMot">Compte actif?</p>
                        <div>
                            <input type="radio" id="js__actif-oui" name="compte-active" value="oui" required/>
                            <label for="oui">oui</label>
                        </div>
                        <div>
                            <input type="radio" id="js__actif-non" name="compte-active" value="non"/>
                            <label for="non">non</label>
                        </div>
                    </div>
                </div>
                <button type="submit" value="modifCompteGestion" name="modifCompteGestion" class="btn btn-white">modification</button>
            </form>
        </div>
    </aside>
    <script src="asset/script/scriptCommonModal.js" defer></script>
</body>
<?php
$_SESSION['modifCompte'] = '?';
?>