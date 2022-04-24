<?php

/**
 * @Author: root
 * @Date:   2021-11-10 15:21:48
 * @Last Modified by:   root
 * @Last Modified time: 2022-04-06 14:18:33
 */

class Mail {

	private $options = ['restriction_msg' => "You can't access this page !",];
	private $session;

	public function __construct($session, $options = []){
		$this->options = array_merge($this->options, $options);
		$this->session = $session;
	}

	public function sendEmail($to, $from, $subject, $message, $atachement = false, $file = ''){
		$txt = $message;

		$html = "";

		$sepAlternative = '-----------------------------='.sha1(uniqid(mt_rand()));

		$entete = "From: \"ynovhtb.com\" <$from>\r\n";
		$entete .= "Reply-to: \"ynovhtb.com\" <$from>\r\n";
		$entete .= "Organization: \"ynovhtb.com-entreprise.\"\r\n";
		$entete .= "MIME-Version: 1.0\r\n";
		$entete .= "X-Mailer:PHP".phpversion()."\r\n";

		$entete .= "Content-type: multipart/alternative; boundary=\"$sepAlternative\"\r\n";


		$msg = "--$sepAlternative\n";
		$msg .= "Content-Type: text/plain; charset=\"UTF-8\"\n";
		$msg .= "Content-Transfer-Encoding: 8bits\n\n";
		$msg .= $txt."\n\n";
		$msg .= "--$sepAlternative\n";
		$msg .= "Content-Type: text/html; charset=\"UTF-8\"\n";
		$msg .= "Content-Transfer-Encoding: 8bits\n\n";
		$msg .= $html."\n\n";
		$msg .= "--$sepAlternative--\n";
		if($atachement):
			$msg .= 'Content-Type: application/pdf; name="'.$file."\n";
			$msg .= 'Content-Transfer-Encoding: base64'."\n";
			$msg .= 'Content-Disposition: attachment; filename="'.$file."\n\n";
			$source = file_get_contents($file);
			$source = base64_encode ($source);
			$source = chunk_split($source);
			$msg .= "--$sepAlternative--\n";
		endif;

		mail($to, $subject, $msg, $entete);
	}
}