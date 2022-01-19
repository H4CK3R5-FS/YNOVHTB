<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2021-11-24 11:02:48
 */

class Auth{

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

	/**
	 * @param $password : string
	 * @return String 
	*/
	public function hashPassword($password){
		return password_hash($password, PASSWORD_BCRYPT);
	}
	
	/**
	 * @param $db : pdo [Object]
	 * @param $pseudo : string
	 * @param $email : string
	 * @param $password : string 
	*/
	public function register($db, $pseudo, $email, $password){
		$password = $this->hashPassword($password);
		$tokenConfirmation = Str::random(250);
		$db->query("INSERT INTO users SET pseudo=?, email=?, password=?, token=?, level=?, confirmation_token = ?", 
			[$pseudo, $email, $password, Str::random(50), 'member', $tokenConfirmation]
		);
		// Email::send()
	}

	/**
	 * @param $db : pdo [Object]
	 * @param $user_id : int
	 * @param $token : string 
	*/
	public function confirm($db, $user_id, $token){
		$user = $db->query('SELECT * FROM users WHERE id = ?', [htmlspecialchars($user_id)])->fetch();
		if($user && $user->confirmation_token == $token ){
			$db->query('UPDATE users SET confirmation_token = NULL, confirmation_at = NOW() WHERE id = ?', [htmlspecialchars($user_id)]);
			$this->session->write('auth', $user);
			return true;
		}
		return false;
	}

	/**
	 * @param null
	*/
	public function restrict(){
		if(!$this->session->read('auth')){
			$this->session->setFlash('danger', $this->options['restriction_msg']);
			header('Location: auth/index.php');
			exit();
		}
	}

	/**
	 * @param null
	*/
	public function user(){
		return (!$this->session->read('auth'))? false : $this->session->read('auth');
	}

	/**
	 * @param $user : user [Object]
	*/
	public function connect($user){
		$this->session->write('auth', $user);
	}

	/**
	 * @param $db : pdo [Object]
	*/
	public function connectFromCookie($db){
		if(isset($_COOKIE['remember']) && !$this->user()){
			$remember_token = $_COOKIE['remember'];
			$parts = explode('==', $remember_token);
			$user_id = htmlspecialchars($parts[0]);
			$user = $db->query('SELECT * FROM users WHERE id = ?', [htmlspecialchars($user_id)])->fetch();
			if($user):
				$expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'YnovHtb2021');
				if($expected == $remember_token):
					$this->connect($user);
					setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
				else:
					setcookie('remember', null, -1);
				endif;
			else:
				setcookie('remember', null, -1);
			endif;
		}
	}

	/**
	 * @param $db : pdo [Object]
	 * @param $pseudoOrMail : string
	 * @param $password : string
	 * @param $remember : boolean
	*/
	public function login($db, $pseudoOrMail, $password, $remember = false){
		$user = $db->query('SELECT * FROM users WHERE (pseudo=? or email=?) AND confirmation_token IS NULL', [$pseudoOrMail, $pseudoOrMail])->fetch();
		if($user):
			if(password_verify($password, $user->password)):
				$this->connect($user);
				if($remember): $this->remember($db, $user->id) ; endif;
				return $user;
			else:
				return false;
			endif;
		else:
			return false;
		endif;
	}

	/**
	 * @param $db : pdo [Object]
	 * @param $user_id : int
	*/
	public function remember($db, $user_id){
		$remember_token = Str::random(250);
		$db->query('UPDATE users SET remember_token = ? WHERE id = ?', [$remember_token, htmlspecialchars($user_id)]);
		setcookie('remember', htmlspecialchars($user_id) . '==' . $remember_token . sha1(htmlspecialchars($user_id) . 'YnovHtb2021'), 0);
	}

	/**
	 * @param null
	*/
	public function logout(){
		setcookie('remember', NULL, -1);
		$this->session->delete('auth');
	}

	/**
	 * @param $db : pdo [Object]
	 * @param $email : string
	 * @param $password : string
	*/
	public function changePassword($db, $email, $password){
		$res = $db->query("UPDATE users SET password=? WHERE email=?", [$this->hashPassword($password), $email]);
		return ($res)? true : false;
	}

	/**
	 * @param $db : pdo [Object]
	 * @param $email : string
	*/
	public function resetPassword($db, $email){
		$reset_token = Str::random(60);
		$user = $db->query('SELECT * FROM users WHERE email = ? AND confirmation_at IS NOT NULL', [htmlspecialchars($email)])->fetch();
		if($user):
			$db->query('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?', [$reset_token, $user->id]);
			return $user;
		endif;
		return false;
	}

	/**
	 * @param $db : pdo [Object]
	 * @param $user_id : string
	 * @param $token : string
	*/
	public function checkResetToken($db, $user_id, $token){
		return $db->query('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)', [htmlspecialchars($user_id), htmlspecialchars($token)])->fetch();
	}
}