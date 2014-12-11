<?php

function walleto_cart_area_function()
{
	
	if(isset($_GET['remove_from_cart']))
	{
		$pids = $_GET['remove_from_cart'];
		$cart = $_SESSION['my_cart'];
		$i = 0;
		
		foreach($cart as $itm)
		{
			if($itm['pid'] == $pids)  { unset($_SESSION['my_cart'][$i]);  break; }	
			
			$i++;
		}
		
		echo '<div class="saved-thing"><div class="padd10">'.__('Cart content updated.','Walleto').'</div></div>';
	}
	

	if(isset($_POST['update_card']))
	{
		$i=0;
		$cart = $_SESSION['my_cart']; $crt = array();
		
		if(is_array($_POST['cart_id_c']))
		{
			foreach($_POST['cart_id_c'] as $itm)
			{
				$crt[$i]['pid'] = $itm;
				$crt[$i]['quant'] = $_POST['cart_quant_' . $itm];
				$i++;
			}
			
			$_SESSION['my_cart'] = $crt;
		}
		
		echo '<div class="saved-thing"><div class="padd10">'.__('Cart content updated.','Walleto').'</div></div>';
		
	}
	
	
	?>
    
    <div class="clear10"></div>

	
			<div class="my_box3">
 
            
            	<div class="box_title"><?php echo sprintf(__("My Cart Content",'Walleto')); ?></div>
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
							$digital_good = get_post_meta($item['pid'],'digital_good',true);
							
							echo '<tr> <input type="hidden" name="cart_id_c[]" value="'.$item['pid'].'" />';
							echo '<td width="68">'. Walleto_get_first_post_image($item['pid'], 60, 60, 'img_class') .'</td>';
							echo '<td valign="middle" width="300"><a href="'.get_permalink($item['pid']).'">'. $post_au->post_title .'</a></td>';
							echo '<td valign="middle"><input type="'.($digital_good == "1" ? "hidden" : "text").'" size="4" class="do_input" name="cart_quant_'.$item['pid'].'" value="'.$item['quant'].'" /></td>';
							echo '<td valign="middle">'.Walleto_get_show_price($prc,2).'</td>';
							echo '<td valign="middle"><a class="remove-cart" href="'.walleto_get_remove_from_cart_link($item['pid']).'">'.__('Remove from Cart','Walleto'). '</a></td>';
							
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
						echo '<td colspan="3"></td>';
						echo '<td>Total: '.Walleto_get_show_price(($prc_t + $shp), 2).'</td>';
						echo '<td valign="middle">
						
						<input type="submit" name="continue_shopping_me" value="'.__('Continue Shopping','Walleto'). '" />
						<input type="submit" name="update_card" value="'.__('Update Cart','Walleto'). '" /> 
						<input type="submit" name="send_me_to_checkout" value="'.__('Checkout','Walleto'). '" />
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