<?php
/***************************************************************************
*
*	Buzzler - copyright (c) - sitemile.com
*	WordPress Business Directory Theme
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/buzzler
*	since v1.0
*
***************************************************************************/


function buzzler_my_account_my_reviews_area_function()
{
	global $wpdb;
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>

	<div id="content" class="content_my_account" >
    
    			<div class="my_box3">          
            	<div class="box_title menu-title-item"><h1><?php _e("My Reviews",'Buzzler'); ?></h1></div>
                <div class="box_content"> 
    			
                <?php
				
				$pg = $_GET['pg'];
				if(empty($pg)) $pg = 1;
				
				$nrRes = 5;
				$offset = ($pg-1)*$nrRes;
				
				//--------------------------------
				
				$comments = get_comments('user_id=' . $uid . "&offset=".$offset."&number=" . $nrRes);
				$comments_cnt = get_comments('count=true&user_id=' . $uid );
				
				
				
				if($comments_cnt > 0)
				{
					
					$nrPages = ceil($comments_cnt / $nrRes);
					
				foreach($comments as $comment) :
					
							$GLOBALS['comment'] = $comment;
		 			
					$post_ids = $comment->comment_post_ID;
					$my_post_au = get_post($post_ids);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		
		$comm_id = get_comment_ID();
		
		$tag  = 'div';
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if (1) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
		<div class="avatar_actual_pic"><?php echo get_avatar( $comment, 50 ); ?></div>
		<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
		</div>
        
        <div class="comment-corp ">
        
        
<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
		<br />
<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
				
				$grade 		= get_comment_meta(get_comment_ID(),'grade',true);
				if(empty($grade)) $grade = 0;
				
				echo '<div class="rating_me_me">';
				echo Buzzler_get_rating_stars($grade, $comm_id);
				echo '</div>';
			?>
		</div>
		
        <p class="comm_text_front">
		<?php comment_text(); echo " in ". "<a href='".get_permalink($post_ids)."'>" . $my_post_au->post_title ."</a>"; ?>
		</p>
        
		 
		<?php if (1): // 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
        
        </div></div> <?php
					
					
				endforeach;
				
				//-------------------------------------
		
				
				echo '<div class="div_class_div">';
				
				$totalPages = $nrPages;
				$my_page = $pg;
				$page = $pg;
				
				$batch = 10;
				$nrpostsPage = $nrRes;
				$end = $batch * $nrpostsPage;
				
				if ($end > $pagess) {
					$end = $pagess;
				}
				$start = $end - $nrpostsPage + 1;
				
				if($start < 1) $start = 1;
				
				$links = '';
				
				$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;
		
				$start 		= $raport * $batch + 1; 
				$end		= $start + $batch - 1;
				$end_me 	= $end + 1;
				$start_me 	= $start - 1;
				
				if($end > $totalPages) $end = $totalPages;
				if($end_me > $totalPages) $end_me = $totalPages;
				
				if($start_me <= 0) $start_me = 1;
				
				$previous_pg = $page - 1;
				if($previous_pg <= 0) $previous_pg = 1;
				
				$next_pg = $pages_curent + 1;
				if($next_pg > $totalPages) $next_pg = 1;
		
		
		
		
				if($my_page > 1)
				{
					echo '<a href="'.buzzler_comment_user_account_link() .'pg='.$previous_pg.'" class="bighi"><< '.__('Previous','Buzzler').'</a>';
					echo '<a href="'.buzzler_comment_user_account_link() .'pg='.$start_me.'" class="bighi"><<</a>';
				}
				
					for($i=$start;$i<=$end;$i++)
					{
						if($i == $pg)
						echo '<a href="#" class="bighi" id="activees">'.$i.'</a>';
						else
						echo '<a href="'.buzzler_comment_user_account_link() .'pg='.$i.'" class="bighi">'.$i.'</a>';	
					}	
				
				if($totalPages > $my_page)
				echo '<a href="'.buzzler_comment_user_account_link() .'pg='.$end_me.'" class="bighi">>></a>';
				
				if($page < $totalPages)
				echo '<a href="'.buzzler_comment_user_account_link() .'pg='.$next_pg.'" class="bighi">'.__('Next','Buzzler').' >></a>';						
		
					
				echo '</div>';
		
				//-------------------------------------
		
				}
				else
				{
					_e('There are no reviews posted yet.','Buzzler');	
					
				}
				
				?>
              
                </div>
                </div>
                
    </div>


<?php	
		
	buzzler_get_users_links();		
		
}

?>