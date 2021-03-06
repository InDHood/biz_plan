<?php 

class Control {
	
	public $pm;
	public $data;
	public $auth_url = array( 'home', 'login', 'register', 'users' );

	public function __construct( $pm ) {

		$this->aption();
		
		// Start the UI

		if( empty( $pm[0] ) ) $pm[0] = 'home';

		$this->pm = $pm;

		// Check if url is permitted
		if( in_array( $pm[0], $this->auth_url ) ) {
			
			$this->{$pm[0]}();

		} else {

			$this->p404();

		}

		$this->ui();

	}


	protected function aption(){

		if( $_POST ) {
			// e($_POST);exit();
			if ($_POST['_task'] == "register") {
				
				unset($_POST['_task']);

				$data=$_POST;
				$method= 'POST';
				$url= API . "users";
				$result= $this->callAPI($method, $url, $data );
				e($result);
			}
			else if ($_POST['_task'] == "login") {

				unset($_POST['_task']);

				$data=$_POST;
				$method= 'POST';
				$url= API . "login";
				$result= $this->callAPI($method, $url, $data );
				e($result);
			}
		}

	}


	public function home(){
		$this->data['page'] = 'home';
	}


	public function login(){
		$this->data['page'] = 'login';
	}


	public function register(){
		$this->data['page'] = 'register';
	}


	public function users(){
		$d['page'] = 'users';
		
		$url = API . 'users';
		$method = 'GET';

		$d['users'] = objToArr( json_decode($this->callAPI( $method, $url )) );

		
		$this->data = $d;
	}


	public function p404(){
		$this->data['page'] = 'Not Found';
	}


	public function ui(){
		$UI = new UI();

		$UI->head();
		$UI->section( $this->data );
		$UI->foot();

	}
	public static function tbl($tbl,$type="fields"){
		$db = array(
			'users' =>array( 
				'table' => array('User'=>'user', 'Email'=>'email', 'First Name'=>'firstname', 'Last Name'=>'lastname',  'Phone'=>'phone',  'Gender'=>'gender')
				)
			);
		return $db[$tbl][$type];
	}
	// public function login() {
	// 	// if(empty($_POST)) { $this->home(); exit(); }
	// 	if(!empty($_POST['user'])) { $check = _query('users', "user = '".$_POST['user']."' AND pass = '".$_POST['pass']."'",'',1,array('id','user','pass','email','firstname','lastnname')); }
	// 	// if(!empty($_POST['email'])) { $check = _query('users', "email = '".$_POST['email']."' AND pass = '".$_POST['pass']."'",'',1,array('id','user','email','details','role')); }
	// 	// if(!empty($check[0])) { $result = (object) $check[0]; }		
	// 	e('success');

	// 	} else {
	// 		e('incorrect');
	// 	}
	// }



	public function callAPI( $method, $url, $data = false ) {

		$data['apiKey'] = API_KEY;

		$curl = curl_init();

		switch ( $method ) {

			case "POST":
			curl_setopt($curl, CURLOPT_POST, 1);

			if ($data)
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;
			case "PUT":
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
			if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;
			case "DELETE":
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
			if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;
			default:
			if ($data)
				$url = sprintf("%s?%s", $url, http_build_query($data));
		}

    	// Optional Authentication:
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, "username:password");

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);




		$result = curl_exec($curl);

		curl_close($curl);

		return $result;
	}

}

?>