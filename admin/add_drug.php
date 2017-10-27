<?php
include_once 'core/init.php';

Html::start('Administrator\'s portal' );
$u = new User();

if(!$u->isAdmin()){
    Redirect::to('../index.php');
}
    $category = new Category();

    $categories = $category->getAll();
   

if(Input::exists()){
    try{
        $drug = new Product();
    $drug->activeRecord()->create([

        'name'  => Input::get('name'),
        'tags'  => Input::get('tags'),
        'price'  => Input::get('price'),
        'image'  => Input::get('image'),
        'qty'  => Input::get('qty'),
        'description'  => Input::get('description'),
        'categoryId' => Input::get('categoryId')


        ]);
    Session::flash('Home','Your have successfully added a drug!');

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

    <table class="table">
    <caption>Register a Drug</caption>
        <tr>
            <td class="col-md-3">
            
                Add A Drug Category:
                            
            </td>
            <td>
            <select name="categoryId" class="form-control">
                <?php foreach ($categories as $key){ ?>
                <option value="<?= $key->id;?>"><?= $key->name;?></option>
                    
                <?php }?>
            </select>
                
            </td>
        </tr>
        <tr>
        <td>
                            Name of the Drug:
        </td>
        <td>
            <input type="text" class="form-control" name="name">
        </td>
        </tr>
        <tr>
            <td>
                Tags/ Keywords:
            </td>
            <td>
                <textarea class="form-control" name="tags"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                Drug Image:
            </td>
            <td>
            <input type="hidden" id="picture" name="image">
            <div id="feed-back"></div>
                <input type="file" id="image">
            </td>
        </tr>
        <tr>
            <td>
                Prescription
            </td>
            <td>
                <textarea class="form-control" name="description"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                Price of Drug:
            </td>
            <td>
                <input type="text" class="form-control" name="price">
            </td>
        </tr>
        <tr>
           <td>
               Quantity in Stock (In digits):
           </td> 
           <td>
               <input type="text" class="form-control" name="qty">
           </td>
        </tr>

        
    </table>

        <div class="form-group">
            <div class="">
            
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
<script>


  $("#image").change(function(){
    
    var picture = document.getElementById('image');
    var pic = picture.files;
        
        var formData = new FormData();
        formData.append('photo', pic[0]);
            var request;
            if(window.XMLHttpRequest){
                request = new XMLHttpRequest();
            }
            else if(window.ActiveXObject){
                request = new ActiveXObject("Msxml2.XMLHTTP");
            }
            else {
                throw new Error("Ajax is not supported by this browser");
            }

            request.upload.addEventListener('error', function(event){
                alert('Uploading Failed');
            });

    request.addEventListener('readystatechange', function(event){
    if (this.readyState == 4){
      if (this.status == 200)
      {
      var xmlDoc = this.responseXML;
      var text = this.responseText;
      root = xmlDoc.documentElement;
      first = root.firstChild;
      second = root.lastChild;
      var fedback = $('#feed-back');
      fedback.html(first.firstChild.nodeValue);
      var idx1 = first.firstChild.nodeValue.indexOf("i", 3);
      var idx2 = first.firstChild.nodeValue.lastIndexOf("g");
      var images = first.firstChild.nodeValue.substring(idx1, idx2 + 1);
      picture.value ='';
      document.getElementById("picture").value = images;
//      document.getElementById('photo-body').innerHTML += '<button type="button" data-image="'+first.firstChild.nodeValue+'" data-toggle="modal" data-target="#loadImageModal"><img class="img-thumbnail" src="'+first.firstChild.nodeValue+'"></button>';
      }
      else{

        console.log('Server replied with HTTP status:' + this.status);
      }
    }
  });


request.open('POST', 'uploadpicture.php', true);
request.setRequestHeader('Cache-Control', 'no-cache');
request.send(formData);


  })

</script>