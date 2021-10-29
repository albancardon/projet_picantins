<body class="bodyCommon">
    <!-- main contenu -->
    <main class="main-container">
        <div class="container-image">
            <img class="img-boutique ombre" src="asset/img/acceuil/magasin.jpg" alt="photo du comptoir du magasin">
        </div>
        <article class="container-text">
            <h1 class="text-title majDbutMot">
                <span>Chocolatier, Confiseur</span>
                <span class="saut_ligne"></span>
                <span>à Compiègne</span>
            </h1>
            <p class="text-description ombre">
                Situé dans le centre de Compiègne. <br/>
                Nous avons le plaisir de vous accueillir depuis 2001.<br/>
                une envie de sucré: venez gouter nos créations.
            </p>
        </article>
    </main>
    <!-- aside-produit  -->
    <aside class="aside-container">
    
        <article class="premier-produit container-box-produit">
            <div class="produit-box-img">
                <img class="img-produit ombre" src="asset/img/acceuil/ballotin.jpg" alt="photo de ballotin">
            </div>
            <p class="produit-legende ombre majDbutMot">Nos Spécialités</p>
        </article>
    
        <article class="second-produit container-box-produit">
            <div class="produit-box-img">
                <img class="img-produit ombre" src="asset/img/acceuil/marronGlace.jpg" alt="photo de marron glacé">
            </div>
            <p class="produit-legende ombre majDbutMot">Nos Confiseries</p>
        </article>
    
        <article class="troisieme-produit container-box-produit">
            <div class="produit-box-img">
                <img class="img-produit ombre" src="asset/img/acceuil/chocolat.jpg" alt="photo ballotin">
            </div>
            <p class="produit-legende ombre majDbutMot">Nos Assortiments</p>
        </article>
    </aside>
    
    <!-- aside-phrase-de-fin -->
    <aside class="box-phrase">
        <a href="https://www.instagram.com/lespicantins/?hl=fr" class="phrase-insta ombre">
            N'oubliez pas de venir nous suivre sur notre Instagram
        </a>
    </aside>
    <?php
    foreach ($categorie as $categorie):
    ?>
    <h2>
        <?php
        echo $categorie->getNomCategorie()
        ?>
    </h2>
    <?php endforeach; ?>
</body>