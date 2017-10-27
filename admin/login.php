<?php
include_once 'core/init.php';
$u = new User();

$user = new User();
if($user->isLoggedIn()){
	Redirect::to('index.php');
}
if(Input::exists())
{
	if(Token::check(Input::get('token'))){
		$validate = new Validation();

		$validation = $validate->check($_POST, [
			'username' => [
			'required' => true
			],
			'password' => [
			'required'	=> true
			], 
			]);

		if($validation->passed()){
			$user = new User();
			$remember = (Input::get('remember') === 'on')? true : false; 
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);

			if($login){
				Redirect::to('index.php');
			}else{
				Session::flash('login',$user->errors());
			}
		}
		else print_r($validation->errors());

	}
	$user = new User();


}

Html::start('Sign in');
?>
<div class="wrapper">
	<div class="page-wrapper">

<div class="container">
	<?php 
include_once 'includes/nav.php';
	?>

<?php
if(Session::exists('login')){
echo '<div class="row"><div class="col-md-12 alert alert-success">'.Session::flash('login').'</div></div>';
}
?>
	
	<div class="row">
	<div class="col-md-2">
		
	</div>
<div class="col-md-8">
<div class="signup-wrapper">
	<div class="row">
		
<div class="col-md-6">
	
	<div class="">
		<div class="">
			<h3><i class="fa fa-sign-in fw"></i> Login</h3> 
		</div>
		<div>
			<form action="" method="post" role="form">
				<div class="form-group">
					<label class="control-label" for="username">
						Username:
					</label>
					<div class="">
						<input type="text" required class="form-control" name="username" id="username">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label" for="password">
						Password:
					</label>
					<div>
						<input type="password" required class="form-control" name="password" id="password">
					</div>
				</div>
				<div class="form-group">
					<input type="checkbox" name="remember" id="remember"> Remember Me
				</div>
				<input type="hidden" name="token" value="<?= Token::generate();?>">
				<div class="form-group">
					<input type="submit" value="login" class="btn btn-info">
				</div>
			</form>
		<hr>	
		</div>
	</div>
	</div>
	<div class="col-md-6">
	<div class="flush-down">
		<h5>
			New to Pharmacy, why don't you join us!. Signup below and buy start buying affordable and original drugs
		</h5>
		<h5>
			And get it delivery at your doorstep in record time!!
		</h5>
		<p><a href="signup.php" class="btn btn-success">Sign Up <i class="fa fa-angle-double-right fa-fw"></i> </a></p>
	</div>
		
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
Html::end();
?>