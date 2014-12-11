<?php
/***************************************************************************
*
*	Walleto - copyright (c) - sitemile.com
*	The best wordpress premium theme for having a marketplace. Sell and buy all kind of products, including downloadable goods. 
*	Have a niche marketplace website in minutes. Turn-key solution.
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/products/walleto-wordpress-marketplace-theme/
*	since v1.0.1
*
*	Dedicated to my wife: Alexandra
*
***************************************************************************/

?>
<section id="payment_social_contact_main_wrapper" class="outer_width">
	<section class="inner_width">
      <!--payment methods wrapper-->
	<article id="paymetn_methods_wrapper">
	<p>All major payment methods accepted:</p>
		<ul class="listing_of_payments_icon list-unstyled">
        	<li><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory'); ?>/img/visa_button.jpg"></a></li>
            <li><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory'); ?>/img/american_express.jpg"></a></li>
            <li><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory'); ?>/img/mestro_card.jpg"></a></li>
            <li><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory'); ?>/img/google_wishlist.jpg"></a></li>
            <li><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory'); ?>/img/mastro_card_yellow.jpg"></a></li>
            <li><a href="javascript:void(0);"><img src="<?php bloginfo('template_directory'); ?>/img/paypal.jpg"></a></li>
		</ul>
	</article>
	<!--payment methods wrapper-->
	<!--social media wrapper-->
	<article id="social_media_wrapper">
	<p>Get in touch with Social Media</p>
		<ul class="social_media_list list-unstyled">
        	  <li><a class="fb" target="_blank" href="https://www.facebook.com/FourChillies"><i class="icon-facebook"></i></a></li>
            <li><a class="in" target="_blank" href="http://www.pinterest.com/fourchillies"><i class="icon-pinterest "></i></a></li>
            <li><a class="twt" target="_blank" href="https://twitter.com/fourchillies"><i class="icon-twitter"></i></a></li>
            <li><a class="yt" target="_blank" href="https://www.youtube.com/FourChillies"><i class="icon-youtube "></i></a></li>
		</ul>
      </article>
     <!--social media wrapper-->
     <div class="clearfix"></div>
    
    </section>
    </section>
    <!--payment method and social icons wrapper end-->
</section>
  <!--middel section end-->  
  <!--Footer section start-->
  
  <footer>
  	<section class="foot_top">
    	<section class="inner_width">
            <?php dynamic_sidebar( 'First Footer Widget Area' ); ?>
            <?php dynamic_sidebar( 'Second Footer Widget Area' ); ?>
            <?php dynamic_sidebar( 'Third Footer Widget Area' ); ?>
            <?php dynamic_sidebar( 'Fourth Footer Widget Area' ); ?>
	          <?php dynamic_sidebar( 'Fifth Footer Widget Area' ); ?>
           
        </section>
     </section>   
     <section class="foot_btm">
       <section class="inner_width">
       	<p class="copy">Copyright © 2013 Four Chillies  |  All Rights Reserved. </p>
        <!--ul class="footer_links">
        	<li><a href="#">Home</a></li>
            <li><a href="#">Shopping Cart</a>|</li>
            <li><a href="#">Contact</a>|</li>
            <li><a href="#">Mission</a>|</li>
            <li><a href="#">Our Guarantee</a>|</li>
            <li><a href="#">Delivery Time</a>|</li>
            <li><a href="#">New Items</a>|</li>
        </ul-->
        <div class="clear"></div>
       </section>
     </section>
    </section>
  </footer>
  <!--Footer section end-->
 
</section>
<!--wrapper end-->
<div id="elevator_item"><a href="javascript:void(0);" id="elevator" onclick="return false;" title="Back To Top">&nbsp;<i class="icon-double-angle-up"></i></a></div>
<?php wp_footer(); ?>
<script type="text/javascript" src="http://www.jquery4u.com/demos/jquery-quick-pagination/js/jquery.quick.pagination.min.js"></script>
<script type="text/javascript">
$(".list-unstyled.product_listing_ul.product_lising_four_products").quickPagination({  
  pageSize:"12"
});
</script>
<style>
.simplePagerNav{
  text-align: center;
}
.currentPage > a {
    color: red;
}
.simplePagerNav li {
    border: 1px solid;
    display: inline-block;
    margin-right: 5px;
    padding: 5px;
    text-align: center;
}
</style>

<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/app.js"></script>
</body>
</html>
