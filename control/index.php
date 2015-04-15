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
		$this->data['page'] = 'users';
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



	public function CallAPI($method, $url, $data = false) {
		$curl = curl_init();

		switch ($method)
		{
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