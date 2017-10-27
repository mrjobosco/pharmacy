<?php
include_once 'core/init.php';

Html::start('Online Pharmacy - serving you always' );
$u = new User();
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

<div class="col-md-12">
<div class="row">



</div>
</div>

		</div>
	</div>
	</div>	

</div>

<?php
Html::end();
?>
