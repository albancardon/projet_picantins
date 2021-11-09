<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/styleCommon.css" type="text/css">
    <link rel="stylesheet" href="asset/css/style<?= $page;?>.css" type="text/css">
    <title>Les Picantins</title>
    <link rel="icon" type="image/png" href="asset/img/logo-lespicantins-cour.svg">
</head>

<body class="bodyCommon">

    <!--header nav descktop-->
    <header class="header-desktop">
        <!--header deployed-->
        <section class="header header-animation">
            <div>
                <a class="link-page" href="<?=URL?>">
                    <img class="logo-societe-header" src="asset/img/logo-lespicantins.svg" alt="logo societe" />
                </a>
            </div>
            <nav class="barre-nav gras">
                <ul class="nav-liste">
                    <li class="liste-link">
                        <a class="link-page" href="<?=URL?>">Acceuil</a>
                    </li>
                    <?php foreach ($data['categorie'] as $categorie):?>
                        <li class="liste-link">
                            <a class="link-page" href="<?=URL?>store#<?= $categorie->getNomCategorie()?>"><?= $categorie->getNomCategorie()?></a>
                        </li>
                    <?php endforeach; ?>
                    <li class="liste-link">
                        <a class="link-page" href="">Contact</a>
                    </li>
                    <li>
                        <a class="link-page" href=""><img class="icon" src="asset/icon/user.svg" alt="icône login"></a>
                    </li>
                    <li class="icon-panier-box">
                        <a class="link-page icon-panier js__nbArticlePanier" href=""></a>
                    </li>
                    <li>
                        <a class="link-page" href="https://www.instagram.com/lespicantins/?hl=fr"><img class="icon" src="asset/icon/instagram.svg" alt="icône instagram"></a>
                    </li>
                </ul>
            </nav>
        </section>
        <!--header contracted-->
        <!-- <section class="header header-animation-fixed-top" >
            <div>
                <a class="link-page" href="<?=URL?>">
                    <img class="logo-societe-header-fixed" src="asset/img/logo-lespicantins-cour.svg" alt="logo societe" />
                </a>
            </div>
            <nav class="barre-fixed-nav">
                <ul class="nav-liste">
                    <li>
                        <a class="link-page" href="<?=URL?>"><img class="icon" src="asset/icon/home.svg" alt="icône home"></a>
                    </li>
                    <?php foreach ($data['categorie'] as $categorie):?>
                        <li class="liste-link">
                            <a class="link-page" href="<?=URL?>store#<?= $categorie->getNomCategorie()?>"><?= $categorie->getNomCategorie()?></a>
                        </li>
                    <?php endforeach; ?>
                    <li class="liste-link">
                        <a class="link-page" href="">Contact</a>
                    </li>
                    <li class="icon-panier-box">
                        <a class="link-page icon-panier js__nbArticlePanier" href=""></a>
                    </li>
                    <li>
                        <a class="link-page" href=""><img class="icon" src="asset/icon/user.svg" alt="icône login"></a>
                    </li>
                    <li>
                        <a class="link-page" href="https://www.instagram.com/lespicantins/?hl=fr"><img class="icon" src="asset/icon/instagram.svg" alt="icône instagram"></a>
                    </li>
                </ul>
            </nav>
        </section> -->
    </header> 

    <!--header nav responsive-->
    <header class="header-mobile">
        <section class="header header-responsive" >
            <a class="link-page" href="<?=URL?>">
                <img class="logo-societe-responsive" src="asset/img/logo-lespicantins-cour.svg" alt="logo societe" />
            </a>
            <nav class="barre-nav-responsive">
                <ul class="nav-liste">
                    <li>
                        <a href="<?=URL?>"><img class="icon-responsive" src="asset/icon/home.svg" alt="icône login"></a>
                    </li>
                    <details class="">
                        <summary class="detail-nav-responsive majDbutMot">
                            nos produits
                        </summary>
                        <?php foreach ($data['categorie'] as $categorie):?>
                            <li class="liste-link">
                                <a class="link-page" href="<?=URL?>store#<?= $categorie->getNomCategorie()?>"><?= $categorie->getNomCategorie()?></a>
                            </li>
                        <?php endforeach; ?>
                        </li>
                        <li class="liste-link-responsive">
                            <a class="link-page" href="">Contact</a>
                        </li>
                    </details>
                    <li>
                        <a href=""><img class="icon-responsive" src="asset/icon/user.svg" alt="icône login"></a>
                    </li>
                    <li class="icon-panier-box">
                        <a class="link-page icon-panier js__nbArticlePanier" href=""></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/lespicantins/?hl=fr"><img class="icon-responsive" src="asset/icon/instagram.svg" alt="icône instagram"></a>
                    </li>
                </ul>
            </nav>
        </section>
    </header>

    <?= $content; ?>

    <!--footer-->
        <footer class="footer">
            <section class="box-footer">
                <ul class="nav-footer">
                    <li class="liste-footer">
                        <a class="link-page" href="<?=URL?>">Acceuil</a>
                    </li>
                    <li class="liste-footer">
                        <a class="link-page" href="">Spécialités</a>
                    </li>
                    <li class="liste-footer">
                        <a class="link-page" href="">Assortiments</a>
                    </li>
                    <li class="liste-footer">
                        <a class="link-page" href="">Confiseries</a>
                    </li>
                    <li class="liste-footer">
                        <a class="link-page" href="">Contact</a>
                    </li>
                    <li class="icon-footer">
                        <a class="link-page" href="https://www.instagram.com/lespicantins/?hl=fr"><img class="icon" src="asset/icon/instagram.svg" alt="icône instagram"></a>
                    </li>
                </ul>
            </section>
            <a class="link-page box-footer" href="<?=URL?>">
                <img class="logo-societe-footer" src="asset/img/logo-lespicantins-cour.svg" alt="logo societe" />
            </a>
            <section class="box-footer">
                <ul class="liste-info-footer">
                    <li class="info-footer">
                        <a class="link-page" href="">Mentions légales</a>
                    </li>
                    <li class="info-footer">
                        <a class="link-page" href="">Condition générales de vente</a>
                    </li>
                </ul>
            </section>
        </footer>

    <!--bouton haut de page-->
        <a class="bouton-up" href="#remonter"><img class="up" src="asset/icon/up.svg" alt="flèche vers le haut"></a>

</body>
        <script src="asset/script/scriptCommon.js" defer></script>
        <script src="asset/script/script<?= $page;?>.js" defer></script>
</html>