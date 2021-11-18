
<?php 
$mail = isset($_SESSION['envoieMail'])?$_SESSION['envoieMail']:'';
$modifBdd = isset($_SESSION['modif'])?$_SESSION['modif']:'';
if (isset($mail)){
    $_SESSION['envoieMail'] = "?";
}
if (isset($modifBdd)){
    $_SESSION['modif'] = "?";
}
?>
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

        <?php foreach ($contenuTab['categorie'] as $categorie):?>
            <a id="categorie-<?= $categorie->getIdCategorie()?>" class="container-box-produit" href="<?=URL?>store#<?= $categorie->getNomCategorie()?>">
                <div id="boxImg-<?= $categorie->getIdCategorie()?>" class="produit-box-img">
                    <img class="img-produit ombre" src="asset/img/acceuil/<?= $categorie->getNomCategorie()?>.jpg" 
                    alt="photo de <?= $categorie->getNomCategorie()?>">
                </div>
                <p class="produit-legende ombre majDbutMot">Nos <?= $categorie->getNomCategorie()?></p>
            </a>
        <?php endforeach; ?>
    
    </aside>
    
    <!-- aside-phrase-de-fin -->
    <aside class="box-phrase">
        <a href="https://www.instagram.com/lespicantins/?hl=fr" class="phrase-insta ombre">
            N'oubliez pas de venir nous suivre sur notre Instagram
        </a>
    </aside>
</body>