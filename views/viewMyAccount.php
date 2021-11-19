
<?php 
if (empty($_SESSION['logged'])) {
    header('Location: /php_projet-CDA/0.projet_les_picantins-code/accueil');
    exit();
}
$user = isset($_SESSION['user'])?$_SESSION['user']:'';
?>
<body class="bodyCommon">
    <div id="js__mainContent">
        <h1 class="titlePage">Mon compte Client</h1>
        <!-- main container info compte client -->
        <main class="main-info ombre">
            <h2 class="title-part">
                Mes informations personnelles
            </h2>
            <article class="box-info">
                        <section class="paragraph-info majDbutMot">
                            Nom 
                            <p id="js__nom" class="info-data gras ombre"><?=$user["nom"]?></p>
                        </section>
                        <section class="paragraph-info majDbutMot">
                            Prénom 
                            <p id="js__prenom" class="info-data gras ombre"><?=$user["prenom"]?></p>
                        </section>
                        <section class="paragraph-info">
                            Adresse e-mail
                            <p id="js__mail" class="info-data gras ombre"><?=$user["mail"]?></p>
                        </section>
                        <section class="paragraph-info majDbutMot">
                            Adresse
                            <p id="js__adresse" class="info-data gras ombre"><?=$user["adresse"]?></p>
                        </section>
                        <section class="paragraph-info">
                            Téléphone
                            <p id="js__tel" class="info-data gras ombre"><?=$user["tel"]?></p>
                        </section>
            </article>
            <article class="box-edit-profile">
                <section class="lien-edit js__btnOpenModale">
                    Editer profile
                    <img class="icon" src="asset/icon/editer.svg" alt="icone édition">
                </section>
            </article>
        </main>
        <!-- aside historique des factures et des commandes -->
        <aside class="aside-historique ombre">
            <h2 class="title-histo title-part">
                Mon historique de factures
            </h2>
            <table class="table">
                <thead class="table-part">
                    <tr class="table-row">
                        <th>
                            Numéro de facture
                        </th>
                        <th>
                            Commande effectuer le
                        </th>
                        <th class="table-montant">
                            Montant de
                        </th>
                        <th class="invisible">
                            Lien
                        </th>
                    </tr>
                </thead>

                <tbody class="table-part">
                    <tr class="table-row">
                        <td class="table-column">
                            2021_08_31-0001
                        </td>
                        <td class="table-column">
                            31/08/2021
                        </td>
                        <td class="table-column table-montant">
                            123€
                        </td>
                        <td>
                            <a href="">
                                <img class="icon" src="asset/icon/pdf.svg" alt="">
                            </a>
                        </td>
                    </tr>

                    <tr class="table-row">
                        <td class="table-column">
                            2021_08_01-0005
                        </td>
                        <td class="table-column">
                            01/08/2021
                        </td>
                        <td class="table-column table-montant">
                            123€
                        </td>
                        <td>
                            <a href="">
                                <img class="icon" src="asset/icon/pdf.svg" alt="">
                            </a>
                        </td>
                    </tr>

                    <tr class="table-row">
                        <td class="table-column">
                            2021_07_14-0010
                        </td>
                        <td class="table-column">
                            15/07/2021
                        </td>
                        <td class="table-column table-montant">
                            123€
                        </td>
                        <td>
                            <a href="">
                                <img class="icon" src="asset/icon/pdf.svg" alt="">
                            </a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </aside>
    </div>

    <aside class="aside-modification" id="js__modalWindow" role="dialog" aria-labelledby="dialog-title" aria-describedby="dialog-desc" aria-modal="true" aria-hidden="true" tabindex="-1">
        <div role="document" class="modale__box">
            <button id="js__btnClose" class="btn btn-white btn-connexion" type="button" aria-label="Fermer" title="Fermer cette fenêtre modale" data-dismiss="dialog">ferner</button>
            <form class="form-modification" action="loginBdd" method="post">
                <p class="gras"> Remplissez et modifier les champs que vous voulez à changer</p>
                <p class="gras"> Pour toute demande de modification merci d'entré votre mot de passe</p>
                <p>(les champs nouveau mot de passe ainsi que la confirmation du nouveau ne sont nécessaire que pour modifier le mot de passe)</p>
                <div class="hidden">
                    <input class="zone-text" type="text" name="idCompte" 
                    placeholder="e-mail" value="<?=$user["idCompte"]?>" required/>
                </div>
                <div class="champ-identiter">
                    <p class="champ-modification">
                        <label class="label-modification majDbutMot" for="compte-nom">Nom </label>
                        <input class="zone-text-nom" type="text" name="compte-nom" 
                        id="compte-nom" placeholder="nom"  
                        pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required/>
                    </p>
                    <p class="champ-modification">
                        <label class="label-modification majDbutMot" for="compte-prenom" >Prénom </label>
                        <input class="zone-text-nom" type="text" name="compte-prenom" 
                        id="compte-prenom" placeholder="prénom"  
                        pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required/>
                    </p>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="mailLogin">adresse e-mail</label>
                    <input class="zone-text" type="email" name="mailLogin" 
                    id="mailLogin" placeholder="e-mail" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="compte-adresse">Adresse</label>
                    <input class="zone-text" type="text" name="compte-adresse" 
                    id="compte-adresse" placeholder="adresse" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="compte-tel">Numero de téléphone</label>
                    <input class="zone-text" type="text" name="compte-tel" 
                    id="compte-tel" placeholder="numero de téléphone" 
                    pattern="[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}" 
                    maxlength="14" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="passLogin">Mot de passe</label>
                    <input class="zone-text" type="password" name="passLogin" 
                    id="passLogin" placeholder="mot de passe" 
                    pattern="[A-Za-z0-9_$]{8,}" value="1234Test" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="passLoginNew">Nouveau mot de passe</label>
                    <input class="zone-text" type="password" name="passLoginNew" 
                    id="passLoginNew" placeholder="mot de passe" 
                    pattern="[A-Za-z0-9_$]{8,}" value="1234Test"/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="passConfirm">Confirmation du nouveau mot de passe</label>
                    <input class="zone-text" type="password" name="passConfirm" 
                    id="passConfirm" placeholder="répétition mot de passe" 
                    pattern="[A-Za-z0-9_$]{8,}" value="1234Test"/>
                </div>
                <button type="submit" value="modifCompte" name="modifCompte" id="js__btnModifCompte" class="btn btn-white">modification</button>
            </form>
        </div>
    </aside>
    <script src="asset/script/scriptCommonModal.js" defer></script>
</body>