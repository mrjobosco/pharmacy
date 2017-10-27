<?php
include_once 'core/init.php';
$u = new User();
if (!$u->isLoggedIn()) {
    Redirect::to('index.php');
}


    $user = new User(Input::get('username'));
    if(!$user->activeRecord()->data()){
        Redirect::to('index.php');
    }
if(Input::exists()){
    $record = $user->activeRecord();

    try{


    $record->update([
        'password'      => Input::get('password'),
        'first_name'    => Input::get('first_name'),
        'last_name'     => Input::get('last_name')
        ]);

    if($user->isPatient()){
        try{
            $p = new Patient();
                $p->activeRecord()->relate(['userId' => $record->getId()]);

                $p->activeRecord()->update([

                    'phone_no'      => Input::get('phone_no'),
                    'Address'       => Input::get('address'),
                    'marital_status'=> Input::get('marital_status')
                    ]);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

}catch(Exception $e){
    die($e->getMessage());
}
    
}
$info = $user->activeRecord()->data();

Html::start('Profile');
include_once 'includes/nav.php';
?><div class="wrapper">
<?php include_once "includes/logo.php";?>
<?php include_once "includes/carousel.php";?>
  <div class="page-wrapper"> 
  <div class="container-fluid">
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
    <?php include_once 'includes/aside.php';?>
</div>
<div class="col-lg-8 col-8-md-8">
<div class="col-md-offset-2"><h2><i class="fa fa-user fa-fw"></i> 
    <?= $user->activeRecord()->data()->first_name. ' '.$user->activeRecord()->data()->last_name;?>'s Profile
</h2>
</div>
<form action="" method="post">
<table class="table table-bordered">
    <tbody>
    <tr>
        <td>
            First Name
        </td>
        <td>
            <input type="text" class="form-control" name="first_name" value="<?= $info->first_name;?>">
        </td>
    </tr>
    <tr>
        <td>
            Last Name
        </td>
        <td>
            <input type="text" class="form-control" name="last_name" value="<?= $info->last_name;?>">
        </td>
    </tr>
    <?php if($u->isAdmin()){ ?>
    <tr>
        <td>
            Password
        </td>
        <td>
            <input type="text" class="form-control" name="password" required value="<?= $info->password;?>">
        </td>
    </tr>
    <?php } ?>

    <?php if($user->isPatient()){
        $patient = $user->getPatient(); 
        ?>
        <tr>
        <td>
            Gender
        </td>
        <td>
            <input type="text" class="form-control" disabled name="gender" value="<?= $patient->gender;?>">
        </td>
    </tr>
<tr>
        <td>
            Phone Number
        </td>
        <td>
            <input type="text" class="form-control" name="phone_no" value="<?= $patient->phone_no;?>">
        </td>
    </tr>
    <tr>
        <td>
            Marital Status
        </td>
        <td>
            <input type="text" class="form-control" name="marital_status" value="<?= $patient->marital_status;?>">
        </td>
    </tr>
        <tr>
        <td>
            Address
        </td>
        <td>
            <input type="text" class="form-control" name="address" value="<?= $patient->Address;?>">
        </td>
    </tr>


    <?php } ?>
    <tr>
        <td><input type="submit" class="btn btn-success" value="submit"></td>
    </tr>
    </tbody>
</table>
</form>



</div>
</div>

        </div>
    </div>
    </div>  

</div>




    <?php
    Html::end();
    include_once 'includes/jaside.php';
    ?>
