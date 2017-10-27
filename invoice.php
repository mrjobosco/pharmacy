<?php
include_once 'core/init.php';
$u = new User();
if(!$u->isLoggedIn()){
    Redirect::to('index.php');
}
$order = new Orders();
$order->activeRecord()->relate(['userId' => $u->activeRecord()->getId()]);

$userO = new User($order->activeRecord()->data()->userId);

$invoice = $order->getLastInvoice();
Html::start('');
?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-2">
                <img class="pull-right" src="images/logo.png">
            </div>
            <div class="col-md-8">
                
            <h3 align="center">ONLINE PHARMACY</h3>
            <h5 align="center">Serving you better!!</h5>
            </div>
            <div class="clearfix"></div>
             
            <table class="table">
    <tr>
        <thead>
            <th>S/no</th>
            <th>Full Name</th>
            <th>INVOICE ID</th>
            <th>Amount</th>
        </thead>
        <tbody>
            <tr>
                <td>1.</td>
                <td><?= $userO->activeRecord()->data()->first_name.' '.$userO->activeRecord()->data()->last_name;?></td>
                <td><?=$invoice->invoice_number;?></td>
                <td>N<?=$invoice->amount;?> </td>
            </tr>
            <tr>
                <td></td>
                <td><strong>Total</strong></td>
                <td>N<?=$invoice->amount;?></td>
            </tr>
        </tbody>
    </tr>
</table>
      <button class="btn btn-success" onclick="window.print();">Print Result</button>
      <a class="btn btn-default" href="index.php">Go Home</a>
        </div>
    </div>
</div>


<?php
Html::end();
?>