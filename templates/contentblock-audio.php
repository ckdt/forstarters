<?php
/**
 * @package WordPress
 * @subpackage forstarters
 */
?>
<?php 
$audio_field = get_sub_field('audio_url');
$audio = wp_oembed_get( $audio_field );

$audio_style = get_sub_field('audio_style');

$caption_field = get_sub_field('audio_caption');
$caption = $caption_field;
?>

<div class="content-block audio <?php echo $audio_style; ?>">
	<div class="container">
<?php if( get_sub_field('audio_style') == 'full'): // style: Full Width ?>
		<div class="row">
			<div class="col-lg-12">
				<?php echo $audio; ?>    
			</div>
		</div>
		<div class="row">
			<div class="caption col-lg-12">
				<?php echo $caption; ?>    
			</div>
		</div>

<?php elseif( get_sub_field('audio_style') == 'centered'): // style: Centered ?>
		<div class="row">
<?php if( get_sub_field('audio_caption_position') == 'left'): // caption: Left ?>
			<div class="caption col-lg-2">
				<?php echo $caption; ?>    
			</div>
<?php endif; ?>

<?php $offset = ( get_sub_field('audio_caption_position')  == 'right' ? 'col-lg-offset-2' : '' ); ?>
			<div class="col-lg-8 <?php echo $offset; ?>">
				<?php echo $audio; ?>    
			</div>

<?php if( get_sub_field('audio_caption_position') == 'right'): // caption: Right ?>
			<div class="caption col-lg-2">
				<?php echo $caption; ?>    
			</div>
<?php endif; ?>
		</div>

<?php elseif( get_sub_field('audio_style') == 'inline'): // style: Inline ?>

		<div class="row">
<?php if( get_sub_field('audio_caption_position') == 'left'): // caption: Left ?>
			<div class="caption col-lg-3">
				<?php echo $caption; ?>    
			</div>
<?php endif; ?>

<?php $offset = ( get_sub_field('audio_caption_position')  == 'right' ? 'col-lg-offset-3' : '' ); ?>
			<div class="col-lg-6 <?php echo $offset; ?>">
				<?php echo $audio; ?>    
			</div>

<?php if( get_sub_field('audio_caption_position') == 'right'): // caption: Right ?>
			<div class="caption col-lg-3">
				<?php echo $caption; ?>    
			</div>
<?php endif; ?>

		</div>
<?php endif;?>
	</div>
</div>