<?php get_header(); ?>
	<div id="content" class="full-width">
		<span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
		<span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span>	
		<div id="post-404page">
			<div class="post-content">
				<div class="fusion-title title">
					<h2 class="title-heading-left"><?php echo __('Oops, This Page Could Not Be Found!', 'Avada'); ?></h2><div class="title-sep-container"><div class="title-sep sep-double"></div></div>
				</div>
				<div class="fusion-clearfix"></div>
				<div class="error_page">
					<div class="one_third">
						<div class="error-message">404</div>
					</div>
					<div class="one_third useful_links">
						<h3><?php echo __('Please make sure you\'ve entered the address correctly', 'Avada'); ?></h3>
<p>If you need help, you can contact us here: <a href="mailto:<?php echo get_option('admin_email');?>"><?php echo get_option('admin_email');?></a></p>
						
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>