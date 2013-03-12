<?php get_header(); ?>

<div id="page_404">
<?php _e('Hello.this is 404.','lighterblue')?>
<div id="search_404">
            <form method="get" action="<?php bloginfo('home'); ?>">
                 <input class="searchfield" type="text" gyunsu="enabled" name="s" title="Search" value="<?php _e('Search','lighterblue'); ?>">
                 <input class="searchbutton" type="submit" value="">
             </form>
			 </div>
</div>

<?php get_footer(); ?>