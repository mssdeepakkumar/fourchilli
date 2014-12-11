<!--middle bottom right section start-->
       <section id="middle_top_right_wrapper_category_page">
         
         <!--hot products start-->
          <section id="hot_products">
              
            <?php dynamic_sidebar( 'single-widget-area' ); ?>
          </section>
          <!--hot products end-->
          
          <!--featured products start-->
          <section id="featured_products">
              <div class="featured_product_heading">Featured Products</div>     
            <ul class="list-unstyled featured_product_listing featured_product_listing-right-category">
               <?php dynamic_sidebar( 'home-right-widget-area' ); ?>
             </ul>   
          </section>
          <!--featured products end-->
          <!--add banner-->
	     <?php dynamic_sidebar( 'inner-page-area-left' ); ?>
          <!--add banner-->
          
          <!--small slider start-->
          <section id="small_slider">
          <?php echo do_shortcode("[metaslider id=325]");?>
          </section>
          <!--small slider end-->        
          
          </section>      
       <!--middle bottom right section end-->  
	</section>    
