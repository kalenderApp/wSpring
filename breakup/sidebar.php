<div id="sidebar">
	<div id="sidebar_top">
		<ul class="widgets">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_top') ) :?>
		
			<?php endif; ?>
		</ul>
	</div>
	
            <div class="side_block">
               <div class="side_mid">
					<h3><?php echo (_e('Rand posts','breakup')); ?></h3>
                   <!--<h3><?php echo $posts_widget_title; ?></h3>-->
                   <ul>
                   <?php 
						$postss = get_posts('numberposts=10&orderby=rand');
						foreach($postss as $post) {
						setup_postdata($post);
						echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
					}
						$post = $postss[0];
					?>
                   </ul>
               </div>
               <div class="side_bottom">
               </div>
            </div>
            <div class="side_block">
                <div class="side_mid">			
                    			
                    
                      <?php if( function_exists('wp_recentcomments') ) : ?>
							<h3><?php echo (_e("New comments","breakup")); ?></h3>
								<ul>
									<?php wp_recentcomments('limit=10&length=16&post=false&smilies=true&administrator=false'); ?>
								</ul>
					  <?php else : ?>
					  <?php echo (_e("<h3>New comments</h3>","breakup")); ?>
							<?php
								// 不显示管理员评论方法:将 $sql 倒数第一行中的 admin 改为自己的用户名
								global $wpdb;
								$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,25) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND comment_author != 'admin' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 10";
								$comments = $wpdb->get_results($sql);
								$output = $pre_HTML;
								foreach ($comments as $comment) {
								$output .= "\n<li><a class= \"new_comments\" href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID . "\" title=\"" . $comment->post_title . "\">". strip_tags($comment->com_excerpt) ."</a></li>";
								}
								$output .= $post_HTML;
								$output = convert_smilies($output);
								echo "<ul>".$output."</ul>";
							?>
					  <?php endif; ?>
					
		         </div>
                 <div class="side_bottom">
                 </div>
           </div>
	<div id="sidebar_center">
		<ul class="widgets">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_center') ) :?>
		
			<?php endif; ?>
		</ul>
	</div>
           <div class="side_block">
               <div class="side_mid">
                   <h3><?php echo (_e('Tags','breakup')); ?></h3>
                   <div class="tag_cloud">
						<?php wp_tag_cloud('smallest=12&largest=16'); ?>
				   </div>
               </div>
               <div class="side_bottom">
               </div>
           </div>
           <div class="side_block">
               <div class="side_mid">
                   <h3><?php echo (_e('Cats','breakup')); ?></h3>
                   <ul>
                      <?php wp_list_cats('sort_column=name&optioncount=0&depth=1'); ?>
                    </ul>
				</div>
               <div class="side_bottom">
               </div>
           </div>
           <div class="side_block">
               <div class="side_mid">
                   <h3><?php echo (_e('Links','breakup')); ?></h3>
                   <ul>
                      <?php get_links(-1, '<li>', '</li>',0,0, 'Rand', 0, 0, 20, 0); ?>
                   </ul>
               </div>
               <div class="side_bottom">
               </div>
           </div>
	<div id="sidebar_bottom">
		<ul class="widgets">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_bottom') ) :?>
		
			<?php endif; ?>
		</ul>
	</div>
        </div>
