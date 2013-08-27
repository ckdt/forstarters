<?php
/**
 * @package WordPress
 * @subpackage forstarters
 */
?>

<?php
$images = get_sub_field('gallery_content');

$gallery_style = get_sub_field('gallery_style');

$style ='';
if( $gallery_style == 'fs' ){ $style = 'col-lg-12'; }
if( $gallery_style == 'full' ){ $style = 'col-lg-12'; }
if( $gallery_style == 'centered' ){ $style = 'col-lg-8 col-lg-offset-2'; }
if( $gallery_style == 'inline' ){ $style = 'col-lg-6 col-lg-offset-3'; }

?>

<div class="content-block gallery <?php echo $gallery_style; ?>">

<?php if( $gallery_style == 'fs' ): // style: Full Screen ?>
	<div class="container-fluid">
		<div class="row-fluid">
<?php else: // style: Other ?>
    <div class="container">
        <div class="row">
<?php endif; ?>
			
            <div class="image-gallery <?php echo $style; ?>">

<?php
 
if( $images ): ?>
    <div id="slider" class="flexslider">
        <ul class="slides">
            <?php foreach( $images as $image ): ?>
                <li>
                    <img src="<?php echo $image['sizes']['image1170x780']; ?>" alt="<?php echo $image['alt']; ?>" />
                    <p><?php echo $image['caption']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- Uitdaging:
    Meerdere sliders, gekoppeld aan uniek id
    Relatieve javascript, opbasis van html settings -->
    
    <!--<div id="carousel" class="flexslider">
        <ul class="slides">
            <?php //foreach( $images as $image ): ?>
                <li>
                    <img src="<?php// echo $image['sizes']['thumbnail']; ?>" alt="<?php //echo $image['alt']; ?>" />
                </li>
            <?php //endforeach; ?>
        </ul>
    </div>-->
    
    
<?php endif; ?>

			</div>
		</div>
	</div>
</div>