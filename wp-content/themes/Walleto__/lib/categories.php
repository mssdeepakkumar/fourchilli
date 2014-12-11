
<?php
if(!function_exists('walleto_get_post_function'))
{
   function walleto_get_post_function($arr = '')
   {
    if ($arr[0] == "winner")
        $pay_this_me = 1;
    
    if ($arr[0] == "unpaid")
        $unpaid = 1;
    $paid = get_post_meta(get_the_ID(), 'paid', true);
    $ending = get_post_meta(get_the_ID(), 'ending', true);
    $sec = $ending - current_time('timestamp', 0);
    $location = get_post_meta(get_the_ID(), 'Location', true);
    $closed = get_post_meta(get_the_ID(), 'closed', true);
    $post = get_post(get_the_ID());
    $only_buy_now = get_post_meta(get_the_ID(), 'only_buy_now', true);
    $buy_now = get_post_meta(get_the_ID(), 'buy_now', true);
    $featured = get_post_meta(get_the_ID(), 'featured', true);
    //$current_bid 		= get_post_meta(get_the_ID(), 'current_bid', true);
    $post = get_post(get_the_ID());
    global $current_user;
    get_currentuserinfo();
    $uid = $current_user->ID;
    $pid = get_the_ID();
    global $image_thing_tags;
    if (empty($image_thing_tags))
        $image_thing_tags = 'main-image-post';
?>
<ul class="list-unstyled product_listing_ul product_lising_four_products">
             <li>
	         <div class="product_block_top product_block_light_strip"></div>              
                <div class="product_block_middle">
                   <a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php
                    echo walleto_get_first_post_image(get_the_ID(), '', '', '', $image_thing_tags, 1);?>
                  </a>
                  <div class="product-content">
		   <a class="product_name" title="<?php the_title();?>" href="<?php the_permalink();?>"><?php $ttl = get_the_title();
                        $xx  = 24;
                       if (strlen($ttl) > $xx)
                       echo substr($ttl, 0, $xx);
                       else
                       echo $ttl;?>
                   </a>

                    <p class="product_detail">Sed ut perspiciatis unde omnis</p>                                      
                  </div>
	              <div class="product-price">
                        <span class="product_orignal_price">$190.00</span>
			<span class="product_discount_price"><?php echo walleto_get_show_price(walleto_get_product_price($pid), 0);?>
                    
                      </div>
               <a href="javascript:void(0);" class="buy_now_btn"><i class="icon-shopping-cart"></i> Buy Now </a>
                </div>
              	<div class="product_block_bottom product_block_light_strip"></div>
              </li>
 </ul>
<?php
   }
   }?>
   