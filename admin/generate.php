<?php
include_once 'core/init.php';

Html::start('Administrator\'s portal' );
$u = new User();

if(!$u->isAdmin()){
    Redirect::to('../index.php');
}

$invoice = new Invoice();
$all = $invoice->activeRecord()->read();
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
    
	            <table class="table">
    <tr>
        <thead>
            <th>S/no</th>
            <th>Full Name</th>
            <th>INVOICE ID</th>
            <th>Amount</th>
            <th>Location</th>
        </thead>
        <tbody>
        <?php
        $i = 1;
        $total = 0;
        foreach ($all as $key) {
            $order = new Orders();
            $order->activeRecord()->relate(['id' => $key->orderId]);

            $userO = new User($order->activeRecord()->data()->userId);
?>
            <tr>
                <td><?= $i++;?></td>
                <td><?= $userO->activeRecord()->data()->first_name.' '.$userO->activeRecord()->data()->last_name;?></td>
                <td><?=$key->invoice_number;?></td>
                <td>N<?=$key->amount;?> </td>
                <td><?= $userO->activeRecord()->data()->address;?></td>
            </tr>
            <?php
            $total += $key->amount;

}
            ?>
            <tr>
                <td></td>
                <td><strong>Total</strong></td>
                <td>N<?=$total;?></td>
            </tr>
        </tbody>
    </tr>
</table>



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
