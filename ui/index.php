<?php  

class UI{

	public function __construct(){

	}

	public function head(){
		# HTML Codes Here
	}

	public function foot(){
		# HTML Codes Here
	}

	public function section( $data ){
		# HTML Codes Here
		e( $data );

		if ($data['page']=='register') {?>
		<html>
		<head>
			<title></title>
		</head>
		<body>
		<form method="post" action="">
		<div class="_form"><input name="firstname" placeholder="First Name" type="text"/></div>
		<div class="_form"><input name="lastname" placeholder="Last Name" type="text"/></div>
		<div class="_form"><input name="email" placeholder="Email" type="text"/></div>
		<div class="_form"><input name="phone" placeholder="Phone" type="text"/></div>
		<div class="_form"><input name="user" placeholder="Username" type="text"/></div>
		<div class="_form"><input name="pass" placeholder="Password" type="password"/></div>
		<div class="btn"><input type="submit" value="Register"/></div>
		</body>
		</form>
		</html>
		
	 
	<?php


			
		}
	}


}


?>
