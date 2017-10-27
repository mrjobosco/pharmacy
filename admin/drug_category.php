<?php
include_once 'core/init.php';

Html::start('Administrator\'s portal' );
$u = new User();

if(!$u->isAdmin()){
    Redirect::to('../index.php');
}

if(Input::exists()){
    $category = new Category();
    try{
    $category->activeRecord()->create([

        'name' => Input::get('category')


        ]);
    Session::flash('Home','Your have successfully added a category!');

}
        catch(Exception $e)
        {
            die($e->getMessage());
        }

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
                
            <div class="panel-heading"><h4>Admin Panel</h4></div>
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
    <form action="" method="post">
        <div class="form-group">
            <label class="control-label" for="add_category">
                <h4>Add A Drug Category</h4>
            </label>
            <div class="">
                <input type="text" class="form-control" name="category">
            </div><br>
            <div class="form-group">
                <input type="submit" class="btn btn-info pull-right" value="Add">
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

<?php
Html::end();
?>
