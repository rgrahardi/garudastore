           <!-- Begin Slider With Banner Area -->
           <div class="slider-with-banner">
               <div class="container">
                   <div class="row">
                       <!-- Begin Slider Area -->
                       <div class="col-lg-8 col-md-8">
                           <div class="slider-area pt-sm-30 pt-xs-30">
                               <div class="slider-active owl-carousel">
                                   <!-- Begin Single Slide Area -->
                                   <div class="single-slide align-center-left animation-style-01 bg-1">
                                       <div class="slider-progress"></div>
                                       <div class="slider-content">
                                           <h5>Sale Offer <span>-20% Off</span> This Week</h5>
                                           <h2>Chamcham Galaxy S9 | S9+</h2>
                                           <h3>Starting at <span>Rp. 12.999.999</span></h3>
                                       </div>
                                   </div>
                                   <!-- Single Slide Area End Here -->
                                   <!-- Begin Single Slide Area -->
                                   <div class="single-slide align-center-left animation-style-02 bg-2">
                                       <div class="slider-progress"></div>
                                       <div class="slider-content">
                                           <h5>Sale Offer <span>Black Friday</span> This Week</h5>
                                           <h2>Work Desk Surface Studio 2018</h2>
                                           <h3>Starting at <span>Rp. 5.999.999</span></h3>
                                       </div>
                                   </div>
                                   <!-- Single Slide Area End Here -->
                                   <!-- Begin Single Slide Area -->
                                   <div class="single-slide align-center-left animation-style-01 bg-3">
                                       <div class="slider-progress"></div>
                                       <div class="slider-content">
                                           <h5>Sale Offer <span>-10% Off</span> This Week</h5>
                                           <h2>Phantom 4 Pro+ Obsidian</h2>
                                           <h3>Starting at <span>Rp. 10.999.999</span></h3>
                                       </div>
                                   </div>
                                   <!-- Single Slide Area End Here -->
                               </div>
                           </div>
                       </div>
                       <!-- Slider Area End Here -->
                       <!-- Begin Li Banner Area -->
                       <div class="col-lg-4 col-md-4 text-center pt-sm-30 pt-xs-30">
                           <div class="li-banner">
                               <a href="#">
                                   <img src="<?= base_url(); ?>assets/images/banner/1_1.jpg" alt="">
                               </a>
                           </div>
                           <div class="li-banner mt-15 mt-md-30 mt-xs-25 mb-xs-5">
                               <a href="#">
                                   <img src="<?= base_url(); ?>assets/images/banner/1_2.jpg" alt="">
                               </a>
                           </div>
                       </div>
                       <!-- Li Banner Area End Here -->
                   </div>
               </div>
           </div>
           <!-- Slider With Banner Area End Here -->
           <!-- product-area start -->
           <div class="product-area pt-55 pb-25 pt-xs-50">
               <div class="container">
                   <div class="row">
                       <div class="col-lg-12">
                           <div class="li-product-tab">
                               <ul class="nav li-product-menu">
                                   <li><a class="active" data-toggle="tab" href="#li-new-product"><span>Products</span></a></li>
                               </ul>
                           </div>
                           <!-- Begin Li's Tab Menu Content Area -->
                       </div>
                   </div>
                   <div class="tab-content">
                       <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                           <div class="row">
                               <div class="product-active owl-carousel">
                                   <?php foreach ($products->getResult() as $key) : ?>
                                       <!-- single-product-wrap start -->
                                       <div class="single-product-wrap">
                                           <div class="product-image">
                                               <a href="checkout/<?= $key->id; ?>">
                                                   <img src="<?= base_url(); ?>assets/images/product/large-size/<?= $key->image; ?>" alt="Li's Product Image">
                                               </a>
                                               <span class="sticker">New</span>
                                           </div>
                                           <div class="product_desc">
                                               <div class="product_desc_info">
                                                   <div class="product-review">
                                                       <h5 class="manufacturer">
                                                           <a href="#">IT</a>
                                                       </h5>
                                                       <div class="rating-box">
                                                           <ul class="rating">
                                                               <li><i class="fa fa-star-o"></i></li>
                                                               <li><i class="fa fa-star-o"></i></li>
                                                               <li><i class="fa fa-star-o"></i></li>
                                                               <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                               <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                           </ul>
                                                       </div>
                                                   </div>
                                                   <h4><a class="product_name" href="checkout/<?= $key->id; ?>"><?= $key->name; ?></a></h4>
                                                   <div class="price-box">
                                                       <span class="new-price">Rp. <?= $key->price; ?></span>
                                                   </div>
                                               </div>
                                               <div class="add-actions">
                                                   <ul class="add-actions-link">
                                                       <li class="add-cart active"><a href="checkout/<?= $key->id; ?>">BUY NOW</a></li>
                                                   </ul>
                                               </div>
                                           </div>
                                       </div>
                                   <?php endforeach ?>
                                   <!-- single-product-wrap end -->
                               </div>

                           </div>
                       </div>
                   </div>

               </div>
           </div>
           </div>
           <!-- Group Featured Product Area End Here -->