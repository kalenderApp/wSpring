<?php
	/*
	$desc = false;
	$anchor_text = $href = filter_var(trim($post->post_content), FILTER_VALIDATE_URL);
	$matches = array();
	if(!$href && preg_match('/<a [^>]*href=[\"\']?([^\"\'\s]+)/i', $post->post_content, $matches)) {
		$anchor_text = $href = $matches[1];
		$desc = get_the_excerpt();
	}
	if($post->post_title) {
		$anchor_text = $post->post_title;
	}
	*/
?>


<div class="title">
	<h2>
		<a id="titlehref" href="<?php the_permalink() ?>"  rel="bookmark"><?php the_title(); ?></a>
	</h2>
</div>
<div class="rich-content formatlink">
	<?php
		the_content(__('Read more...', 'isimple'));
	?>
	<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Page', 'twentyeleven' ) . '</span>', 'after' => '</div><div class="c"></div>','link_before'=>'<span class="current">' ,'link_after'=>'</span>' ) ); ?>
</div>
<div class="under">
	<div class="tags-category">
		<span class="categories"><?php the_category(' '); ?></span><span class="tags"><?php the_tags('#', '#', ''); ?></span>
	</div>
	<div class="date-comment">
		<a href="/<?php the_time('Y/m/j') ?>"><?php the_time(__('Y/m/j', 'inove')) ?></a>
		<?php comments_popup_link(__('No comments', 'isimple'), __('1 comment', 'isimple'), __('% comments', 'isimple'), '', __('Comments off', 'isimple')); ?>
	</div>
</div>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/thumbshots.js?v=0.2"></script>