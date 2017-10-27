<?php
class User
{
	private $_session_name, $_isLoggedIn, $_activeRecord, $_error, $_db;

	public function __construct($user = null){
		$this->_db = DB::getInstance();
		$this->_activeRecord = new ActiveRecord('users');
		$this->_session_name = Config::get('session/session_name');

		if(!$user){
				if(Session::exists($this->_session_name)){
						$user = Session::get($this->_session_name);
						if($this->_activeRecord->find($user))
						{
								$this->_isLoggedIn = true;
								
						}
				}

		}
		else{
				$this->_activeRecord->find($user);
		}
}

public static function tableName(){
		return 'users';
	}

		public function activeRecord(){
			return $this->_activeRecord;
		}

		public function login($username = null, $password = null, $remember= false)
		{	
			if(!$username && !$password && $this->exists())
			{
					Session::put($this->_session_name, $this->_activeRecord->getId());
			}
			else{

						if($this->_activeRecord->find($username)){
								if( $password === $this->_activeRecord->data()->password)
								{
										Session::put($this->_session_name, $this->_activeRecord->getId());

				if($remember){
					$hash  = Hash::unique();
					$hashCheck = $this->_db->get('users_session',['user_id', '=', $this->_activeRecord->getId()]); 
				
					if(!$hashCheck->counter()){
						$this->_db->insert('users_session', [
							'user_id' => $this->_activeRecord->getId(),
							'hash' => $hash
							]);
					}else{
						$hash = $hashCheck->first()->hash;
					}

					Cookie::put(Config::get('remember/cookie_name')	, $hash, Config::get('remember/cookie_expiry'));
				}

										return true;
								}
								else{
									$this->_error .= 'Incorrect Password';
									return false;
								}
						}
						else{
							$this->_error = 'Incorrect Username, Please sign-up if you haven\'t!';
							return false;
						}

			}


	}

	public function logout(){
		$this->_db->delete('users_session',['user_id', '=', $this->_activeRecord->getId()]);
		Session::delete(Config::get('session/session_name'));
		Cookie::delete(Config::get('remember/cookie_name'));
	}

	public function errors(){
		return $this->_error;
	}
	public function exists(){
		return (!empty($this->_activeRecord->data()))? true: false;
	}

	public function isLoggedIn(){
		return $this->_isLoggedIn;
	}

	public function isAdmin(){
		if($this->_activeRecord->data()->type == 1)
		{
			return true;
		}
	}
}
?>