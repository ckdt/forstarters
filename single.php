<?php
/**
 * @package WordPress
 * @subpackage forstarters
 */
?>
<?php fs_get_template_parts( array( 'templates/html-header', 'templates/header' ) ); ?>

<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?>>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<header>
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php get_template_part('templates/entry-meta'); ?>
					</header>
				</div>
			</div>
		</div>
		<?php get_template_part('templates/contentblocks'); ?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?php comments_template('/templates/comments.php'); ?>
				</div>
			</div>
		</div>
	</article>
<?php endwhile; ?>

<?php fs_get_template_parts( array( 'templates/footer', 'templates/html-footer' ) ); ?>