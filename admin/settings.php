<?php
include_once 'core/init.php';

$u = new User();
$user = new User();
if(!$u->isloggedIn()){
    Redirect::to('index.php');
  }
if (Input::exists()) {
	if(Token::check(Input::get('token')))
	{

		$validate = new Validation();
		
		$validation = 	$validate->check($_POST, [
			'password_current' => [
				'required' => true,
				'min' => 6,
			],
			'password_new' => [
			'required' => true,
			'min' => 6
			],

			'password_new_again' => [
			'required' => true,
			'min' => 6,
			'matches' => 'password_new'
			]

			]);
		if($validation->passed())
		{
			if($user->activeRecord()->data()->password == Input::get('password_current'))
			{

				try{
					$user->activeRecord()->update([
						'password' => Input::get('password_new')
						]);
					Session::flash('Home','Your password has been changed!');
				}
				catch(Exception $e){
					die($e->getMessage());
				}

			}
			else{
				Session::flash('Home','Your Current Password is Incorrect!');
			}
		}
		else{
			foreach ($validation->errors() as $error) {
				Session::flash('Home', $error);
			}
			}
		}
		}
Html::start('Settings');
?>

    <?php
include_once 'includes/nav.php';

    ?>
<div class="wrapper">
  <div class="page-wrapper"> 
  <div class="container">
    <div class="row">
      
<?php if (Session::exists('Home')) {
                echo'  <div class="alert alert-success">
                    <button data-dismiss="alert" class="close">&times;</button>
                    <div>'.Session::flash('Home').'</div>
                </div>';
                    
                }  ?>

<div class="col-md-12 ">
<div class="row">
<div class="col-md-3">
    <div class="controls">
        <ul class="nav">
            <div class="panel panel-primary">
                
            <div class="panel-heading"><h3>Admin Panel</h3></div>
            </div>
            <li>
                <a href="signup.php">Add Admin</a>
            </li>
            <li>
                <a href="drug_category.php">Add a Drug Category</a>
            </li>
            <li>
                <a href="add_drug.php">Add a Drug</a>
            </li>
            <li>
                <a href="drugs.php">Manage Drugs</a>
            </li>
            <li>
                <a href="generate.php">Generate Report</a>
            </li>
            <li>
                <a href="settings.php">Settings</a>
            </li>
        </ul>
    </div>
</div>

<div class="col-md-9">

		<div class="signup-wrapper">
<div class="col-md-offset-2"><h2><i class="fa fa-lock fa-fw"></i> Change Your Password</h2></div>
		<form class="" action="" method="post">
	<div class="">
		<label class =" control-label" for="password_current">Current Password</label>
		<div class="">
		<input class="form-control" type="password" name="password_current" id="password_current">
			
		</div>
	</div>

	<div class="">
		<label class =" control-label" for="password_new">New Password</label>
		<div class="">
			
		<input class="form-control" type="password" name="password_new" id="password_new">
		</div>
	</div>

	<div class="">
		<label class =" control-label" for="password_new_again">New Password Again</label>
		<div class=""> 
		<input class="form-control" type="password" name="password_new_again" id="password_new_again">
			
		</div>
	</div>

	<input type="hidden" name="token" value="<?= Token::generate();?>">
	<div class="">
	<div class=""><br>
		<input class="btn btn-success" type="submit" name="submit" value="Change Password">
	</div>
		
	</div>
</form>
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
