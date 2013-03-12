<?php get_header(); ?>
	<div id="content"><!--Conten Begin-->
		<div class="errorbox">
			<?php _e('O, This is 404 Page.', 'isimple'); ?>
		</div>
		<img id="f404" src="<?php bloginfo('template_url'); ?>/images/404.png" alt="404 <?php echo _('The page not found!', 'isimaple'); ?>" />
	</div><!--Content End-->
<?php get_footer(); ?>