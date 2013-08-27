<?php
/**
 * @package WordPress
 * @subpackage forstarters
 */
?>

<?php 
$video_field = get_sub_field('video_url');
$video = fs_video_embed( $video_field );

$video_style = get_sub_field('video_style');

$caption_field = get_sub_field('video_caption');
$caption = $caption_field;

$style ='';
if( $video_style == 'fs' ){ 
	$style = 'container-fluid'; 
}else{
	$style = 'container'; 
}

?>

<div class="content-block video <?php echo $video_style; ?>">
	<div class="<?php echo $style; ?>">

<?php if( get_sub_field('video_style') == 'fs'): // style: Full Screen ?>
		<div class="row-fluid">
			<div class="col-lg-12">
				<?php echo $video; ?>    
			</div>
		</div>

<?php elseif( get_sub_field('video_style') == 'full'): // style: Full Width ?>
		<div class="row">
			<div class="col-lg-12">
				<?php echo $video; ?>    
			</div>
		</div>
		<div class="row">
			<div class="caption col-lg-12">
				<?php echo $caption; ?>    
			</div>
		</div>

<?php elseif( get_sub_field('video_style') == 'centered'): // style: Centered ?>
		<div class="row">
<?php if( get_sub_field('video_caption_position') == 'left'): // caption: Left ?>
			<div class="caption col-lg-2">
				<?php echo $caption; ?>    
			</div>
<?php endif; ?>

<?php $offset = ( get_sub_field('video_caption_position')  == 'right' ? 'col-lg-offset-2' : '' ); ?>
			<div class="col-lg-8 <?php echo $offset; ?>">
				<?php echo $video; ?>    
			</div>

<?php if( get_sub_field('video_caption_position') == 'right'): // caption: Right ?>
			<div class="caption col-lg-2">
				<?php echo $caption; ?>    
			</div>
<?php endif; ?>
		</div>

<?php elseif( get_sub_field('video_style') == 'inline'): // style: Inline ?>

		<div class="row">
<?php if( get_sub_field('video_caption_position') == 'left'): // caption: Left ?>
			<div class="caption col-lg-3">
				<?php echo $caption; ?>    
			</div>
<?php endif; ?>

<?php $offset = ( get_sub_field('video_caption_position')  == 'right' ? 'col-lg-offset-3' : '' ); ?>
			<div class="col-lg-6 <?php echo $offset; ?>">
				<?php echo $video; ?>    
			</div>

<?php if( get_sub_field('video_caption_position') == 'right'): // caption: Right ?>
			<div class="caption col-lg-3">
				<?php echo $caption; ?>    
			</div>
<?php endif; ?>

		</div>
<?php endif;?>
	</div>
</div>
