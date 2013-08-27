<?php
/**
 * @package WordPress
 * @subpackage forstarters
 */
?>

<?php
global $cb_text_count;
$cb_text_count ++;

$profile_field = get_field('content_profile');

$text_field = get_sub_field('text_content');
$text = $text_field;

$figure_field = get_sub_field('text_figure');
$figure_image = wp_get_attachment_image_src($figure_field, 'medium');
$figure = '<img src="'.$figure_image[0].'" alt="'.get_the_title($figure_field).'" class="img-responsive" />';

$caption_field = get_sub_field('text_caption');
$caption_position = get_sub_field('text_caption_position');

$is_first = false;	
$has_profile = false;
$has_sidenote = false;
$offset = '';

if($cb_text_count === 1){		// Check if this is the first instance of this content block;
	$is_first = true;
}

$profile = '<div class="profile">'.PHP_EOL;

if($profile_field && $is_first){				// Check if it has a content profile attached
	$has_profile = true;

	foreach( $profile_field as $post_object){
		$profile .= '<a href="'.get_permalink($post_object->ID).'">'.get_the_post_thumbnail($post_object->ID,'thumbnail', array('class' => 'img-responsive img-circle') ).'</a>'.PHP_EOL;
		$profile .= '<a href="'.get_permalink($post_object->ID).'">'.get_the_title($post_object->ID).'</a>'.PHP_EOL;
		$profile .= '<small>'.apply_filters('the_content', get_post_field('post_content', $post_object->ID)).'</small>'.PHP_EOL;
	}
	$profile .= '</div>';
}

$sidenote = "";

if($figure_field || $caption_field ){
	$has_sidenote = true;
	
	if($figure_field){
		$sidenote .= $figure.PHP_EOL;
	}
	if($caption_field){
		$sidenote .= '<small>'.$caption_field.'</small>'.PHP_EOL;
	}
}
if($has_profile && $has_sidenote){
	$offset = "";
	$caption_position = 'right';
}

if(!$has_profile && !$has_sidenote){
	$offset = 'col-lg-offset-3';
}elseif(!$has_profile && $has_sidenote && $caption_position == 'right' ){
	$offset = 'col-lg-offset-3';
}

?>
<div class="content-block text">
	<div class="container">
		<div class="row">
			
			<?php if($has_profile):?>
				<div class="caption col-lg-3">
					<?php echo $profile; ?>
				</div>	
			<?php else: ?>
				<?php if($has_sidenote && $caption_position == 'left'): ?>
					<div class="caption col-lg-3">
						<?php echo $sidenote; ?>
					</div>	
				<?php endif; ?>	
			<?php endif; ?>	

			<div class="col-lg-6 <?php echo $offset; ?>">
				<?php echo $text; ?>    
			</div>

			<?php if($has_sidenote && $caption_position === 'right'): ?>
				<div class="caption col-lg-3">
					<?php echo $sidenote; ?>
				</div>	
			<?php endif; ?>	
		</div>
	</div>
</div>