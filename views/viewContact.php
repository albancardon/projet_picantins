
<?php 
$mail = isset($_SESSION['envoieMail'])?$_SESSION['envoieMail']:'';
if (isset($mail)&& $mail == "ok"){
    echo'
        <script language=javascript>
            alert(\'Votre message a bien été envoyé.\');
        </script> ';
}elseif (isset($mail)&& $mail == "no"){
    echo'
        <script language=javascript>
            alert(\'Tous les champs doivent être complétés !\');
        </script> ';
    
}
?>
<body class="bodyCommon">
    <main class="main-qui-sommes-nous">
        <h1 class="titlePage ombre majDbutMot">Qui sommes nous?</h1>
        <div class="container-qui">
            <section class="part-qui-description">
                <p class="gras texte-qui">
                Artisan pâtissier et chocolatier, je vous propose des produits de grande qualité et de fabrication artisanale.
                </p>
                <p>
                Au cœur de Compiègne, ma boutique Les Picantins contentera tous les amateurs de chocolats et de confiseries. Pâte de fruits, chocolats et nougats, venez et découvrez mon monde de gourmandise.
                </p>
            </section>
            <section class="part-qui-photo">
                <div class="box-img-qui">
                    <img src="asset/img/contact/interieur-magasin.jpg" alt="photo interieur magasin" class="img-qui">
                </div>
                <div class="box-img-qui">
                    <img src="asset/img/contact/picantin.jpg" alt="photo de Picantins" class="img-qui">
                </div>
                <div class="box-img-qui">
                    <img src="asset/img/contact/chocolat-vitine.jpg" alt="photo d'une vitrine de chocolat" class="img-qui">
                </div>
                <div class="box-img-qui">
                    <img src="asset/img/contact/devanture.jpg" alt="photo de la deventure du magasin" class="img-qui">
                </div>
            </section>
        </div>
        <div class="container-map">
            <iframe class="map ombre" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2595.55305811973!2d2.8242388158682936!3d49.417357269139494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e7d686d5876205%3A0x530965eeb6da69c9!2sLes%20Picantins!5e0!3m2!1sfr!2sfr!4v1632999061644!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </main>
    <aside class="container-contact gras">
        <h2 class="title-contact ombre majDbutMot">
            Contactez nous
        </h2>
        <form class="form-contact ombre"  action="sendContact" method="post">
            <section class="form-group-info">
                <div class="form-info">
                    <label class="" for="nom">Nom</label>
                    <input class="zone-texte-info" type="text" name="nom" id="nom" placeholder="Nom" pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required />
                </div>
    
                <div class="form-info">
                    <label class="" for="prenom">Prénom</label>
                    <input class="zone-texte-info" type="text" name="prenom" id="prenom" placeholder="Prénom" pattern="[A-Za-z0-9\u00c0-\u00ff]{3,20}" required />
                </div>
    
                <div class="form-info">
                    <label class="" for="mail">Adresse e-mail</label>
                    <input class="zone-texte-info" type="email" name="mail" id="mail" placeholder="e-mail" required />
                    </select>
                </div>
            </section>

            <div class="form-box-message">
                <label for="message">Votre commentaire (maximums 250 caractères)</label>
                <textarea class="form-zone-message" name="message" id="message" cols="50" rows="15" maxlength="250" wrap="hard" required></textarea>
            </div>
            <div class="form-btn-box">
                <button type="submit" value="contactForm" name="contactForm" class="btn btn-white" title="Envoyer message">
                    Envoyer
                </button>
            </div>
        </form>
    </aside>
    <?php
        $_SESSION['envoieMail']="?"
    ?>
</body>