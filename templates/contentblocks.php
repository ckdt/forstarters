<?php
/**
 * @package WordPress
 * @subpackage forstarters
 */
?>


<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
<?php if(is_plugin_active('advanced-custom-fields/acf.php')): ?>



<?php if ( $cb = get_field('content_blocks') ): ?>
<?php $cb_text_count = 0; ?>	
<?php fs_chapter_index(); ?>


<?php while( has_sub_field('content_blocks') ): ?>

<?php if(get_row_layout() == 'video'): // layout: Video ?>

<?php get_template_part( 'templates/contentblock', 'video' ); ?>

<?php elseif(get_row_layout() == 'quote'): // layout: Quote ?>

<?php get_template_part( 'templates/contentblock', 'quote' ); ?>

<?php elseif(get_row_layout() == 'text'): // layout: Text ?>

<?php get_template_part( 'templates/contentblock', 'text' ); ?>

<?php elseif(get_row_layout() == 'gallery'): // layout: Gallery ?>

<?php get_template_part( 'templates/contentblock', 'gallery' ); ?>

<?php elseif(get_row_layout() == 'images'): // layout: Images ?>

<?php get_template_part( 'templates/contentblock', 'images' ); ?>

<?php elseif(get_row_layout() == 'chapter'): // layout: Chapter ?>

<?php get_template_part( 'templates/contentblock', 'chapter' ); ?>

<?php elseif(get_row_layout() == 'audio'): // layout: Audio ?>

<?php get_template_part( 'templates/contentblock', 'audio' ); ?>

<?php endif; ?>

<?php endwhile; ?>

<?php endif; ?>


<?php else: ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 alert alert-warning">
				This site needs the 'advanced-custom-fields' plugin  activated in order to work
			</div>
		</div>
	</div>
<?php endif; ?>