<?php

function walleto_checkout_area_function()
{

	?>
	
 <div class="clear10"></div>

	
			<div class="my_box3"> 
            
            	<div class="box_title"><?php echo sprintf(__("Checkout",'Walleto')); ?></div>
                <div class="box_content">   
                
                <?php
				
					$cart 		= $_SESSION['my_cart']; $prc_t = 0; 
					$cart_id 	= get_option('Walleto_shopping_cart_page_id');
					$shp = 0;
					
					
					if(is_array($cart) and count($cart) > 0)
					{
						echo '<form method="post" action="'.get_permalink($cart_id).'"> <table width="100%">';
						
						foreach($cart as $item)
						{
							$post_au 	= get_post($item['pid']);
							$pp 		= Walleto_get_item_price($item['pid']);
							$prc 		= $item['quant'] * $pp;
							$shp		+= get_post_meta($item['pid'], 'shipping', true);
							
							$prc_t += $prc;
							
							echo '<tr> <input type="hidden" name="cart_id_c[]" value="'.$item['pid'].'" />';
							echo '<td width="68">'. Walleto_get_first_post_image($item['pid'], 60, 60, 'img_class') .'</td>';
							echo '<td valign="middle" width="300"><a href="'.get_permalink($item['pid']).'">'. $post_au->post_title .'</a></td>';
							echo '<td valign="middle">'.$item['quant'].'</td>';
							echo '<td valign="middle">'.Walleto_get_show_price($prc,2).'</td>';
						 
							echo '</tr>';
							
						}
						
						echo '<tr>';
						echo '<td colspan="5"><hr color="#711"  /></td>';						
						echo '</tr>';
						
						//$shp = AT_get_shipping($prc_t, $uid);
						
						echo '<tr>';
						echo '<td colspan="3"></td>';
						echo '<td>Shipping: '.Walleto_get_show_price($shp, 2).'</td>';
						echo '<td valign="middle"></td>';
						echo '</tr>';
						
						
						echo '<tr>';
						echo '<td colspan="2"></td>';
						echo '<td>Total: '.Walleto_get_show_price(($prc_t + $shp), 2).'</td>';
						echo '<td valign="middle">
						
						<input type="submit" name="go_back_to_my_shopping_cart_me" value="'.__('Go back to My Cart','Walleto'). '" />
						<input type="submit" name="agree_and_pay" value="'.__('Proceed to Payment','Walleto'). '" />
						</td>';
						echo '</tr>';
						
						
						echo '</table></form>';
					}
					else
					{
						echo __('There are no items in your shopping cart.', 'Walleto');	
					}
					
				?>
                
             
                </div>
                </div>
    
    
    <?php		
	
}

?>