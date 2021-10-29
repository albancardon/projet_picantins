<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/styleCommon.css" type="text/css">
    <link rel="stylesheet" href="asset/css/stylePanier.css" type="text/css">
</head>

<body id="contentPanier" class="bodyCommon">
    <h1 class="titlePage majDbutMot">Mon Panier</h1>
    <main id="js__panierListeArticle" class="main-panier">
        <!-- entete du panier -->
        <article class="header-panier">
            <h2 class="title-panier majDbutMot">Contenu panier</h2>
            <section class="total-container">
                <p class="legend-prix-panier">Sous Total</p>
                <p class=" js__prixPanier"></p>
                <button class="btn btn-white btn-fat" title="Passer commande">
                    passer commande
                </button>
            </section>
        </article>

        <!-- liste des produit dans le panier -->
        <article id="js__panierVide" class="produit-panier ombre">
                <h3 class="message-panier-vide">Votre panier est vide!</h3>
        </article>

    </main>

    <aside id="js_asidePanier" class="invisible">
        <P>
            Sous-Total: <span class="gras js__prixPanier"></span>
        </P>
        <button class="btn btn-grey btn-fat" title="Passer commande">
            passer commande
        </button>
    </aside>
    <script src="asset/script/scriptPanier.js" defer></script>
    <script src="asset/script/scriptCommonLocalStorage.js" defer></script>
</body>