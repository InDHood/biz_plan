<?php  

class UI{
	
	public $login;

	public function __construct(){

	}

	public function head(){?>
		<html>
		<head>
			<title>Register Biz Plan</title>
			<?php $this->style(); ?>
	        <?php $this->script(); ?>
		</head>
		<body>
			<div class="container">
				<header>
					<div class="title">Register Biz Plan</div>
				</header>
	<?php }

	public function foot(){?>
		</div>
		</body>
		</html>
	<?php }

	public function script(){ }

	public function style(){ css('biz.css'); }
	

	public function section( $data ) { extract( $data ); ?>

		<?php if( $page == 'register' ) { ?>
		<form method="post" action="">
				<input type="hidden" name="_task" value="register">
			<div class="_form"><input name="firstname" placeholder="First Name" type="text"/></div>
			<div class="_form"><input name="lastname" placeholder="Last Name" type="text"/></div>
			<div class="_form"><input name="email" placeholder="Email" type="text"/></div>
			<div class="_form"><input name="phone" placeholder="Phone" type="text"/></div>
			<div class="_form"><input name="user" placeholder="Username" type="text"/></div>
			<div class="_form"><input name="pass" placeholder="Password" type="password"/></div>
			<div class="btn"><input type="submit" value="Register"/></div>
		</form>
		<?php } ?>


		<?php if ( $page == 'users' ) { ?>
			<table>
			<tr>
			<td></td><td>User</td><td>Email</td><td>First Name</td>
			</tr>
			<?php foreach ($users as $k => $v) { ?>
			<tr>
				<td><?php e( $v['id'] ); ?> </td>
				<td><?php e( $v['user'] ); ?> </td>
				<td><?php e( $v['email']); ?> </td>
				<td><?php e( $v['firstname'] ); ?> </td>
			</tr>				
			<?php } ?>
			</table>
		<?php } ?>

		<?php if ( $page == 'login' ) { ?>
			<form action="" method="post" class="form">
				<input type="hidden" name="_task" value="login">
				<div><input type="text" name="user" value="" placeholder="Username" autocomplete="off"></div>
				<div><input type="password" name="pass" value="" placeholder="Password" autocomplete="off"></div>
				<div><button>Login</button></div>
			</form>
		<?php } ?>
	<?php }


}

?>
