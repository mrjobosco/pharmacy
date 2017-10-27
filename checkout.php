<?php
include_once 'core/init.php';

Html::start('Online Pharmacy - serving you always' );
$u = new User();

$order = new Orders();

$order->activeRecord()->relate(['userId' => $u->activeRecord()->getId()]);

$orders = $order->getOrders();

if(Input::exists()){
$invoice = new Invoice();
foreach ($orders as $key) {
    $orDetails = new OrderDetails();
    $orDetails->activeRecord()->relate(['id' => $key->id]);
    try{

if($orDetails->activeRecord()->data()->paid != 1 ){
        $product = new Product();

        $product->activeRecord()->relate(['id'    => $key->productId]);

        $qqty = $product->activeRecord()->data()->qty;
        
        $product->activeRecord()->update([
            'qty'   =>  ($qqty - $key->qty) 
            ]); 
}
    $orDetails->activeRecord()->update([
        'paid'  => 1
        ]);
        }
        catch(Exception $e){
            die($e->getMessage());

        }

}

$count =  (count($invoice->activeRecord()->read()) + 2) * 2;

try{
    $invoice->activeRecord()->create([
        'orderId'           =>  $order->activeRecord()->getId(),
        'invoice_number'    =>  'PHARM02015'.($order->activeRecord()->getId() * 2).$order->activeRecord()->getId().$count,
        'amount'            =>  $order->activeRecord()->data()->amount

        ]);

    $order->activeRecord()->update([
        'amount'  =>    0,
        'qty'     =>    0
        ]);

    Redirect::to('invoice.php');
}
catch(Exception $e){
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

<div class="col-md-12">
<div class="row">
<div class="col-md-8 col-md-offset-2">

<?php




?>
<table class="table table-bordered">
    <thead>
    <th>Name</th>
    <th>Image</th>
    <th>Price (Naira)</th>
    <th>Quantity</th>
    <th>Prescription</th>
    <th>Total</th>  
    </thead>
    <tbody id="tbody">
    <?php
    foreach ($orders as $o) {
        $product = new Product();
        $product->activeRecord()->relate(['id' => $o->productId]);
        $allp = $product->activeRecord()->data();
        if(!($o->paid)){
     ?>
    <tr>
        <td><?= $allp->name;?></td>
        <td><img src="admin/<?= $allp->image;?>"></td>
        <td><?= $allp->price;?></td>
        <td><?= $o->qty;?></td>
        <td><?= $allp->description;?></td>
        <td><?= $o->price;?></td>
    </tr>
<?php
}
}?>
<tr>
    <td colspan="6"><span class="pull-right"><strong>N <?= $order->activeRecord()->data()->amount;?>.00</strong></span></td>
</tr>
     </tbody>   
    </table>
    <form method="post" action=""> 
        <input type="hidden" name="pay">
        <?php
        if($order->activeRecord()->data()->amount){
        ?>
<input type="submit" class="btn btn-success pull-right">
   <?php
   }?>
    </form>
    <button class="btn btn-info" onclick="window.print();">Print Result</button>



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
