<?php
include_once 'core/init.php';

Html::start('Online Pharmacy - serving you always' );
$u = new User();

$categories = new Category();
$products = new Product();

$where = '';
$catId = 0;
if(Input::get('cate')){
$where = 'categoryId = '. Input::get('cate');
$catId = Input::get('cate');
}
$getproducts = $products->getDrugs($where, 0, 1);

foreach ($getproducts as $key) {
    $product[] = $key;
}

$catWhere = [];
    if(Input::get('cate')){

    $catWhere = ['categoryId' => Input::get('cate')];
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

    <?php
    $drugs = new Product();   
   $count = $drugs->getDrugsCount($catWhere);
   $pages = ceil($count/8);
    ?>


<div class="col-md-12">
<div class="row">
<div class="categories">
    
<div class="col-md-2">
<h3>Drug Categories</h3>
<ul class="nav">
    <?php
    foreach ($categories->getAll() as $key) {

    ?>
    <li><a href="pharmacy.php?cate=<?= $key->id;?>"><?= $key->name;?></a></li>
    
<?php }?>
</ul>  
</div>

    <div class="col-md-10">
<div class="product-wrapper">
    <div class="row">
    <div class="col-md-12">
    <div class="showing alert alert-info">
        Showing 1 to 24 of 54 products
    </div>
</div>
        <div class="col-md-12">
            <div id="pWrap" class="row">
                      
        </div>
    </div>
    </div>
    <div class="col-md-12">
        <nav>
  <ul class="pagination">
 <?php for ($i=1; $i <= $pages ; $i++) { 
    ?>
    <li><a onclick="get_drugs(<?= $i;?>);"><?= $i;?></a></li>
    <?php
 }?>   
 
  </ul>
</nav>
    </div>
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
<script>

function get_drugs(id){
    $('#pWrap').html('loading....');
    var ids = id;

    $.ajax({
        type: 'POST',
        url: 'getDrugs.php',
        data: 'id='+id+'&cate=<?= $catId;?>',
        dataType: 'xml',
        success: function(data){
        var response = data.firstChild.getElementsByTagName("child");
      $('#pWrap').html('');
    
      if(ids == 1)
      {
    $('.showing').html('Showing 1 to '+(response.length)+' of <?= $count;?> products');      
      }
      else{
        var page = (ids - 1) * 8;
    $('.showing').html('Showing '+(page + 1)+' to '+(page + response.length)+' of <?= $count;?> products');      
      }
        
      for($i = 0; $i < response.length; $i++)
      {

      var name       = response[$i].childNodes[0].childNodes[0].nodeValue;
      var image      = response[$i].childNodes[1].childNodes[0].nodeValue;
      var tags       = response[$i].childNodes[2].childNodes[0].nodeValue;
      var price      = response[$i].childNodes[3].childNodes[0].nodeValue;
      var qty        = response[$i].childNodes[4].childNodes[0].nodeValue;
      var id         = response[$i].childNodes[5].childNodes[0].nodeValue;

      $('#pWrap').append('\
<div class="col-md-3">\
                            <div class="product">\
                                <div class="row">\
                                <div class="col-md-12">\
                                    <img src="admin\\'+image+'">\
                                </div>\
                                <div class="col-md-11 col-md-offset-1">\
                                <div class="product-name">\
                                '+name+'\
                                </div>\
                                <div class="product-name">'+qty+' pieces in Stock</div>\
                                </div>\
                                <div class="col-md-2">\
                                   <small><label>QTY </label></small>\
                                </div>\
                                <div class="col-md-6">\
                                   <input type="text" maxlength="3" value="1" class="form-control"  id="qty'+id+'">\
                                </div>\
                                <div class="col-md-3">\
                                        <h4>N'+price+'</h4>\
                                </div>\
                                <div class="col-md-9 col-md-offset-3">\
                                <br>\
                                    <button onclick="buy('+id+');" class="btn btn-success btn-sm btn-block">\ Buy &nbsp; &gt;</button>\
                                </div>\
                                </div>\
                            </div>\
                        </div>');
      
        }
    },
        error: function(){
            alert('Something Went wrong');
        }

    })

}

get_drugs(1);

function buy(i){
  if('<?= $u->isLoggedIn();?>'){
var id = i;
var qty = document.getElementById('qty'+id);
var amount = qty.value;

$.ajax({
        type: 'POST',
        url: 'buyDrugs.php',
        data: 'id='+id+'&qty='+amount,
        dataType: 'xml',
        success: function(data){

      var response = data.firstChild.getElementsByTagName("child");

      var drugs     = response[0].childNodes[0].childNodes[0].nodeValue;
      if(drugs == 0){
        alert('Your order is more than what is available in Stock, please order less');

      }else{
      var amount      = response[0].childNodes[1].childNodes[0].nodeValue;

      $('#cart_size').html('<i class="fa fa-shopping-cart fa-fw"></i> '+drugs+' items');
      $('#cart_amount').html('N '+amount+'.00');  
}

        }
      })
}else{
  alert('Please Log in to purchase drugs or register if you haven\'t');
  window.location.href = 'login.php';
}
}

</script>
