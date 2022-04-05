<?php

/**
 * @Author: root
 * @Date:   2021-11-10 15:21:48
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2021-11-24 12:27:36
 */

class Mail {

	private $options = ['restriction_msg' => "You can't access this page !",];
	private $session;

	/**
	 * @param $session : Session [Object]
	 * @return $options : array
	*/
	public function __construct($session, $options = []){
		$this->options = array_merge($this->options, $options);
		$this->session = $session;
	}

	public function sendEmail($to, $from, $subject, $message, $atachement = false, $file = ''){
		// version texte
		$txt = $message;

		// version html
		$html = "";

		// on génère un séparateur
		// il séparera les différentes versions du corps de l'email
		// parmis lesquelles le logiciel de mail fera son choix
		$sepAlternative = '-----------------------------='.sha1(uniqid(mt_rand()));

		// entete du message
		$entete = "From: \"ynovhtb.com\" <$from>\r\n";
		$entete .= "Reply-to: \"ynovhtb.com\" <$from>\r\n";
		$entete .= "Organization: \"ynovhtb.com-entreprise.\"\r\n";
		$entete .= "MIME-Version: 1.0\r\n";
		$entete .= "X-Mailer:PHP".phpversion()."\r\n";

		// dans l'entete on définit le séparateur qui sera utilisé dans le corps du message
		$entete .= "Content-type: multipart/alternative; boundary=\"$sepAlternative\"\r\n";

		// corps du message
		// 1- on commence par un séparateur pour signifier la début des versions alternatives
		// on affiche toujours deux tirets avant le séparateur

		$msg = "--$sepAlternative\n";
		// 2- on affiche des entêtes pour la version texte
		$msg .= "Content-Type: text/plain; charset=\"UTF-8\"\n";
		$msg .= "Content-Transfer-Encoding: 8bits\n\n";
		// 3- on place la version texte
		$msg .= $txt."\n\n";
		// 4- on ajoute un séparateur pour signifier la fin d'une version alterntive et le début d'une autre
		$msg .= "--$sepAlternative\n";
		// 5- on affiche des entêtes pour la version HTML
		$msg .= "Content-Type: text/html; charset=\"UTF-8\"\n";
		$msg .= "Content-Transfer-Encoding: 8bits\n\n";
		// 6- on affiche la version HTML
		$msg .= $html."\n\n";
		// 7- on affiche un séparateur suivi de deux tirets pour signifier la fin des versions alternatives
		// Attention n'oubliez pas de rajouter les deux tirets après le séparateur
		// sinon vous aurez des problèmes à l'affichage
		$msg .= "--$sepAlternative--\n";
		if($atachement):
			$msg .= 'Content-Type: application/pdf; name="'.$file."\n";
			$msg .= 'Content-Transfer-Encoding: base64'."\n";
			// Les entêtes sont finies, on met un deuxième retour à la ligne
			$msg .= 'Content-Disposition: attachment; filename="'.$file."\n\n";
			$source = file_get_contents($file);
			$source = base64_encode ($source);
			$source = chunk_split($source);
			$msg .= $source;// On ferme la dernière partie :
			$msg .= "--$sepAlternative--\n";
		endif;

		// envoi l'email
		mail($to, $subject, $msg, $entete);
	}
}