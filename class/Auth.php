<?php
class Auth{

	private $options = [
		'restriction_msg' => "Vous n'avez pas le droit d'accéder à cette page",
	];
	private $session;

	public function __construct($session, $options = []){
		$this->options = array_merge($this->options, $options);
		$this->session = $session;
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////                                                                                    ////////////
////////////                 Les methode pour les divers autres modules                         ////////////
////////////                                                                                    ////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////

	private function hashPassword($password){
		return password_hash($password, PASSWORD_BCRYPT);
	}

	public function get_client_ip_env() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
	 
		return $ipaddress;
	}

	public function currentMonth($month){
		switch( $month ){
	        case 1 : $m = 'january';break;
	        case 2 : $m = 'february';break;
	        case 3 : $m = 'march';break;
	        case 4 : $m = 'april';break;
	        case 5 : $m = 'may';break;
	        case 6 : $m = 'june';break;
	        case 7 : $m = 'july';break;
	        case 8 : $m = 'august';break;
	        case 9 : $m = 'september';break;
	        case 10: $m = 'october';break;
	        case 11: $m = 'november';break;
	        case 12: $m = 'december';break;
	        return $m;
	    }
	}

	public function isUniq($db, $table, $field, $value){
		$res = $db->query("SELECT id FROM $table WHERE $field=?",[$value])->fetch();
		return (!$res)? true : false ;
	}

	public function getAllCats($db){
		return $db->query("SELECT * FROM categories WHERE status=?", [1])->fetchAll();
	}

	public function addTags($db, $tag){
		return $db->query("INSERT INTO categories SET titre=?, token=?, status=?, dateAjout=NOW()", [$tag, Str::rando(50), 1]);
	}

	public function addTopic($db, $titre, $spot, $cat, $message){
		return $db->query("INSERT INTO topics SET titre=?, spot=?, tokenCat=?, message=?, tokenTopic=?, day=?, month=?", 
			[$titre, $spot, $cat, $message, Str::random(50), date('j'), $this->currentMonth(date('m'))] 
		);
	}

	public function getAllTopics($db, $limit=""){
		return $db->query("SELECT * FROM topics $limit")->fetchAll();
	}

	public function addSpot($db, $titre, $link, $message){
		return $db->query("INSERT INTO spot SET name=?, link=?, message=?, token=?, dateAjout=NOW()", [$titre, $link, $message, Str::random(50)]);
	}

	public function getAllSpots($db, $limit=""){
		return $db->query("SELECT * FROM spot $limit")->fetchAll();
	}


	public function contact($db, $name, $email, $message){
		return $db->query("INSERT INTO contact SET name=?, email=?, message=?, dateEnvoie= NOW()", [$name, $email, $message]);
	}

	public function register($db, $nom, $email, $password){
		$password = $this->hashPassword($password);
		$db->query("INSERT INTO users SET pseudo=?, email=?, pass=?, token=?, dateAjout=NOW()",[$nom, $email, $password, Str::random(50)]
		);
	}

	public function confirm($db, $user_id, $token){
		$user = $db->query('SELECT * FROM users WHERE id = ?', [$user_id])->fetch();
		if($user && $user->confirmation_token == $token ){
			$db->query('UPDATE users SET confirmation_token = NULL, confirmation_at = NOW() WHERE id = ?', [$user_id]);
			$this->session->write('auth', $user);
			return true;
		}
		return false;
	}

	public function restrict(){
		if(!$this->session->read('auth')){
			$this->session->setFlash('danger', $this->options['restriction_msg']);
			header('Location: login.php');
			exit();
		}
	}

	public function user(){
		if(!$this->session->read('auth')){
			return false;
		}
		return $this->session->read('auth');
	}

	public function connect($user){
		$this->session->write('auth', $user);
	}

	public function connectFromCookie($db){
		if(isset($_COOKIE['remember']) && !$this->user()){
			$remember_token = $_COOKIE['
			'];
			$parts = explode('==', $remember_token);
			$user_id = $parts[0];
			$user = $db->query('SELECT * FROM users WHERE id = ?', [$user_id])->fetch();
			if($user){
				$expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'Mockingbird050');
				if($expected == $remember_token){
					$this->connect($user);
					setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
				} else{
					setcookie('remember', null, -1);
				}
			}else{
				setcookie('remember', null, -1);
			}
		}
	}

	public function login($db, $pseudo, $password){
		$user = $db->query('SELECT * FROM users WHERE (pseudo = :pseudo)', ['pseudo' => $pseudo])->fetch();
		if($user){
			if(password_verify($password, $user->pass)){
				$this->connect($user);
				return $user;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function remember($db, $user_id){
		$remember_token = Str::random(250);
		$db->query('UPDATE users SET remember_token = ? WHERE id = ?', [$remember_token, $user_id]);
		setcookie('remember', $user_id . '==' . $remember_token . sha1($user_id . 'Mockingbird050'), 0);

	}

	public function logout(){
		setcookie('remember', NULL, -1);
		$this->session->delete('auth');
	}

	public function changePassword($db, $email, $password){
		$res = $db->query("UPDATE users SET password=? WHERE email=?", [$this->hashPassword($password), $email]);
		if($res){
			return true;
		}
		return false;
	}

}