<?php get_header(); ?>
	<article id="article"><!--Conten Begin-->
		<div class="errorbox">
			<?php _e('O, This is 404 Page.', 'ospring'); ?>
		</div>
		<img id="f404" src="<?php bloginfo('template_url'); ?>/images/404.png" alt="404 <?php echo _('The page not found!', 'ospring'); ?>" />
	</article><!--Content End-->
</section>
<?php get_footer(); ?>