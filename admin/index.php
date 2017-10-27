<?php
include_once 'core/init.php';

Html::start('Administrator\'s portal' );
$u = new User();

if(!$u->isAdmin()){
    Redirect::to('../index.php');
}
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
