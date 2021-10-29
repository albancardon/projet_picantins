
<body class="bodyCommon">
    <h1 class="titlePage">Mon compte Client</h1>
    <!-- main container info compte client -->
    <main class="main-info ombre">
        <h2 class="title-part">
            Mes informations personnelles
        </h2>
        <article class="box-info">
                    <section class="paragraph-info majDbutMot">
                        Nom 
                        <p class="info-data gras ombre"> Dupont </p>
                    </section>
                    <section class="paragraph-info majDbutMot">
                        Prénom 
                        <p class="info-data gras ombre"> Paul </p>
                    </section>
                    <section class="paragraph-info">
                            Adresse e-mail
                        <p class="info-data gras ombre"> paul.dupont@gmail.com</p>
                    </section>
                    <section class="paragraph-info majDbutMot">
                        Adresse
                        <p class="info-data gras ombre"> 99 Rue Du Moulin 75000 Paris </p>
                    </section>
                    <section class="paragraph-info">
                        Téléphone
                        <p class="info-data gras ombre">06 01 02 03 04</p>
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

    <aside class="aside-modification" id="js__modalWindow" role="dialog" aria-labelledby="dialog-title" aria-describedby="dialog-desc" aria-modal="true" aria-hidden="true" tabindex="-1">
        <div role="document" class="modale__box">
            <button id="js__btnClose" class="btn btn-white btn-connexion" type="button" aria-label="Fermer" title="Fermer cette fenêtre modale" data-dismiss="dialog">ferner</button>
            <form class="form-modification"  method="get">
                <p class="gras"> Remplissez les champs à modifier</p>
                <div class="champ-identiter">
                    <p class="champ-modification">
                        <label class="label-modification majDbutMot" for="infoCompte-nom">Nom </label>
                        <input class="zone-text-nom" type="text" name="infoCompte-nom" id="infoCompte-nom" placeholder="nom"  pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required/>
                    </p>
                    <p class="champ-modification">
                        <label class="label-modification majDbutMot" for="infoCompte-prenom" >Prénom </label>
                        <input class="zone-text-nom" type="text" name="infoCompte-prenom" id="infoCompte-prenom" placeholder="prénom"  pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required/>
                    </p>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="infoCompte-mail">adresse e-mail</label>
                    <input class="zone-text" type="email" name="infoCompte-mail" id="infoCompte-mail" placeholder="e-mail" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="infoCompte-adresse">Adresse</label>
                    <input class="zone-text" type="text" name="infoCompte-adresse" id="infoCompte-adresse" placeholder="adresse" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="infoCompte-tel">Numero de téléphone</label>
                    <input class="zone-text" type="text" name="infoCompte-tel" id="infoCompte-tel" placeholder="numero de téléphone" pattern="[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}" maxlength="14" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="passOld">Ancien mot de passe</label>
                    <input class="zone-text" type="password" name="passOld" id="passOld" placeholder="mot de passe" pattern="[A-Za-z0-9_$]{8,}" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="passNew">Nouveau mot de passe</label>
                    <input class="zone-text" type="password" name="passNew" id="passNew" placeholder="mot de passe" pattern="[A-Za-z0-9_$]{8,}" required/>
                </div>
                <div class="champ-modification">
                    <label class="label-modification majDbutMot" for="passNewConfirm">Confirmation du nouveau mot de passe</label>
                    <input class="zone-text" type="password" name="" id="passNewConfirm" placeholder="répétition mot de passe" pattern="[A-Za-z0-9_$]{8,}" required/>
                </div>
                <button class="btn btn-white">modification</button>
            </form>
        </div>
    </aside>
    <script src="asset/script/scriptCommonModal.js" defer></script>
    <script src="asset/script/scriptMyAccount.js" defer></script>
</body>