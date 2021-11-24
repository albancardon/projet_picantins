
<?php 
$user = isset($_SESSION['user'])?$_SESSION['user']:'';
?>
<body>
    <div class="bodyLogin">
        <h1 class="titlePage">Connexion Client</h1>
        <div class="container">
            <!-- main container connexion -->
            <main class="main-connexion ombre">
                <h2 class="titre-form majDbutMot gras">Connexion</h2>
                <form class="form-connexion" action="loginBdd" method="post">
                    <div class="form-group">
                        <label class="champ majDbutMot" for="mailLogin"> Mon adresse e-mail</label>
                        <input class="zone-text" type="email" name="mailLogin" id="mailLogin" placeholder="e-mail" required>
                    </div>
                    <div class="form-group">
                        <label class="champ majDbutMot" for="passLogin"> Mon mot de passe</label>
                        <input class="zone-text" type="password" name="passLogin" id="passLogin" placeholder="mot de passe" pattern="[A-Za-z0-9_$]{8,}" required>
                    </div>
                    <button type="submit" value="logCompte" name="logCompte" id="js__btnLogin" class="btn btn-white btn-connexion" 
                    title="Connexion">connexion</button>
                </form>
                <div class="new-membre">
                <p class="legende-insc">nouveau membre?</p>
                <button class="btn btn-white btn-form js__btnOpenModale" type="button" aria-haspopup="dialog" 
                aria-controls="dialog" title="Modifier produit">
                    inscription?
                </button>
                </div>
            </main>
            <!-- aside inscription -->
            
            <aside class="aside-inscription ombre" id="js__modalWindow" role="dialog" aria-labelledby="dialog-title" aria-describedby="dialog-desc" 
            aria-modal="true" aria-hidden="true" tabindex="-1">
                <div role="document" class="modale__box">
                    <button id="js__btnClose" class="btn btn-white btn-connexion" type="button" aria-label="Fermer" title="Fermer cette fenêtre modale" 
                    data-dismiss="dialog">fermer</button>
                    <form class="form-inscription" action="loginBdd" method="post">
                        <h2 class="titre-form majDbutMot gras">Inscription</h2>
                        <div class="inscription-identiter">
                            <p class="champ-inscription">
                                <label class="label-inscription majDbutMot" for="compte-nom">Mon nom </label>
                                <input class="zone-text" type="text" name="compte-nom" id="compte-nom" placeholder="nom" 
                                pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required/>
                            </p>
                            <p class="champ-inscription">
                                <label class="label-inscription majDbutMot" for="compte-prenom" >Mon prénom </label>
                                <input class="zone-text" type="text" name="compte-prenom" id="compte-prenom" placeholder="prénom" 
                                pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required/>
                            </p>
                        </div>
                        <div class="champ-inscription">
                            <label class="label-inscription majDbutMot" for="mailLogin">Mon adresse e-mail</label>
                            <input class="zone-text" type="email" name="mailLogin" id="compte-mail" placeholder="e-mail" required/>
                            <p class="legende-champ">
                                format: nom.prenom@domaine.com <br/>
                                ex: john.doe@gmail.com
                            </p>
                        </div>
                        <div class="champ-inscription">
                            <label class="label-inscription majDbutMot" for="passLogin">Mon mot de passe</label>
                            <input class="zone-text" type="password" name="passLogin" id="passInscrpt" placeholder="mot de passe" 
                            pattern="[A-Za-z0-9_$]{8,}" required/>
                            <p class="legende-champ">
                                Votre mot de passe doit être composé de 8 caractères minimums <br/>
                                Avec une lettre majuscule, une lettre minuscule et un chiffre minimum
                            </p>
                        </div>
                        <div class="champ-inscription">
                            <label class="label-inscription majDbutMot" for="passConfirm">Confirmation de mon mot de passe</label>
                            <input class="zone-text" type="password" name="passConfirm" id="passConfirm" placeholder="répétition mot de passe" 
                            pattern="[A-Za-z0-9_$]{8,}" required/>
                        </div>
                        <div class="champ-inscription">
                            <label class="label-inscription majDbutMot" for="compte-adresse">Mon adresse</label>
                            <input class="zone-text" type="text" name="compte-adresse" id="compte-adresse" placeholder="adresse" required/>
                        </div>
                        <div class="champ-inscription">
                            <label class="label-inscription majDbutMot" for="compte-tel">Mon numéro de téléphone</label>
                            <input class="zone-text" type="text" name="compte-tel" id="compte-tel" placeholder="numero de téléphone" 
                            pattern="[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}[ -]*[0-9]{2}" maxlength="14" required/>
                            <p class="legende-champ">
                                Numéros séparés par un tiret, un espace ou non séparés<br/>
                                ex: 01-02-03-04-05 <br/>
                                ou 01 02 03 04 05 <br/>
                                ou 0102030405
                            </p>
                        </div>
                        <button type="submit" value="addCompte" name="addCompte" id="js__btnInscpt" 
                        class="btn btn-white btn-connexion" title="Inscription">inscription</button>
                    </form>
                </div>
            </aside>
        </div>
    <script src="asset/script/scriptCommonModal.js" defer></script>
    <?php
        $_SESSION['ajoutUser']="?"
    ?>
    </div>
</body>