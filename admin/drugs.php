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
    <?php
    $drugs = new Product();   
   $count = $drugs->getDrugsCount();
   $pages = ceil($count/5);
    ?>






    <table class="table table-bordered">
    <thead>
    <th>Name</th>
    <th>Image</th>
    <th>Tags</th>
    <th>Price (Naira)</th>
    <th>Quantity In Stock</th>    
    </thead>
    <tbody id="tbody">
   
     </tbody>   
    </table>
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

<?php
Html::end();
?>

<script>
function get_drugs(id){
    $('tbody').html('loading....');
    $.ajax({
        type: 'POST',
        url: 'getDrugs.php',
        data: 'id='+id,
        dataType: 'xml',
        success: function(data){
        var response = data.firstChild.getElementsByTagName("child");
        $('tbody').html('');
      for($i = 0; $i < response.length; $i++)
      {

      var name       = response[$i].childNodes[0].childNodes[0].nodeValue;
      var image      = response[$i].childNodes[1].childNodes[0].nodeValue;
      var tags       = response[$i].childNodes[2].childNodes[0].nodeValue;
      var price      = response[$i].childNodes[3].childNodes[0].nodeValue;
      var qty        = response[$i].childNodes[4].childNodes[0].nodeValue;
      var id         = response[$i].childNodes[5].childNodes[0].nodeValue;

      $('#tbody').append('<tr><td>'+name+'</td>\
        <td><img src='+ image +'></td>\
        <td>'+tags+'</td>\
        <td><input type="text" class="form-control" onchange="price(this.id);" id="'+id+'" value="'+price+'"></td>\
        <td><input type="text" class="form-control" onchange="qty(this.id);" id="qty'+id+'" value="'+qty+'"></td>\
        </tr>');
      
        }
    },
        error: function(){
            alert('Something Went wrong');
        }

    })

}

get_drugs(1);

function price(id)
{   
    $value =  $('#'+id).val();
    $val = !isNaN($value);
    
    if($val){
        $.ajax({
            url: 'changePrice.php',
            type: 'POST',
            data: 'id='+id+'&value='+$value,
            success: function(data){
                alert(data);
            }


        });

    }else{
        alert('Please you have to enter a number');
    }
}

function qty(id)
{   
    $value =  $('#'+id).val();
    $need = id.slice(3);
    $val = !isNaN($value);

    
    if($val){
        $.ajax({
            url: 'changeQty.php',
            type: 'POST',
            data: 'id='+$need+'&value='+$value,
            success: function(data){
                alert(data);
            }
        });


    }else{
        alert('Please you have to enter a number');
    }

}

</script>