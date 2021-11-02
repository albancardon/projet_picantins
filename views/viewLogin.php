
<body>
    <h1 class="titlePage">Connexion Client</h1>
    <div class="container">
        <!-- main container connexion -->
        <main class="main-connexion ombre">
            <h2 class="titre-form majDbutMot gras">Connexion</h2>
            <form class="form-connexion" method="get">
                <div class="form-group">
                    <label class="champ majDbutMot" for="mailLogin"> Mon adresse e-mail</label>
                    <input class="zone-text" type="email" name="mailLogin" id="mailLogin" placeholder="e-mail"  required>
                    <p class="legende-champ">
                        format: nom.prenom@domaine.com <br/>
                        ex: john.doe@gmail.com
                    </p>
                </div>
                <div class="form-group">
                    <label class="champ majDbutMot" for="passLogin"> Mon mot de passe</label>
                    <input class="zone-text" type="password" name="passLogin" id="passLogin" placeholder="mot de passe" pattern="[A-Za-z0-9_$]{8,}" required>
                    <p class="legende-champ">
                        Votre mot de passe doit être composé de 8 caractères minimums <br/>
                        Avec une majuscule, un minuscule et un chiffre minimum
                    </p>
                </div>
                <button id="js__btnLogin" class="btn btn-white btn-connexion" title="Connexion">connexion</button>
            </form>
        </main>
        <!-- aside inscription -->
        <aside class="aside-inscription ombre">
            <h2 class="titre-form majDbutMot gras">Inscription</h2>
            <form class="form-inscription"  method="get">
                <div class="inscription-identiter">
                    <p class="champ-inscription">
                        <label class="label-inscription majDbutMot" for="inscrpt-nom">Mon nom </label>
                        <input class="zone-text" type="text" name="inscrpt-nom" id="inscrpt-nom" placeholder="nom"  pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required/>
                    </p>
                    <p class="champ-inscription">
                        <label class="label-inscription majDbutMot" for="inscrpt-prenom" >Mon prénom </label>
                        <input class="zone-text" type="text" name="inscrpt-prenom" id="inscrpt-prenom" placeholder="prénom"  pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required/>
                    </p>
                </div>
                <div class="champ-inscription">
                    <label class="label-inscription majDbutMot" for="inscrpt-mail">Mon adresse e-mail</label>
                    <input class="zone-text" type="email" name="inscrpt-mail" id="inscrpt-mail" placeholder="e-mail" required/>
                </div>
                <div class="champ-inscription">
                    <label class="label-inscription majDbutMot" for="passInscrpt">Mon mot de passe</label>
                    <input class="zone-text" type="password" name="passInscrpt" id="passInscrpt" placeholder="mot de passe" pattern="[A-Za-z0-9_$]{8,}" required/>
                </div>
                <div class="champ-inscription">
                    <label class="label-inscription majDbutMot" for="passInscrptConfirm">Confirmation de mon mot de passe</label>
                    <input class="zone-text" type="password" name="" id="passInscrptConfirm" placeholder="répétition mot de passe" pattern="[A-Za-z0-9_$]{8,}" required/>
                </div>
                <div class="champ-inscription">
                    <label class="label-inscription majDbutMot" for="inscrpt-adressse">Mon adresse</label>
                    <input class="zone-text" type="text" name="inscrpt-adressse" id="inscrpt-adressse" placeholder="adresse" required/>
                </div>
                <div class="champ-inscription">
                    <label class="label-inscription majDbutMot" for="inscrpt-tel">Mon numéro de téléphone</label>
                    <input class="zone-text" type="text" name="inscrpt-tel" id="inscrpt-tel" placeholder="numero de téléphone" pattern="[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}" maxlength="14" required/>
                    <p class="legende-champ">
                        Numéro séparé par un tiret ou une espace<br/>
                        ex: 01-02-03-04-05 <br/>
                        ou 01 02 03 04 05
                    </p>
                </div>
                <button id="js__btnInscpt" class="btn btn-white btn-connexion" title="Inscription">inscription</button>
            </form>
        </aside>
    </div>
    <script src="asset/script/scriptLogin.js" defer></script>
</body>