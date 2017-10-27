<?php
include_once 'core/init.php';
$u = new User();
$errors = [];
$user = new User();

if(Input::exists()){
	if(Token::check(Input::get('token')))
	{
		$validate = new Validation();

		$validation = $validate->check($_POST,[
			'username'=>[
			'required'=> true,
			'min'	 => 3,
			'max'	 => 20,
			'unique' => 'users',

			],
			'password'=>[
			'required'=> true,
			'min'	=> 6,
			'max'	=> 20,

			],
			'password_again'=>[
			'required' => true,
			'matches' => 'password'
			],
			'first_name'=>[
			'required'	=> true,
			'min'	=> 3,
			'max'	=> 20,
			],
			'last_name'=>[
			'required' => true,
			'min'	=> 3,
			'max'	=> 20,
			],
			'phone_no'=>[
			'required' => true,
			'min'	=> 10,
			'max'	=> 13,
			]

			]);
		if($validation->passed()){
			$user = new User();

			$record = $user->activeRecord();
			try{
			$record->create([
				'username' => Input::get('username'),
				'password' => Input::get('password'),
				'first_name' => Input::get('first_name'),
				'last_name' => Input::get('last_name'),
				'email' 	=> Input::get('email'),
				'state'		=> Input::get('state'),
				'birthday'	=> Input::get('birthday'),
				'address'	=> Input::get('address'),
				'phone_no'	=> Input::get('phone_no'),
				'type'		=>	0
				
				]);

		$new_user = new User(Input::get('username'));
		$order = new Orders();
		try{

			$order->activeRecord()->create([
				'userId'	=>	$new_user->activeRecord()->getId(),
				'amount'	=>	0
				]);

				Session::flash('login', 'You have successfully registered!! login now');
				Redirect::to('login.php');

		}
		catch(Exception $e){
			die($e->getMessage());
		}

		}catch(Exception $e){
			die($e->getMessage());
		}

		}
		else{
			foreach ($validation->errors() as $error) {
				$errors[] = $error;
			}
		}
	}


}
Html::start('Sign up');
?>
<div class="wrapper">
	<div class="page-wrapper">
	<div class="container-fluid">
		
		<div class="row">
		<?php
include_once 'includes/nav.php';

		?>
			<?php
	if(isset($errors))
	{
		foreach ($errors as $err) {
			
echo '<div class="row"><div class="alert alert-danger">'.$err.'</div></div>';
		}
	}
	?>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="row">
			<form class="" action="" method="post" role="form">

	<div class="col-md-2">
	</div>
			
<div class="col-md-8">
<div class="signup-wrapper">
<div class="row">
	<div class="col-md-12">
		<div class="row">
	<h2><i class="fa fa-arrow-circle-o-up fa-fw"></i> Sign Up!!</h2>
	
<div class="col-md-6">
				<div id="first" class="form-group">
					<label class="control-label" for="first_name">
						First name:
					</label>
					<div>
						<input type="text" required class="form-control" name="first_name" id="first_name">
					</div>
					<div style="color:red;" id="first_text"></div>
				</div>
				<div id="last" class="form-group">
					<label class="control-label" for="last_name">
						Last name:
					</label>
					<div class="">
						<input type="text" required class="form-control" name="last_name" id="last_name">
					</div>
					<div style="color:red;" id="last_text"></div>
				</div>
			
				<div class="form-group">
					<label class="control-label" for="gender">Date Of Birth:</label>
					<div id="sandbox-container">
                <input name="birthday" class="form-control" id="birthday">
            </div>					
				</div>
				<div class="form-group">
					<label class="control-label" for="gender">State Of residence:</label>
					<div class="">
						<select class="form-control" name="state">
				<option value="ABIA">ABIA</option>
                <option value="ADAMAWA">ADAMAWA</option>
                <option value="AKWAIBOM">AKWAIBOM</option>
                <option value="ANAMBRA">ANAMBRA</option>
                <option value="BAUCHI">BAUCHI</option>
                <option value="BAYELSA">BAYELSA</option>
                <option value="BENUE">BENUE</option>
                <option value="BORNO">BORNO</option>
                <option value="CROSSRIVER">CROSSRIVER</option>
                <option value="DELTA">DELTA</option>
                <option value="EDO">EDO</option>
                <option value="EBONYI">EBONYI</option>
                <option value="EKITI">EKITI</option>
                <option value="ENUGU">ENUGU</option>
                <option value="GOMBE">GOMBE</option>
                <option value="IMO">IMO</option>
                <option value="JIGAWA">JIGAWA</option>
                <option value="KADUNA">KADUNA</option>
                <option value="KANO">KANO</option>
                <option value="KATSINA">KATSINA</option>
                <option value="KEBBI">KEBBI</option>
                <option value="KOGI">KOGI</option>
                <option value="KWARA">KWARA</option>
                <option value="LAGOS">LAGOS</option>
                <option value="NIGER">NIGER</option>
                <option value="OGUN">OGUN</option>
                <option value="ONDO">ONDO</option>
                <option value="OSUN">OSUN</option>
                <option value="OYO">OYO</option>
                <option value="NASSARAWA">NASSARAWA</option>
                <option value="PLATEAU">PLATEAU</option>
                <option value="RIVERS">RIVERS</option>
                <option value="SOKOTO">SOKOTO</option>
                <option value="TARABA">TARABA</option>
                <option value="YOBE">YOBE</option>
                <option value="ZAMFARA">ZAMFARA</option>
                <option value="FEDERAL CAPITAL TERRITORY">FEDERAL CAPITAL TERRITORY</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label" for="gender">Residential Address:</label>
					<div class="">
						<textarea name="address" id="address" class="form-control" rows="5"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label" for="gender">Phone Number:</label>
					<div class="">
						<input type="text" class="form-control" name="phone_no" id="phone">
					</div>
					<div style="color:red;" id="phone_text"></div>
				</div>
		</div>
		<div class="col-md-6">
				<div id="user" class="form-group">
					<label class="control-label" for="username">
						Username:
					</label>
					<div class="">
						<input type="text" required class="form-control" name="username" id="username">
					</div>
					<div style="color:red;" id="username_text"></div>
				</div>
				<div id="pass" class="form-group">
					<label class="control-label" for="password">
						Password:
					</label>
					<div class="">
						<input type="password" required class="form-control" name="password" id="password">
					</div>
					<div style="color:red;" id="password_text"></div>
				</div>
				<div id="pass_again" class="form-group">
					<label class="control-label" for="password_again">
						Password Again:
					</label>
					<div class="">
						<input type="password" required class="form-control" name="password_again" id="password_again">
					</div>
					<div style="color:red;" id="password_again_text"></div>				
				</div>
				<div id="mail" class="form-group">
					<label class="control-label" for="email">
						Email:
					</label>
					<div class="">
						<input type="email" required class="form-control" name="email" id="email">
					</div>
					<div style="color:red;" id="email_text"></div>
				</div>
				<input type="hidden" name="token" value="<?= Token::generate();?>">
				
				<div class="form-group">
				<div class="">
					<input type="submit" id="submit" value="Register" class="btn btn-primary col-md-12">
					
				</div>
				</div>
			
		 </div>
	</div>
		</div>
</div>
</div>
</div>	
			</form>
	</div>	
	</div>
</div>
<?php
Html::end();
?>
