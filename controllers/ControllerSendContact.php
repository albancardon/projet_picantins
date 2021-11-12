<?php

session_start();

class ControllerSendContact
{

    public function __construct()
    {
        if (isset($_GET)) {
            $this->getUrl();
        }else {
            throw new Exception('Contenu introuvable');
        }
    }

    private function getUrl(){

		//recupération et securisation des données envoyées par le fomulaire
        foreach ($_POST as $key => $value) {
            $params['*' . $key] = (isset($_POST[$key]) && !empty($_POST[$key])) ? htmlspecialchars($_POST[$key]) : null;
        }
		// verification du formulaire qui à envoyer ces infos
		if(isset($params['*contactForm'])){
			//vérification de la présence des donnés nom, prénom, mail, et message
			if(!empty($params['*nom']) AND !empty($params['*prenom']) AND !empty($params['*mail']) AND !empty($params['*message'])){
				$header="MIME-Version: 1.0\r\n";
				$header.='From:"les-picantins.com"<siteContact@lespicantins.com>'."\n";
				$header.='Content-Type:text/html; charset="uft-8"'."\n";
				$header.='Content-Transfer-Encoding: 8bit';

				$message='
				<html>
					<body>
						<div align="center">
							<u>Nom de l\'expéditeur :</u>'.$params['*nom'].'<br />
							<u>Prenom de l\'expéditeur :</u>'.$params['*prenom'].'<br />
							<u>Mail de l\'expéditeur :</u>'.$params['*mail'].'<br />
							<br />
							'.nl2br($params['*message']).'
						</div>
					</body>
				</html>
				';

				mail("alban.cardon@gmail.com", "CONTACT - les-picantins.com", $message, $header);
				echo $message." <br>";
				$_SESSION['envoieMail']='ok';
				//retour automatique à la page contact
				header('Location: /php_projet-CDA/0.projet_les_picantins-code/contact');
			}else{
				$_SESSION['envoieMail']='no';
				//retour automatique à la page contact
				header('Location: /php_projet-CDA/0.projet_les_picantins-code/contact');
			}
		}
	}
}