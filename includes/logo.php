<div class="logo-wrapper">
  
        <div class="container-fluid">
          <div class="row">
          <div class="logo">
          <div class="col-md-2">
          <div class="col-md-12">
            <img src="images/logo.png">
            
          </div>    
          </div>
          <div class="searchbox">
          <div class="col-md-8">
          <h2 align="center" class="header_text">Welcome To Zumunchi Pharmacy</h2>
          <div class="form-group input-group">
            <input type="text" id="search" placeholder="Search for drugs and brands" class="form-control search">
            <span class="input-group-btn">
            <button class="btn btn-info searchbtn" type="button"><i class="fa fa-search"></i>
             </button>
              </span>
             </div>

            
          </div>
          </div>  
          </div>
                    <div class="">
            <div class="col-md-2">
              <div class="row">
              <div class="cart">
              <div class="row">
              <?php
              include_once 'core/init.php';
              $iu = new User();
              if($iu->isLoggedIn()){
                $order = new Orders();
                $order->activeRecord()->relate(['userId' => $iu->activeRecord()->getId()]);
                  if($order->activeRecord()->data()){
                    $amt = $order->activeRecord()->data()->amount;
                  $qty = $order->activeRecord()->data()->qty;
                }else{
                  $amt = 0;
                  $qty = 0;
                }

              ?>
                <div class="col-md-6" id="cart_size">
                  <i class="fa fa-shopping-cart fa-fw"></i> <?= $qty;?> items
                </div>
                <div id="cart_amount" class="col-md-6">
                  N <?= $amt;?>.00
                </div>
                <?php
                }else {?>
                <div class="col-md-6" id="cart_size">
                  <i class="fa fa-shopping-cart fa-fw"></i> 0 items
                </div>
                <div id="cart_amount" class="col-md-6">
                  N 0.00
                </div>

                <?php
                  # code...
                }?>
                <div class="col-md-8">
                <br>
                  <a href="checkout.php" class="btn btn-sm btn-success">Checkout &gt;&gt; </a>
                </div>
              </div>
              </div>
              </div>
            </div>
          </div>

          </div>
        </div>

</div>