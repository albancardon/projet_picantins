
<?php 
// deconnexion automatique au bout de 15 min d'inactivité
if(empty($_SESSION['logged']) || empty($_SESSION['derniere_action']) || (time() - $_SESSION['derniere_action']) > 900) {
    // fermeture de la $_SESSION
    $_SESSION=array();
    if (isset($_COOKIE[session_name()])){
        setcookie(session_name(), '', time()-1);
    }
    //Détruire la session
    session_destroy();
}else {
    $_SESSION['derniere_action'] = time(); // mise à jour de la variable
}
$user = isset($_SESSION['user'])?$_SESSION['user']:'';
if (!empty($user)){
    echo '<div id="idClient'.$user["idCompte"].'" class="hidden js__idClient"></div>';
}
?>
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
                        <a class="link-page" href="<?=URL?>">acceuil</a>
                    </li>
                    <?php foreach ($data['categorie'] as $categorie):?>
                        <li class="liste-link">
                            <a class="link-page" href="<?=URL?>store#<?= $categorie->getNomCategorie()?>"><?= $categorie->getNomCategorie()?></a>
                        </li>
                    <?php endforeach; ?>
                    <li class="liste-link">
                        <a class="link-page" href="<?=URL?>contact">info/contact</a>
                    </li>
                    <li class="liste-link">
                        <a class="link-page" href="<?=URL?>gestion_produits">gestion produit</a>
                    </li>
                    <li class="liste-link">
                        <a class="link-page" href="<?=URL?>gestion_comptes">gestion compte</a>
                    </li>
                    <?php if (empty($_SESSION['logged'])): ?>
                        <li class="liste-icone">
                            <a class="link-page" href="<?=URL?>login"><img class="icon" src="asset/icon/user.svg" alt="icône login"></a>
                            <p class="legende-icone">connexion</p>
                        </li>
                    <?php else: ?>
                        <li class="liste-icone">
                            <a class="link-page" href="<?=URL?>myAccount"><img class="icon" src="asset/icon/userConnected.svg" alt="icône compte"></a>
                            <p class="legende-icone">mon compte</p>
                        </li>
                    <?php endif ?>
                    <li class="icon-panier-box">
                        <a class="link-page icon-panier js__nbArticlePanier" href="<?=URL?>panier"></a>
                    </li>
                    <li class="liste-icone">
                        <a class="link-page" href="https://www.instagram.com/lespicantins/?hl=fr"><img class="icon" src="asset/icon/instagram.svg" alt="icône instagram"></a>
                    </li>
                    <?php if (!empty($_SESSION['logged'])): ?>
                        <li class="liste-icone">
                            <form action="loginBdd" method="post">
                                <button type="submit" value="deconnect" name="deconnect" id="deconnect" class="legende-icone">déconnexion</button>
                            </form>
                        </li>
                    <?php endif ?>
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
                    <li class="liste-icone">
                        <a class="link-page" href="<?=URL?>"><img class="icon" src="asset/icon/home.svg" alt="icône home"></a>
                    </li>
                    <?php foreach ($data['categorie'] as $categorie):?>
                        <li class="liste-link">
                            <a class="link-page" href="<?=URL?>store#<?= $categorie->getNomCategorie()?>"><?= $categorie->getNomCategorie()?></a>
                        </li>
                    <?php endforeach; ?>
                    <li class="liste-link">
                        <a class="link-page" href="<?=URL?>contact">info/contact</a>
                    </li>
                    <li class="liste-link">
                        <a class="link-page" href="<?=URL?>gestion_produits">gestion produit</a>
                    </li>
                    <li class="liste-link">
                        <a class="link-page" href="<?=URL?>gestion_comptes">gestion compte</a>
                    </li>
                    <li class="icon-panier-box">
                        <a class="link-page icon-panier js__nbArticlePanier" href=""></a>
                    </li>
                    <?php if (empty($_SESSION['logged'])): ?>
                        <li class="liste-icone">
                            <a class="link-page" href="<?=URL?>login"><img class="icon" src="asset/icon/user.svg" alt="icône login"></a>
                            <p class="legende-icone">connexion</p>
                        </li>
                    <?php else: ?>
                        <li class="liste-icone">
                            <a class="link-page" href="<?=URL?>myAccount"><img class="icon" src="asset/icon/userConnected.svg" alt="icône compte"></a>
                            <p class="legende-icone">mon compte</p>
                        </li>
                    <?php endif ?>
                    <li class="liste-icone">
                        <a class="link-page" href="https://www.instagram.com/lespicantins/?hl=fr"><img class="icon" src="asset/icon/instagram.svg" alt="icône instagram"></a>
                    </li>
                    <?php if (!empty($_SESSION['logged'])): ?>
                        <li class="liste-icone">
                            <form action="loginBdd" method="post">
                                <button type="submit" value="deconnect" name="deconnect" id="deconnect" class="legende-icone">déconnexion</button>
                            </form>
                        </li>
                    <?php endif ?>
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
                    <li class="liste-icone">
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
                            <a class="link-page" href="<?=URL?>contact">info/contact</a>
                        </li>
                        <li class="liste-link-responsive">
                            <a class="link-page" href="<?=URL?>gestion_produits">gestion produit</a>
                        </li>
                    </details>
                    <li class="liste-icone">
                        <a href=""><img class="icon-responsive" src="asset/icon/user.svg" alt="icône login"></a>
                    </li>
                    <li class="icon-panier-box">
                        <a class="link-page icon-panier js__nbArticlePanier" href=""></a>
                    </li>
                    <li class="liste-icone">
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
                        <a class="link-page" href="<?=URL?>">acceuil</a>
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
                        <a class="link-page" href="<?=URL?>contact">info/contact</a>
                    </li>
                    <li class="liste-footer">
                        <a class="link-page" href="<?=URL?>gestion_produits">gestion produit</a>
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