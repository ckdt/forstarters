<?php
/**
 * @package WordPress
 * @subpackage forstarters
 */
?>
<?php fs_get_template_parts( array( 'templates/html-header', 'templates/header' ) ); ?>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h1><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		</div>
	</div>
	<div class="row">
		<?php if ( ! have_posts() ) : ?>

		<div class="col-lg-12">
			<div class="alert">
				<?php _e('Sorry, no results were found.', 'goodstart'); ?>
			</div>
		</div>
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'templates/content', get_post_format() ); ?>
		<?php endwhile; ?>			
		
	</div>
	<div class="row">
		<div class="col-lg-12">
		<?php if ($wp_query->max_num_pages > 1) : ?>
			<nav class="post-nav">
				<ul class="pager">
					<li class="previous"><?php next_posts_link(__('&larr; Older posts', 'goodstart')); ?></li>
					<li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'goodstart')); ?></li>
				</ul>
			</nav>
		<?php endif; ?>
		</div>
	</div>
</div>

<?php fs_get_template_parts( array( 'templates/footer', 'templates/html-footer' ) ); ?>